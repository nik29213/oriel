<?php
session_start();
if (!isset(	$_SESSION["user_id"])){
	header("location:/login.php");
	exit();
}
?>
<?php
include('../connect/db.php');
$id=$_SESSION["user_id"];					
$root = $_SERVER["DOCUMENT_ROOT"];
include($root."/secure/mainfolder.php");
$k=str_replace("htdocs","users",$root);
$id=$_SESSION["user_id"];
$userfolder=$_SESSION["user_folder_md5"];
$log_directory = $root."/users/".$mainfold."/".$userfolder;			
//$log_directory = $k."/".$id;
$url = $_POST["folder_loc"];
$fname = str_replace(" ","%20",$_POST["fname"]);

$url1 = $log_directory."/".$url;
$lname = end(explode('/',$url1));
$new_name = str_replace($lname,$fname,$url1);

$url2 = "/".$url;

$floc = str_replace($lname,"",$url2);
if($floc!="/"){
	$sess = str_replace("/".$lname,"",$url);
	$_SESSION["lastnextid"]=str_replace(" ","%20",$sess);	
}
else
	$_SESSION["lastnextid"]="mydrive";	
								
$lname2 = end(explode('/',$url2));
$new_name2= str_replace($lname2,$fname,$url);
	//if(!is_file($new_name))
	if (file_exists($new_name))
	{
		echo("present");
		
	}
	else{
		$query="update files set name='$new_name2' where uid='$id' and name='$url'";
		$res=mysqli_query($con,$query) or die(mysqli_error($con));										
		rename($url1,$new_name);
	}
?>
