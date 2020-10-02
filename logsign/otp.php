<?php
//session_start();
/*if (!isset($_SESSION["user_id"])){
	header("location:/login.php");
	exit();
}*/
?>
<html>
<head>
<meta name="viewport" content="width= device-width, initial-scale=1">
<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="/style.css">
<link rel="stylesheet" href="/fa/css/fa.css">

<script src="/bootstrap/js/jq.js"></script>
<script src="/js/custom.js"></script>
</head>
<body>

<nav class=" navbar-inverse navbar navbar-default bg-blu-dk bd-0">
	<div class="container-fluid">
		<div class="navbar-header">
		<div class="navbar-brand">
			<span class="txt-wh">oriel</span>
				
		</div>
		<button data-toggle="collapse"  data-target="#dropdown" class="toggle navbar-toggle" type="button">
		<span class="fa fa-bars txt-wh"></span>
		</button>
		</div>
		<div class="collapse navbar-collapse" id="dropdown">
			<ul class="nav navbar-nav navbar-right txt-wh">
				
				<li> <a href="/homepage.php"> home</a></li>
				<li> <a href="/login.php"> login</a></li>
				<li> <a href="/logout.php"> logout</a></li>
				<li> <a href="/features.php"> features</a></li>
			</ul>
		</div>
	</div>
</nav>
<div class="jumbotron txt-blu-dk"><center><h2>Enter the otp sent to your email id</h2></center></div>
<br /><br />

<div class="container-fluid">
<div class="row">
<div class="col-sm-4"></div>
<div class="col-sm-4 bg-blu-dk bd-rd-10">
	<br /><br /><br />
	<input id="otpp" class="form-control" placeholder="* * * * * *">
	<br />
	<center>
	<?php
	session_start();
	include "../connect/db.php";
	$id=$_SESSION["user_id"];
	$query="select otp from users where id='$id'";
	$res=mysqli_query($con,$query);
	if(mysqli_num_rows($res)==0){	
		die("fail");
	}
	else {	
	$row=mysqli_fetch_array($res);
	$otp=$row["otp"];
	}
	echo("<a id='verify' send_otp='$otp' class='btn btn-lg btn-primary'>verify</a>");
	?>
	</center>
	<br />
</div>
<div class="col-sm-4"></div>
</div>
</div>
<br /><br /><br /><br />
<?php
require("../footer.php");
?>
</body>
</html>