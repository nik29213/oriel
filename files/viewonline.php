<?php
session_start();
if(isset($_GET["flink"])){
	$fnm=$_GET["flink"];
	$root = $_SERVER["DOCUMENT_ROOT"];
								//$k=str_replace("htdocs","users",$root);
								$id=$_SESSION["user_id"];
								$userfolder=$_SESSION["user_folder_md5"];
								include($root."/secure/mainfolder.php");
								$log_directory = $root."/users/".$mainfold."/".$userfolder;	
								//$log_directory = $k."/".$id;
								
$data = file_get_contents($log_directory."/".$fnm);
//header("Content-Type: application/pdf");
//header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");

header("Content-Type: image/jpg");
echo($data);
}
else{
	
}
/*
------------------------gives file extension-----------------
$path_info = pathinfo('/foo/bar/baz.bill');

echo $path_info['extension']; // "bill"
*/
?>