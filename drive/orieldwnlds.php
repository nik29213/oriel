<?php
if(isset($_GET["link"]))
$link=$_GET["link"];
include("../connect/db.php");
$sql="select * from files where link='$link';";
$res = @mysqli_query($con,$sql)or die("unable to execute query");
//echo($sql);
if (mysqli_num_rows($res)==0){
	echo("<div class='jumbotron'>invalid link<br />check the download link</div>");
}else{
	$row=mysqli_fetch_array($res);
	$type=$row["type"];
	$name=$row["name"];
	$id=$row["uid"];
	//echo($name.$size.$type);
	
	$sql="select * from users where id='$id';";
	$res = @mysqli_query($con,$sql)or die("unable to execute query");
	//echo($sql);
	if (mysqli_num_rows($res)==0){
		die("error");
	}else{
		$row=mysqli_fetch_array($res);
		$userfolder=$row["foldername"];
	}
	
	$root = $_SERVER["DOCUMENT_ROOT"];
	include($root."/secure/mainfolder.php");
		
	
	//$k=str_replace("htdocs","users",$root);
	//$log_directory = $k."/".$id;
	$log_directory = $root."/users/".$mainfold."/".$userfolder;							
	$data = file_get_contents($log_directory."/".$name);
if($type=="jpg" || $type=="png" ||$type=="jpeg"||$type=="gif"){
	header("Content-Type: image/jpg");
}
if($type=="pdf"){
	header("Content-Type: application/pdf");
}
echo($data);
}
?>