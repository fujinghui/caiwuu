<?php
	session_start();
	include_once("user.php");
	class S{
		public $name;
	}
	function change($t){
		$t->name = "femy";
	}
	$s = new S();
	$s->name = "fujinghui";
	echo "before:".$s->name."<br />";
	change($s);
	echo "after:".$s->name."<br />";
	echo "I can say:666????";
	
	
	
	if(isset($_SESSION['user']))
	{
		$user = unserialize($_SESSION['user']);
		echo "<br />";
		echo "<br />您已经登录<br />";
		echo "id:".$user->user_id."<br />";
		echo "user name:".$user->user_name."<br />";
		echo "user password:".$user->user_password."<br />";
	}
?>