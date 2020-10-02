<?php
if(!isset($_POST["pcountry"]) || !isset($_POST["pemail"]))
	exit();
$pemail= $_POST["pemail"];
$pcountry = $_POST["pcountry"];
$pphone = $_POST["pphone"];

session_start();
$root = $_SERVER["DOCUMENT_ROOT"];
include ($root."/connect/db.php");
$id=$_SESSION["user_id"];

$sql="select * from users where id='$id';";
		$res = @mysqli_query($con,$sql)or die("unable to execute query");
		if (mysqli_num_rows($res)==0){
			echo("error");
		}
		else{
			$sql="update users set email='$pemail',country='$pcountry',phone='$pphone' where id='$id';";
			$res = @mysqli_query($con,$sql)or die("unable to execute query");

			echo("success");
		}
?>