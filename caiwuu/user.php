<?php
	include_once("sql_connection.php");
	//注册相关常量
	define("REGISTER_FAILD", 0);					//注册失败
	define("REGISTER_SUCCESS", 1);					//注册成功
	define("REGISTER_USER_EXISTS", 2);				//用户已经存在
	//登录相关常量
	define("LOGIN_FAILD", 0);
	define("LOGIN_SUCCESS", 1);
	//添加类型相关常量
	define("ADD_TYPE_SUCCESS", 0);
	define("ADD_TYPE_FAILD", 1);
	//添加产品常量
	define("ADD_PRODUCT_SUCCESS", 0);
	define("ADD_PRODUCT_FAILD", 1);
	define("TYPE_NOT_EXIST", 2);
	
	define("DELETE_SUCCESS", 1);
	define("DELETE_FAILD", 2);
	
	class User{
		public $user_id;
		public $user_name;
		public $user_password;
		public $user_authority;
	}
	class Product{
		public $product_id;
		public $product_name;
		public $type_id;
		public $user_id;
		public $store_house;
	}
	class ProductType{
		public $type_id;
		public $type_name;
		public $user_id;
	}
	class StoreHouse{
		public $product_name;
		public $product_number;
		public $product_price;
		public $user_id;
		public $product_id;
	}
	
	function register($user){
		$sql = new FSQL();
		$sql->connections();
		$sql_query = "select * from user_info where user_name='{$user->user_name}'";
		if($sql->query($sql_query)->num_rows > 0)
		{
			$sql->disconnect();
			return REGISTER_USER_EXISTS;
		}
		$sql_query = "insert into user_info values(null, '{$user->user_name}', md5(md5('{$user->user_password}')), 0)";
		if($sql->query($sql_query) === true)
		{
			$sql->disconnect();
			return REGISTER_SUCCESS;
		}
		
		$sql->disconnect();
		return REGISTER_FAILD;
		
	}
	function IsLogin(){
		if(isset($_SESSION['user']))
			return true;
		return false;
	}
	function GetUser(){
		return unserialize($_SESSION['user']);
	}
	function login($user){
		$state = LOGIN_FAILD;
		$sql = new FSQL();
		$sql->connections();
		$sql_query = "select * from user_info where user_name='{$user->user_name}' and user_password=md5(md5('{$user->user_password}'))";
		//echo $sql_query;
		$sql_result = $sql->query($sql_query);
		//登陆成功！
		if($sql_result->num_rows == 1)
		{
			$row = $sql_result->fetch_assoc();
			$user->user_id = $row['user_id'];
			$user->user_authority = $row['user_authority'];
			$user->user_password = $row['user_password'];
			$_SESSION['user'] = serialize($user);
			$state = LOGIN_SUCCESS;
		}
		$sql->disconnect();
		return $state;
	}
	
	function addtype($product_type,$user){
		$state = ADD_TYPE_SUCCESS;
		$sql = new FSQL();
		$sql->connections();
		$sql_query = "insert into product_type values(null, '{$product_type->type_name}', {$user->user_id})";
		//echo $sql_query;
		$result = $sql->query($sql_query);
		if($result === TRUE)
			;
		else
			$state = ADD_TYPE_FAILD;
		$sql->disconnect();
		return $state;
	}
	function addproduct($product){
		$state = ADD_PRODUCT_SUCCESS;
		$sql = new FSQL();
		$sql->connections();
		//查询类型是否存在
		$sql_query = "select * from product_type where type_id={$product->type_id}";
		if($sql->query($sql_query)->num_rows == 0)
		{
			$state = TYPE_NOT_EXIST;
		}
		else
		{
			$sql_query = "insert into product_info values(null, '{$product->product_name}', {$product->type_id},{$product->user_id})";
			$result = $sql->query($sql_query);
			if($result === TRUE)
				;
			else
				$state = ADD_PRODUCT_FAILD;
			$sql->disconnect();
		}
		return $state;
	}
	
	
	//其他函数
	//获取产品类型列表
	function get_type_list($user){
		$result = Array();
		$sql = new FSQL();
		$sql->connections();
		$sql_query = "select * from product_type where user_id={$user->user_id}";
		$sql_result = $sql->query($sql_query);
		if($sql_result->num_rows>0)
		{
			while(($row=$sql_result->fetch_assoc()))
			{
				$t = new ProductType();
				$t->type_id = $row['type_id'];
				$t->type_name = $row['type_name'];
				$t->user_id = $row['user_id'];
				array_push($result, $t);
			}
		}
		$sql->disconnect();
		return $result;
	}
	//获取产品列表
	function get_product_list($user){
		$result = Array();
		$sql = new FSQL();
		$sql->connections();
		$sql_query = "select * from product_info where user_id={$user->user_id}";
		$sql_result = $sql->query($sql_query);
		if($sql_result->num_rows>0)
		{
			while(($row=$sql_result->fetch_assoc()))
			{
				$t = new Product();
				$t->product_id = $row['product_id'];
				$t->product_name = $row['product_name'];
				$t->type_id = $row['type_id'];
				$t->user_id = $row['user_id'];
				$t->store_house = new StoreHouse();
				$sql_query = "select * from store_house where user_id={$user->user_id} and product_id={$t->product_id}";
				$result2 = $sql->query($sql_query);
				if($result2->num_rows == 1)
				{
					$row2 = $result2->fetch_assoc();
					$t->store_house->product_id = $row2['product_id'];
					$t->store_house->product_number = $row2['product_number'];
					$t->store_house->product_price = $row2['product_price'];
					$t->store_house->user_id = $row2['user_id'];
					$t->store_house->product_name = $row2['product_name'];
				}
				else
				{
					$t->store_house->product_id = $t->product_id;
					$t->store_house->product_number = 0;
					$t->store_house->product_price = 0;
					$t->store_house->user_id = $t->user_id;
					$t->store_house->product_name = $t->product_name;
				}
				array_push($result, $t);
			}
		}
		$sql->disconnect();
		return $result;
	}
	//获取一个产品的库存信息
	//function get_stroe_house_for_product($
	function get_product_list_for_type($user, $type){
		$result = Array();
		$sql = new FSQL();
		$sql->connections();
		$sql_query = "select * from product_info where user_id={$user->user_id} and type_id={$type->type_id}";
		$sql_result = $sql->query($sql_query);
		if($sql_result->num_rows>0)
		{
			while(($row=$sql_result->fetch_assoc()))
			{
				$t = new Product();
				$t->product_id = $row['product_id'];
				$t->product_name = $row['product_name'];
				$t->type_id = $row['type_id'];
				$t->user_id = $row['user_id'];
				array_push($result, $t);
			}
		}
		$sql->disconnect();
		return $result;
	}
	
	function del_product($product, $user){
		$state = DELETE_SUCCESS;
		$sql = new FSQL();
		$sql->connections();
		$sql_query = "delete from product_info where product_id={$product->product_id} and user_id={$user->user_id}";
		//echo $sql_query;
		$sql_result = $sql->query($sql_query);
		if($sql_result)
		{
		}
		else
		{
			$state = DELETE_FAILD;
		}
		$sql->disconnect();
		return $state;
	}
?>