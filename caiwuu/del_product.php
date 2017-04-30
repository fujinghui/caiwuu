<?php
	session_start();
	include_once("user.php");
	include_once("tools.php");
	if(!IsLogin())
	{
		echo "请您先登录";
		die();
	}
	if(isset($_GET['product_id']))
	{
		$product = new ProductType();
		$product->product_id = filter($_GET['product_id']);
		$state = del_product($product, GetUser());
		if($state == DELETE_SUCCESS)
		{
			echo "删除成功！";
		}
		else
		{
			echo "删除失败！";
		}
	}
	else
	{
		echo "未知操作！";
	}
?>