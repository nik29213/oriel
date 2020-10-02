<?php
	session_start();
	if(!isset($_POST["floc"])){
		header("location:index.php");
		//echo($_POST["uid"]." ". $_POST["password"]);
		exit();
	}
	$floc = $_POST["floc"];
	$_SESSION["lastnextid"]=$floc;
	echo("success");
?>