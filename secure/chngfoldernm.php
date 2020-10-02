<?php
$root = $_SERVER["DOCUMENT_ROOT"];
require($root."/connect/db.php");
								$sql="select * from filenm;";
								$res = @mysqli_query($con,$sql)or die(mysqli_query($con));
								if (mysqli_num_rows($res)==0){
								die("fail");
								}
								$row=mysqli_fetch_array($res);
								$nm=$row["name"];
								$tym=$row["time"];
								//echo($tym);
								$oneh = strtotime( "+1 hour", $tym );
								$present=time();
								if($present>$oneh){
									$newfnm=md5(rand(1000,9999));
									$sql="update filenm name set name='$newfnm',time='$present';";
									$oldnm=$root."/users/".$nm;
									$newnm=$root."/users/".$newfnm;
									//echo($oldnm."<br />".$newnm);
									$res = @mysqli_query($con,$sql)or die(mysqli_query($con));
									rename($oldnm,$newnm);
								}
?>
