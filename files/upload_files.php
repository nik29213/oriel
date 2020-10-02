<?php
if(!isset($_GET['floc']))
	return;
$floc =str_replace(" ","%20",$_GET['floc']);
?>
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
				
				<li id="profile"> <a href="/me.php"> my profile</a></li>
				<li id="space"> <a href="/space.php"> manage space</a></li>
				<li id="help"> <a href="/help.php"> help</a></li>
				<li id="logout"> <a href="/logout.php"> Logout <i class="fa fa-sign-out"></i></a></li>
			</ul>
		</div>
	</div>
</nav>
<form id="upload_file_submit" action="upload.php" method="post" enctype="multipart/form-data">
<div class = "container">
	<SPAN class="txt-blu-dk"><h2>UPLOAD FILES</h2></SPAN>
	<div class="row">
		<div class="col-sm-7 well txt-blu-lt">
			<br />
			<?php
			echo("<input id='files' type='file' name='my_file[]' floc='$floc' multiple>");
			?>
			<br />
			<span class="txt-blk">* max file size of each file is 10mb</span>
		</div>
		<div class="col-sm-5">
			<img src="../images/up.png" width='30%'>
		</div>
	</div>
</div>
<?php
				echo("<div class='container-fluid disp-none upcontainer'>
					<div class='table-responsive'>
							<table class='table table-responsive table-bordered table-striped' id='uploadshow'>
								<tr><th class='text-center'>file name</th><th class='text-center'>size(in kb)</th>
									<th class='text-center'>upload</th>
								</tr>");
					if($floc=="''")
						$floc="";
               	
				echo("</table>");
						echo("</div>
						<center><button class='btn bg-blu-lt btn-lg' id='file-up-sub'>upload now</button></center>
						</div>
							
						<input type='text' name='hid_loc' class='disp-none' value='$floc'>
					");
?>
</form>

</body>
</html>