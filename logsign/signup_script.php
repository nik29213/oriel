<?php
session_start();
include "../connect/db.php";
$root = $_SERVER["DOCUMENT_ROOT"];
//$k=str_replace("htdocs","users",$root);
$r = rand(100000,999999);
//mail();
$date=date('Y-m-d H:i:s');
	$nm=$_POST['uid'];
	$em=$_POST['email'];
	$pa=$_POST['password'];
	$country=$_POST['country'];
	$mob=$_POST['mob'];
	$slink=$_POST["slink"];
		if($slink!=""){
			$query="select id from users where share_link='$slink'";
			$run=mysqli_query($con,$query);
			if(mysqli_num_rows($run)==0){	
				die("fail");
			}
			else {	
				$row=mysqli_fetch_array($run);
				$uid=$row["id"];
				$frnds = $row["friends"];
			}
			if($frnds<4){
					$query="update users set friends=friends+1 where id='$uid' and share_link='$slink';";
					$res=mysqli_query($con,$query) or die(mysqli_error($con));
			}
		}
		//creating nd chking if fnm already there
		$pres=0;
		while($pres==0){
			$userfolder=md5(rand(1000,9999));
			$query = "SELECT * FROM users where foldername='$userfolder';";
			$res = @mysqli_query( $con, $query ) or die(mysqli_error($con));
			if(mysqli_num_rows($res)==0){	
				$pres=1;
			}
			else {	
				$pres=0;
			}	
		}
	$query="insert into users (email,username,password,country,phone,created_on,otp,share_link,foldername) VALUES('$em','$nm','$pa','$country','$mob','$date','$r','','$userfolder')";
	$res=mysqli_query($con,$query) or die(mysqli_error($con));
	
	$query="select id from users where email='$em' AND password='$pa' and username='$nm'";
	$run=mysqli_query($con,$query);
	if(mysqli_num_rows($run)==0){	
		die("fail");
	}
	else {	
		$row=mysqli_fetch_array($run);
		$uid=$row["id"];
		unset( $_SESSION["user_id"] );
		$_SESSION["user_id"]=$row["id"];
		$_SESSION["user_folder_md5"]=$userfolder;
		$_SESSION["lastnextid"]="mydrive";
		$root = $_SERVER["DOCUMENT_ROOT"];
		include($root."/secure/mainfolder.php");
		$name_p = $root."/users/".$mainfold."/".$userfolder;
		//$name_p=$k."/".$uid;
		if(!is_dir($name_p)){
			mkdir("$name_p");
			mkdir("$name_p/images");
			mkdir("$name_p/videos");
			mkdir("$name_p/documents");
			mkdir("$name_p/others");		
		}
		echo("success-$r");
	}
?>
