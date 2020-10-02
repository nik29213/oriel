<?php
session_start();
include "../connect/db.php";
$id=$_SESSION["user_id"];
$query="select * from users where id='$id'";
	$run=mysqli_query($con,$query);
	if(mysqli_num_rows($run)==0){	
		die("fail");
	}
	else {	
		$row=mysqli_fetch_array($run);
		$unm=$row["username"];
		$r = rand(1000,9999);
		$r1 = rand(1000,9999);
		
		$share=$r.$id.$r1;
	}
$query="update users set status='1',otp_verify='1',share_link='$share' where id='$id'";
	$res=@mysqli_query($con,$query) or die(mysqli_error($con));
	
	$_SESSION["login_status"]="true";
		//change lines nd make login status true
		header("location:/home.php");
?>