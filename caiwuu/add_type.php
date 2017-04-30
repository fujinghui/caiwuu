<?php
	session_start();
	include_once("user.php");
	include_once("tools.php");
	include_once("sql_connection.php");
	if(!isset($_SESSION['user']))
	{
		echo "请您先登录！";
		die();
	}
	if(isset($_POST["type"]))
	{
		$user = unserialize($_SESSION['user']);
		$product_type = new ProductType();
		$product_type->type_name = filter($_POST["type"]);
		$state = addtype($product_type, $user);
		if($state == ADD_TYPE_SUCCESS)
		{
			echo "添加类型成功！";
		}
		else
		{
			echo "添加类型失败！";
		}
			
	}
	else
	{
		echo "未知操作！";
	}
?>