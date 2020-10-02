<?php
session_start();
if (!isset(	$_SESSION["user_id"])){
	header("location:/login.php");
	exit();
}
?>
<?php
$root = $_SERVER["DOCUMENT_ROOT"];
//$k=str_replace("htdocs","users",$root);
$id=$_SESSION["user_id"];	
$userfolder=$_SESSION["user_folder_md5"];
include($root."/secure/mainfolder.php");
$log_directory = $root."/users/".$mainfold."/".$userfolder;	
										
//$log_directory = $k."/".$id;
$url = $_POST["folder_loc"];
$lt="/".$url;
$lt1=end(explode('/',$lt));
$ltt=str_replace("/".$lt1,"",$lt);
if($ltt=="")
	$_SESSION["lastnextid"]="mydrive";
else{
	$lt2 = str_replace("/".$lt1,"",$url);
	$_SESSION["lastnextid"]=$lt2;
}

$url2 = $_POST["folder_loc"];
$fname = str_replace(" ","%20",$_POST["fname"]);
/*if($url=="")
$name = $log_directory."/".$fname;
else
$name = $log_directory."/".$url."/".$fname;
*/
$lname = end(explode('/',$url));
$db_new_name = str_replace($lname,$fname,$url);
$url = $log_directory."/".$url;

$new_name = str_replace($lname,$fname,$url);
	if(!is_dir($new_name)){
		$query = "SELECT * FROM files where name like '$url2%';";
		$res = @mysqli_query( $con, $query ) or die( mysqli_error($con) );
		while( $row = mysqli_fetch_array( $res ) ){
			$fid = $row["id"];
			$oldfilenm=$row["name"];
			$newfilenm = str_replace($url2,$db_new_name,$oldfilenm);
			$query1 = "update files set name='$newfilenm' where id='$fid';";
			@mysqli_query( $con, $query1 ) or die( mysqli_error($con) );
		}
		rename($url,$new_name);
		//$_SESSION["lastnextid"]=str_replace(" ","%20",$new_name);
		//echo("success");
	}
	else{
		echo("present");
	}
?>
