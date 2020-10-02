<?php
session_start();
$root = $_SERVER["DOCUMENT_ROOT"];
include ($root."/connect/db.php");

	if( isset($_SESSION["login_status"]) ){
		$id=$_SESSION["user_id"];
			$sql="update users set status=0 where id='$id';";
			$res = @mysqli_query($con,$sql)or die(mysqli_error());
			$sql="delete from files where uid='$id';";
			$res = @mysqli_query($con,$sql)or die(mysqli_error());
		session_destroy();
		header("location:/index.php");
		exit();
	}
	
?>