<?php
	session_start();
	if( isset($_SESSION["login_status"]) ){
		session_destroy();
		header("location:index.php");
		exit();
	}
		header("location:index.php");
		exit();
?>