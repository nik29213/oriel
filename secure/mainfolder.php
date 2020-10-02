<?php
$root = $_SERVER["DOCUMENT_ROOT"];
require($root."/connect/db.php");
								$sql="select * from filenm;";
								$res = @mysqli_query($con,$sql)or die(mysqli_query($con));
								if (mysqli_num_rows($res)==0){
								die("fail");
								}
								$row=mysqli_fetch_array($res);
								$mainfold=$row["name"];
								//$tym=$row["time"];
								//echo($tym);
								
?>
