<html lang="en">
<head>
	<title>oriel</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/jquery.circliful.css">
	<script src="bootstrap/js/jq.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="js/jquery.circliful.js"></script>
   
   <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="fa/css/fa.css" rel="stylesheet">

<link href="style.css" rel="stylesheet">
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="js/custom.js"></script>
<style>
.scrollToTop{
    width:50px; 
    height:60px;
    padding:0px; 
    text-align:center; 
    font-weight: bold;
    text-decoration: none;
    position:fixed;
    top:78%;
    right:20px;
    display:none;    
}
.outer {
    position: relative; 
    width: 100% !important; /* Maximum width */
    margin: 0px !important; /* Center it */
	background-size:cover !important;
	padding:0px;
	height:100%;
	display:inline-block;
	background-image:url("images/bg4.jpg");
}

.glass{
	
	background-color:black;
	opacity:0.7;
	padding-top:0px;
	margin:0px;
	height:100%;
	background-size:cover;
	color:white !important;
	font-family:Lucida Console;
}
.navbar-inner {
   background-color:black;
	opacity:0.8;
	
}
.mx-ht{
	max-height:300px;
}
</style>
</head>

<body>
<div class="jumbotron outer txt-wh">
		<div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                    <div class="container">
						<h2 class="pull-right">
							<a href="login.php">Login</a>&nbsp;
							<a href="signup.php">signup</a>
						</h2>
                        <div class="nav-collapse collapse">
                            <ul class="nav pull-right">
                                <li class="active"><a href="/">Home</a></li>
                                <li><a href="about">About</a></li>
                            </ul>
                        </div>
                    </div>
            </div>
        </div>

	<div class="container-fluid glass txt-wh">
		<div class="row txt-wh">
		
		<div class="col-sm-8 txt-wh">
			<br>
			<br><br>
			<h1 class="txt-wh"><big><big>ORIEL</big></big></h1>
			<br /><br />
			<h2>Free 15 gb storage<br /><br />
			save your memories...<br />  Protect files from any threat</h2>
			
			<br />
			<br/>
			
		</div>
		<div class="col-sm-4"></div>
		</div>
	</div>
</div>
<div class="well">
<center><H2 class="txt-blu-lt"><b>SIGNUP AND GET 15 GB FREE SPACE ON CLOUD</b></H2>

<a href="/signup.php" class="btn btn-primary btn-lg bg-blu-lt bd-rd-30 pd-lt-40 pd-rt-40">Sign up</a></center>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-6">
			<img src="images/lock.jpg" class="img-responsive mx-ht">
		</div>
		<div class="col-sm-6">
		<h2 class="txt-blu-lt">SECURE YOUR FILE WITH FULL ENCRYPTION</h2>
		<br />
		<h4><b>Your files will be fully encrypted and accessible only to you.So its time to get rid from the habit of carrying pen drives and memory cards.Store your files and memories on cloud and save expenses on storage devices</b></h4>
		</div>
	</div>                  
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-6">
			<h2 class="txt-blu-lt">AUTO SYNC TO ALL DEVICES</h2>
		<br />
		<h4><b>You can access your files from any device anytime and anywhere using your password</b></h4>
			
		</div>
		<div class="col-sm-6">
		<img src="images/bg6.jpg" class="img-responsive mx-ht">
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-6">
			<img src="images/share.jpg" class="img-responsive mx-ht">
		</div>
		<div class="col-sm-6">
		<h2 class="txt-blu-lt">SHARE YOUR FILES WITH YOUR FRIENDS </h2>
		<br />
		<h4><b>You can share your pictures with friends and files with people related to work even if they are not a member of Oriel</b></h4>
		</div>
	</div>
</div><br /><br />
<a href="#" class="scrollToTop txt-wh bg-blu-lt"><h1><i class="fa fa-angle-double-up"></i></h1></a>
<?php
include("footer.php");
?>
</body>
</html>