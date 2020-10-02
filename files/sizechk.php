
<?php
if(!isset($_POST['filenm']))
	header("location:/login.php");
	return;
?>
<?php
include('../connect/db.php');
	$id=$_SESSION["user_id"];
	$t=$_POST["filenm"];
	$query="select * from users where id='$id'";
	$res=mysqli_query($con,$query);
	if(mysqli_num_rows($res)==0){	
		die("fail");
	}
	else {	
		$row=mysqli_fetch_array($res);
		$tot=$row["total"];
		$frnd=$row["friends"];
		$total = 15728640+$frnd*524288;
		$newtot=$tot+$t;
		if($newtot>$total){
			echo("nopes");
		}
		else
			echo("ok");
	}
?>
