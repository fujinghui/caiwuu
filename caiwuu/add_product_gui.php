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
		<div style="width:400px;height:500px;margin:0px auto">
			<form method="post" action="add_product.php">
				<div class="form-group">
					<label class="col-sm-4 contorl-label">产&nbsp;&nbsp;品&nbsp;&nbsp;名：</label>
					<div class="col-sm-8">
						<input id="finput" type="text" class="form-control" placeholder="" name="product_name">
					</div>
				</div>
				
				<div class="form-group">
					<label class="">请选择产品类型：</label>
					<select class="form-control" name="type_id">
						<?php
							if(IsLogin())
							{
								$types = get_type_list(GetUser());
								echo count($types);
								for($i = 0; $i < count($types); $i ++)
								{
									echo "<option value='{$types[$i]->type_id}'>{$types[$i]->type_name}</option>";
								}
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<button type="submit" >添加</button>
				</div>
			</form>
		</div>
	</body>
</html>