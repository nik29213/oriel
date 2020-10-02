<?php
$root = $_SERVER["DOCUMENT_ROOT"];
include($root."/secure/chngfoldernm.php");
?>
<?php
 if(isset($_GET["slink"])){
	 $slink = $_GET["slink"];
 }
 else
	 $slink="";
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
		<style>
		</style>
		
</head>
<body>
<div class="container-fluid bg-blu-dk">
	<div class="clearfix bg-blu">
		<div class="pull-left txt-wh"><h2>oriel</h2></div>
		
		<div class="pull-right txt-wh"><br/>
			<center>
			<span class="bg-blu-lt bd-rd-10"><a href="login.php" class="txt-wh"><big>&nbsp;&nbsp;login <i class="fa fa-user"></i></big></a>&nbsp;&nbsp;</span>
			</center>
		</div>
	</div>
</div>
<br />
<h2 class="txt-blu-dk"><B><center>SIGNUP FOR FREE</center></B></h2><br />
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-1"></div>
		<div class="col-sm-4">
			<center><img src="images/5.jpg" width="100%"></center>
			<h2 class="txt-blu-dk mg-0">
			<ul class="">
				<li>15 gb disk space</li>
				<li>get 2gb free by suggesting oriel to friends</li>
				<li>secure backup</li>
				<li>store and access from any device</li>
				<li>maximum file size 10mb</li>
				<li>100% privacy</li>
				<li>save all your memories</li>
			</ul>
			</h2>
		</div>
		<div class="col-sm-6">
			
			<div class="container-fluid">
			<div class="panel panel-primary ">
						<div class="panel-heading ">
							<h4><big>S I G N&nbsp U P</big></h4>
						</div>
						<div class="panel-body">
							<center>
								<img src="images/signup.png" style="width:110px;height:90px; " >
							</center>
							<br>
							<div class="input-group">
								<input type="text" id="unm" placeholder="Enter username" class="form-control ">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							</div>
							<br>
							<div class="input-group">
								<input type="email" id="email" placeholder="Enter your email address" class="form-control ">
								<span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
								
							</div>
							<!--<p align="right" class="text-primary">an activation otp will be send on this email id</p>-->
							<br>
							<div class="input-group">
								<input type="password" id="pass" placeholder="Enter your password" class="form-control ">
								<span class="input-group-addon "><i class="glyphicon glyphicon-lock"></i></span>
							</div>
							<br>
							
							<div class="input-group">
								<input type="password" id="cnfrm_pass" placeholder="confirm password" class="form-control ">
								<span class="input-group-addon "><i class="glyphicon glyphicon-lock"></i></span>
							</div>
							<br>
							
							<div class="input-group">
								<select class="form-control" id="country">
									<?php include "country.php";?>
								</select>
								<span class="input-group-addon "><i class="glyphicon glyphicon-flag"></i></span>
							</div>
							<br>
							
							<div class="input-group">
								<input type="text" id="mobile" placeholder="Enter your Mobile number" class="form-control ">
								<span class="input-group-addon "><i class="glyphicon glyphicon-earphone"></i></span>
							</div>
							<br>
							
							<center>
								<p id="error_msg" class="txt-red"></p>
								<?php
								echo("<button type='submit' id='btn_sign' class='btn btn-primary' slink='$slink' style='color:white;'> <strong>S I G N U P</strong> </button>");
								?>
								<br>
							</center>
						</div>
			</div>
		</div>
		<div class="col-sm-1"></div>
	</div>
</div>
</body>
</html>