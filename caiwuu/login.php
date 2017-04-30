<?php
	session_start();
	include_once("user.php");
	include_once("tools.php");
	include_once("sql_connection.php");
	header("Content-type:text/html;charset=utf-8");
	if(isset($_POST['user_name']) && isset($_POST['user_password']))
	{
		$sql = new FSQL();
		$sql->connections();
		$user_name = filter($_POST['user_name']);
		$user_password = filter($_POST['user_password']);
		
		$user = new User();
		$user->user_name = $user_name;
		$user->user_password = $user_password;
		$state = login($user);
		if($state == LOGIN_SUCCESS)
		{
			echo "login success!";
		}
		else
		{
			echo "login faild!";
		}
	}
?>