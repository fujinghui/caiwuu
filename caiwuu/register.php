<?php
	session_start();
	include_once("user.php");
	include_once("sql_connection.php");
	header("Content-type:text/html;charset=utf-8");
	//echo addcslashes($_GET['user_name'], "1\'\"\\");
	if(isset($_POST['user_name']) && isset($_POST['user_password']))
	{
		$tostr = "1\'\"\\";
		$sql = new FSQL();
		$sql->connections();
		//过滤输入的字符
		$user_name = addcslashes($_POST['user_name'], $tostr);
		$user_password = addcslashes($_POST['user_password'], $tostr);
		
		$user = new User();
		$user->user_name = $user_name;
		$user->user_password = $user_password;
		$state = register($user);
		if($state == REGISTER_SUCCESS)
		{
			echo "注册成功！";
		}
		else if($state == REGISTER_FAILD)
		{
			echo "注册失败！";
		}
		else if($state == REGISTER_USER_EXISTS)
		{
			echo "用户已经存在！";
		}
	}
	else
	{
		echo "未知操作！";
	}
?>