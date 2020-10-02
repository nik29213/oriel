<html lang="en">
<head>
	<title>oriel</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/jquery.circliful.css">
	<script src="/bootstrap/js/jq.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="/js/jquery.circliful.js"></script>
   
   <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="/fa/css/fa.css" rel="stylesheet">

<link href="/style.css" rel="stylesheet">
<script src="/bootstrap/js/bootstrap.min.js"></script>
<script src="/js/custom.js"></script>
   </head>
<body>
<nav class=" navbar navbar-inverse navbar-fixed bg-blu-dk bd-0">
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
				
				<li id="profile"> <a href="/index.php"> home</a></li>
				<li id="space"> <a href="/about.php"> about us</a></li>
				<li id="help"> <a href="/signup.php"> signup</a></li>
				<li id="logout"> <a href="/login.php"> Login <i class="fa fa-sign-out"></i></a></li>
			</ul>
		</div>
	</div>
</nav>
<?php
if(isset($_GET["link"]))
	$link=$_GET["link"];
include("../connect/db.php");
$sql="select * from files where link='$link';";
$res = @mysqli_query($con,$sql)or die("unable to execute query");
//echo($sql);
echo("<div class='container-fluid'>
		<div class='row'>
			<div class='col-sm-4'></div>
			<div class='col-sm-4'><img src='/images/1.png' class='img-responsive'></div>
			<div class='col-sm-4'></div>
		</div>
	</div>");
if (mysqli_num_rows($res)==0){
	
	echo("<div class='container-fluid'>
			<div class='row'>
				<div class='col-sm-3'></div>
				<div class='col-sm-6'>
					<div class='alert alert-warning'>
						<center><b><h2>invalid link<br />check the download link and retype</center>
					</div>
				</div>
				<div class='col-sm-3'></div>
			</div>
		</div>");
	//die(mysqli_error($con));
}else{
	$row=mysqli_fetch_array($res);
	$size=$row["size"];
	$type=$row["type"];
	$name=$row["name"];
	$t = explode('/',$name);
	$nm = end($t);
	echo("<div class='container-fluid'>
			<div class='row'>
				<div class='col-sm-2'></div>
				<div class='col-sm-8'>
					<div class='alert alert-success'><center><h2>$nm<br />$size kb</h2></center></div>
				</div>
				<div class='col-sm-2'></div>
			</div>
		</div>");
	
	if($type=="jpg" || $type=="png" ||$type=="jpeg"||$type=="gif"||$type=="pdf"){
		echo("<center><button class='btn btn-lg btn-primary bg-blu-lt txt-wh'><a class='txt-wh' href='orieldwnlds.php?link=$link'>view online</a></button></center>");
	}
	echo("<br /><center><button class='txt-wh btn btn-lg btn-primary bg-blu-lt txt-wh'><a class='txt-wh' href='orieldwnlds.php?link=$link' download='$nm'>download</a></button></center>");											
	
}
echo("<br /><br />");
include("../footer.php");
?>