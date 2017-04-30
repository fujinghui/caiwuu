<?php
	session_start();
	include_once("user.php");
	include_once("tools.php");
	
	
?>
<!DOCTYPE >
<html>
	<head>
		<title>仓库管理</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<script src="css/bootstrap-theme.min.css"></script>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</head>
	<body>
		<div style="width:400px;margin:0px auto">
			<div class="panel-group" id="accordion">
				
			<?php
				if(IsLogin())
				{
					$list = get_product_list(GetUser());
					//echo count($list);
					for($i = 0; $i < count($list); $i ++)
					{
						?>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#<?php echo "collapse_".$i; ?>">
									<?php
										echo $list[$i]->product_name;
									?>
									</a>
								</h4>
							</div>
							<div id="<?php echo "collapse_".$i; ?>" class="pane-collapse l-collapse collapse out">
								<div class="panel-body">
									<label>当前库存：<?php
										echo $list[$i]->store_house->product_number;
									?></label> <br />
									<button class="btn btn-info">入库</button>
									<button class="btn btn-info">出库</button>
								</div>
							</div>
						</div>
						<?php
					}
				}
			?>
			</div>
		</div>
	</body>
</html>