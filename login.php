 <?php
session_start();
if(isset($_SESSION["user_id"]) && isset($_SESSION["login_status"])){
	header("location:home.php");
	exit();
}

?>

<html>
	<head>
		<title>oriel-free storage</title>
		<meta charset="UTF-8">
			<meta name="viewport" content="width= device-width, initial-scale=1">
			<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
			<link rel="stylesheet" href="style.css">
			<link rel="stylesheet" href="fa/css/fa.css">
			<script src="bootstrap/js/jq.js"></script>
			<script src="js/custom.js"></script>
			
	</head>
	<body>
	<div class="container-fluid bg-blu-dk">
		<div class="clearfix bg-blu">
			<div class="pull-left txt-wh"><h2>oriel</h2></div>
			
			<div class="pull-right txt-wh"><br/>
				<center>
				<span class="bg-blu-lt bd-rd-10"><a href="signup.php" class="txt-wh"><big>&nbsp;&nbsp;signup <i class="fa fa-user-plus"></i></big></a>&nbsp;&nbsp;</span>
				</center>
			</div>
		</div>
	</div>
	<br />
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4 bg-blu-lt bx">
				<br /><br />
				<center>
				<img src="images/12.png"><br />
				<h2 class="txt-wh">Login</h2>
				</center>
				<div class="container-fluid bg-blu-dk"><br /><br />
					<div class="input-group ">
						<span class="input-group-addon"><i class=" fa fa-envelope txt-blk"></i></span>
						<input type="text" id="uid" class="form-control" placeholder="User Id" />
					</div><br />
					<div class="input-group ">
						<span class="input-group-addon"><i class=" fa fa-lock txt-blk"></i></span>
						<input type="password" id="pwd" class="form-control" placeholder="password" />
					</div><br />
					<button class="btn center-block bg-wh txt-blk bx" id ="btn-login" ><b>Login &nbsp;</b> <i class="fa fa-sign-in"></i></button> 
					<br />
					<br />
				</div><a href="signup.php" class="txt-wh"><center>New to Oriel ??? <b>signup</b></center></a><br />
				<center><b><p id="err" class="text-danger"></p></b></center>
				<br />
			</div>
			<div class="col-sm-4"></div>
		</div>
	</div>
	<br />
	<?php
	include("footer.php");
	?>
	</body>
</html>