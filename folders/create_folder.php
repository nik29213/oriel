<?php
session_start();
if (!isset(	$_SESSION["user_id"])){
	header("location:/login.php");
	exit();
}
?>
<?php
//include "connect/db.php";
$root = $_SERVER["DOCUMENT_ROOT"];
//$k=str_replace("htdocs","users",$root);
$id=$_SESSION["user_id"];
$userfolder=$_SESSION["user_folder_md5"];
include($root."/secure/mainfolder.php");
$log_directory = $root."/users/".$mainfold."/".$userfolder;	
											
//$log_directory = $k."/".$id;
$url = $_POST["folder_loc"];

$fname = $_POST["fname"];
if($url==""){
	$_SESSION["lastnextid"]="mydrive";
$name = $log_directory."/".$fname;
}
else{
	$_SESSION["lastnextid"]=str_replace(" ","%20",$url);
$name = $log_directory."/".$url."/".$fname;	
//echo($name);
}
$no_space=str_replace(" ","%20",$name);
	if(!is_dir($no_space)){
		mkdir("$no_space");
		//echo("success");
	}
	else{
		echo("present");
	}
?>
