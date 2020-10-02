<?php
	session_start();
	if(!isset($_POST["uid"]) || !isset($_POST["password"])){
		header("location:index.php");
		//echo($_POST["uid"]." ". $_POST["password"]);
		exit();
	}
	$root = $_SERVER["DOCUMENT_ROOT"];
	require( $root."/connect/db.php" );
	$uid = $_POST["uid"];
	$pwd= $_POST["password"];
	$sql="select * from users where username='$uid' and password = BINARY '$pwd';";
	$res = @mysqli_query($con,$sql)or die("unable to execute query");
	if (mysqli_num_rows($res)==0){
		die("fail");
	}
	$row=mysqli_fetch_array($res);
	$_SESSION["user_id"]=$row["id"];
	$_SESSION["user_folder_md5"]=$row["foldername"];
	$_SESSION["login_status"]="true";
	$_SESSION["lastnextid"]="mydrive";
	$st=$row["status"];
	if($st==0)
	{
	echo("deactive");
	}
	else
	echo("success");
?>