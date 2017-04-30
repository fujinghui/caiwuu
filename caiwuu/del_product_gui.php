<?php
session_start();
include_once("user.php");
include_once("tools.php");
?><!DOCTYPE >
<html>
	<head>
		<title>添加产品</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<script src="css/bootstrap-theme.min.css"></script>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</head>
	<body>
	<div style="width:400px;margin:0px auto">
		<label>请点击要删除的产品：</label>
		<ul class="list-group">
		
			<?php
				if(IsLogin())
				{
					$list = get_product_list(GetUser());
					for($i = 0; $i < count($list); $i ++)
					{
						//echo "<li class='list-group-item'>{$list[$i]->product_name} <a href='del_product.php?product_id={$list[$i]->product_id}'>删除</a></li>";
						echo "<a href='del_product.php?product_id={$list[$i]->product_id}' class='list-group-item list-group-item-info'>{$list[$i]->product_name}</a>";
					}
				}
			?>
		</ul>
	</div>
	</body>
</html>