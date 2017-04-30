<?php
	session_start();
	include_once("user.php");
	include_once("tools.php");
	if(!IsLogin())
	{
		echo "请您先登录！";
		die();
	}
	if(isset($_POST['product_name']) && isset($_POST['type_id']))
	{
		$product = new Product();
		$user = GetUser();
		$product->product_name = filter($_POST['product_name']);
		$product->type_id = filter($_POST['type_id']);
		$product->user_id = $user->user_id;
		$state = addproduct($product);
		if($state == ADD_PRODUCT_SUCCESS)
		{
			echo "产品添加成功！";
		}
		else if($state == ADD_PRODUCT_FAILD)
		{
			echo "产品添加失败！";
		}
		else if($state == TYPE_NOT_EXIST)
		{
			echo "该类型不存在，无法添加产品！";
		}
	}
	else
	{
		echo "未知操作！";
	}
	
?>