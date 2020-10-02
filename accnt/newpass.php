<?php
if(!isset($_POST["chngold"]) || !isset($_POST["chngnew"]))
	exit();
$chngold= $_POST["chngold"];
$chngnew = $_POST["chngnew"];

session_start();
$root = $_SERVER["DOCUMENT_ROOT"];
include ($root."/connect/db.php");
$id=$_SESSION["user_id"];

$sql="select * from users where id='$id' and password='$chngold';";
		$res = @mysqli_query($con,$sql)or die("unable to execute query");
		if (mysqli_num_rows($res)==0){
			echo("wrngold");
		}
		else{
			$sql="update users set password='$chngnew' where id='$id' and password='$chngold';";
			$res = @mysqli_query($con,$sql)or die("unable to execute query");

			echo("success");
		}
?>