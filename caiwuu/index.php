<?php
	//link database
	include_once("sql_connection.php");
	$sql = new FSQL();
	$sql->connections();
	
	$result = $sql->query("select * from product_type");
	if($result && $result->num_rows >= 0)
	{
		echo "success!";
	}
	
	$sql->disconnect();
?>