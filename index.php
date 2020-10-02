<?php
$root = $_SERVER["DOCUMENT_ROOT"];
include($root."/secure/chngfoldernm.php");
/*require($root."/connect/db.php");
								$sql="select * from filenm;";
								$res = @mysqli_query($con,$sql)or die(mysqli_query($con));
								if (mysqli_num_rows($res)==0){
								die("fail");
								}
								$row=mysqli_fetch_array($res);
								$size=$row["name"];
								$tym=$row["time"];
								//echo($tym);
								$oneh = strtotime( "+1 hour", $tym );
								$present=time();
								if($present>$oneh){
									$newfnm=md5(rand(1000,9999));
									$sql="update filenm name set name='$newfnm',time='$present';";
									$res = @mysqli_query($con,$sql)or die(mysqli_query($con));
								}*/
?>
<html>
<head>
<title>oriel-free storage</title>
	<meta charset="UTF-8">
	 	
        <meta name="viewport" content="width= device-width, initial-scale=1">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="fa/css/fa.css">
		<link href="css/owl.carousel.css" rel="stylesheet" media="screen" />
		<link href="css/owl.theme.css" rel="stylesheet" media="screen" />
		<style>
			
			
		</style>
</head>
<body>
<div class="container-fluid bg-blu-dk">
	<div class="clearfix bg-blu">
		<div class="pull-left txt-wh"><h2>oriel</h2></div>
		
		<div class="pull-right txt-wh"><br/>
			<center>
			<span class="bg-blu-lt bd-rd-10 pd-2"><a href="login.php" class="txt-wh"><big>&nbsp;&nbsp;login <i class="fa fa-user"></i></big></a>&nbsp;&nbsp;</span>&nbsp;
			<span class="bg-blu-lt bd-rd-10 pd-2"><a href="signup.php" class="txt-wh"><big>&nbsp;&nbsp;signup <i class="fa fa-user-plus"></i></big></a>&nbsp;&nbsp;</span>
			</center>
		</div>
	</div>
</div>

<div class="container-fluid bg-blu-lt">
	<div class="row bg-blu">
		<div class="col-sm-2"></div>
		<div class="col-sm-8 txt-wh"><br/>
		<center><h2 class="pd-tp-0 mg-0"><big>Oriel</big> provides you a <b>free</b> cloud storage of 15gb extendable upto 17gb to store and access files anywhere and anytime...</h2> 
		<img src="images/4.png" class="img-responsive" style="max-width:42%;"><br />
		<a href="homepage.php" class="btn btn-success btn-lg pd-lt-40 pd-rt-40 bd-rd-30">GET STARTED</a><br/><br />
		</center>
		</div>
		<div class="col-sm-2"></div>
	</div>
</div>
</body>
</html>
