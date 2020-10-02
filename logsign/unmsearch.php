<?php
$root = $_SERVER["DOCUMENT_ROOT"];
include ($root."/connect/db.php");

if(!isset($_POST["email"]) || !isset($_POST["name"]))
	exit();
$email= $_POST["email"];
$unm = $_POST["name"];
		$sql="select * from users where email='$email';";
		$res = @mysqli_query($con,$sql)or die("unable to execute query");
		if (mysqli_num_rows($res)==0){
			$sql="select * from users where username='$unm';";
			$res = @mysqli_query($con,$sql)or die("unable to execute query");
			if (mysqli_num_rows($res)==0){
				echo("success");
			}
			else{
				die("unm_error");
			}
		}
		else{
			die("email_error");
		}
		
?>