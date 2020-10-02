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
//include $root."/connect/db.php";
//$k=str_replace("htdocs","users",$root);
$id=$_SESSION["user_id"];			
//$log_directory = $k."/".$id;
$userfolder=$_SESSION["user_folder_md5"];
include($root."/secure/mainfolder.php");
$log_directory = $root."/users/".$mainfold."/".$userfolder;	
								
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


$name = $log_directory."/".$url;	
//echo($name);
//-------------------------------------------------------
																			
function unlinkr($dir, $pattern = "*") {
    $files = glob($dir . "/$pattern"); 
    global $url,$name,$id,$root,$log_directory,$con,$mainfold,$userfolder;
    foreach($files as $file){ 
       
        if (is_dir($file) and !in_array($file, array('..', '.')))  {
			
            unlinkr($file, $pattern);
            rmdir($file);
        }
		else if(is_file($file) and ($file != __FILE__)) {
			//$delurl=$url."/".$furl;
				
            //echo "<p>deleting file $file</p>";
			$delf=str_replace($log_directory."/","",$file);
			echo "<p>deleting file $file</p><br />$delf********<br />";
			$query = "SELECT * FROM files where uid='$id' and name='$delf';";
				$res = @mysqli_query( $con, $query ) or die(mysqli_error($con));
				$s = 0;
				while( $row = mysqli_fetch_array($res) ){
					$s+=$row["size"];
				}
				//$u=$url."%";
				$query="delete from files where uid='$id' and name='$delf'";
				$res=mysqli_query($con,$query) or die(mysqli_error($con));										

				$query="update users set total=total-'$s' where id='$id'";
				$res=mysqli_query($con,$query) or die(mysqli_error($con));
            unlink($file); 
        }
    }
}
unlinkr($name);
echo("success");
?>
