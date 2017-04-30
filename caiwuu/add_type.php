<?php
	session_start();
	include_once("sql_connection.php");
	if(isset($_POST["type"]))
	{
		$type_name = $_POST["type"];
		$user_id = 0;
		$sql = new FSQL();
		$sql->connections();
		$sql_query = "insert into product_type values(null, '$type_name', $user_id)";
		//echo $sql_query;
		$result = $sql->query($sql_query);
		if($result === TRUE)
			echo "插入成功！";
		else
			echo "插入失败！";
		$sql->disconnect();
	}
	else
	{
		echo "未知操作！";
	}
?>