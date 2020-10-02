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
//$k=str_replace("htdocs","users",$root);
$id=$_SESSION["user_id"];	
$userfolder=$_SESSION["user_folder_md5"];
include($root."/secure/mainfolder.php");		
//$log_directory = $k."/".$id;
$log_directory = $root."/users/".$mainfold."/".$userfolder;	
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

$name = $log_directory."/".$url;	
//echo($name);
	if(is_file($name)){
		$sql="select * from files where uid='$id' and name='$url';";
		$res = @mysqli_query($con,$sql)or die("unable to execute query");
		if (mysqli_num_rows($res)==0){
			die("fail");
		}
		$row=mysqli_fetch_array($res);
		$size=$row["size"];
								
		$query="delete from files where uid='$id' and name='$url';";
		$res=mysqli_query($con,$query) or die(mysqli_error($con));										
		
		$query="update users set total=total-'$size' where id='$id'";
		$res=mysqli_query($con,$query) or die(mysqli_error($con));
		unlink("$name");
	}
	else{
		echo("absent");
	}
?>
