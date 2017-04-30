<?php
	include_once("sql_connection.php");
	define("REGISTER_FAILD", 0);					//注册失败
	define("REGISTER_SUCCESS", 1);					//注册成功
	define("REGISTER_USER_EXISTS", 2);				//用户已经存在
	
	class User{
		public $user_id;
		public $user_name;
		public $user_password;
		public $user_authority;
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
		$sql_query = "insert into user_info values(null, '{$user->user_name}', '{$user->user_password}', 0)";
		if($sql->query($sql_query) === true)
		{
			$sql->disconnect();
			return REGISTER_SUCCESS;
		}
		
		$sql->disconnect();
		return REGISTER_FAILD;
		
	}
	
	function login($user){
		$sql = new FSQL();
		$sql->connections();
		$sql_query = "select * from user_info where user_name='{$user->user_name}'";
		$sql_result = $sql->query($sql_query);
		//登陆成功！
		if($sql_result->num_rows == 1)
		{
			$row = $sql_result->fetch_assoc();
			$user->user_id = $row['user_id'];
			$user->user_authority = $row['user_authority'];
			$_SESSION['user'] = $user;
		}
		$sql->disconnect();
	}
	
?>