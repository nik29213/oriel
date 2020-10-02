<?php
session_start();
if (!isset(	$_SESSION["user_id"])){
	header("location:/login.php");
	exit();
}
?>
<?php
include "../connect/db.php";
$root = $_SERVER["DOCUMENT_ROOT"];
$k=str_replace("htdocs","users",$root);
$id=$_SESSION["user_id"];	
$userfolder=$_SESSION["user_folder_md5"];		
//$log_directory = $k."/".$id;
$url = $_POST["folder_loc"];

$url2 = "/".$url;
$lname = end(explode('/',$url2));
$floc = str_replace($lname,"",$url2);
if($floc!="/"){
	$sess = str_replace("/".$lname,"",$url);
	$_SESSION["lastnextid"]=str_replace(" ","%20",$sess);
}
else
	$_SESSION["lastnextid"]="mydrive";	


include($root."/secure/mainfolder.php");		
$log_directory = $root."/users/".$mainfold."/".$userfolder;
$name = $log_directory."/".$url;	

$r = rand(10000000,99999999);
//echo($name);
	if(is_file($name)){
		$sql="select * from files where uid='$id' and name='$url';";
		$res = @mysqli_query($con,$sql)or die("unable to execute query");
		if (mysqli_num_rows($res)==0){
			die("fail");
		}
		$row=mysqli_fetch_array($res);
		$id=$row["id"];
		$uid=$row["uid"];
		$dblink=$row["link"];
		if($dblink==""){
			$link=$id.$r.$uid;
			$query="update files set link='$link' where uid='$uid' and name='$url';";
			$res=mysqli_query($con,$query) or die(mysqli_error($con));
		}
		else
			echo("present");
		//echo($link);
	}	
?>
