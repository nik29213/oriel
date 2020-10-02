<?php
$name = ''; $type = ''; $size = ''; $error = '';
	function compress_image($source_url, $destination_url, $quality) {

		$info = getimagesize($source_url);

    		if ($info['mime'] == 'image/jpeg'){
        			$image = imagecreatefromjpeg($source_url);
					imagejpeg($image, $destination_url, $quality);
			}
			elseif ($info['mime'] == 'image/jpg'){
        			$image = imagecreatefromjpg($source_url);
					imagejpeg($image, $destination_url, $quality);
			}
			elseif ($info['mime'] == 'image/png'){
        			$image = imagecreatefrompng($source_url);
					$qual=$quality/10;
					if($qual>9)
						$qual=9;
					imagepng($image, $destination_url, $qual);
			}
			return filesize($destination_url);
	}
	
	function unlinkr($dir, $pattern = "*") {
    // find all files and folders matching pattern
    $files = glob($dir . "/$pattern"); 

    //interate thorugh the files and folders
    foreach($files as $file){ 
    //if it is a directory then re-call unlinkr function to delete files inside this directory     
        if (is_dir($file) and !in_array($file, array('..', '.')))  {
           // echo "<p>opening directory $file </p>";
            unlinkr($file, $pattern);
            //remove the directory itself
            //echo "<p> deleting directory $file </p>";
            rmdir($file);
        } else if(is_file($file) and ($file != __FILE__)) {
            // make sure you don't delete the current script
            echo "<p>deleting file $file </p>";
            unlink($file); 
        }
    }
}

?>

<html lang="en">
<head>
	<title>oriel</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/jquery.circliful.css">
	<script src="/bootstrap/js/jq.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="/js/jquery.circliful.js"></script>
   
   <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="fa/css/fa.css" rel="stylesheet">

<link href="/style.css" rel="stylesheet">
<script src="/bootstrap/js/bootstrap.min.js"></script>
<script src="/js/custom.js"></script>
   </head>
<body>
<nav class=" navbar navbar-inverse navbar-fixed bg-blu-dk bd-0">
	<div class="container-fluid">
		<div class="navbar-header">
		<div class="navbar-brand">
			<span class="txt-wh">oriel</span>
				
		</div>
		<button data-toggle="collapse"  data-target="#dropdown" class="toggle navbar-toggle" type="button">
		<span class="fa fa-bars txt-wh"></span>
		</button>
		</div>
		<div class="collapse navbar-collapse" id="dropdown">
			<ul class="nav navbar-nav navbar-right txt-wh">
				<li id="home"> <a href="/home.php"> my profile</a></li>
				<li id="profile"> <a href="/me.php"> my profile</a></li>
				<li id="space"> <a href="/space.php"> manage space</a></li>
				<li id="help"> <a href="/help.php"> help</a></li>
				<li id="logout"> <a href="/logout.php"> Logout <i class="fa fa-sign-out"></i></a></li>
			</ul>
		</div>
	</div>
</nav>
<?php
	if ($_POST) {
		$no_cmprsn=array();
		$cmprsn=array();
		$tmp_no_cmprsn=array();
		//$cpy_cmprsn=array();
		//print_r($_POST);
		$size=0;
            if (isset($_FILES['my_file'])) {
                $myFile = $_FILES['my_file'];
                $fileCount = count($myFile["name"]);
                for ($i = 0; $i < $fileCount; $i++) {
					$n=$i+1;
						$nm=$myFile["name"][$i];
						if($_POST["$n"]=='yes'){
							// take select box value whose cmprsn_no=n
							$cmprsn_val = $_POST["cmprsn_val$n"];
							$url = "../tmpfile/".$nm;
							$filesize = compress_image($myFile["tmp_name"][$i], $url, 50);
							$size+=$filesize;
							$cmprsn[]=$nm;
						}	
						else{
							$tmp_no_cmprsn[]=$myFile["tmp_name"][$i];
							$no_cmprsn[]=$nm;
							$size+=$myFile["size"][$i];	
						}
					$fnm=$myFile["tmp_name"][$i];
					$unm=$myFile["name"][$i];
					?>
                       
                    <?php
                }
				//end of for
				
					include('../connect/db.php');
					session_start();
					$id=$_SESSION["user_id"];
					$userfolder=$_SESSION["user_folder_md5"];
					$query="select * from users where id='$id'";
					$res=mysqli_query($con,$query);
					if(mysqli_num_rows($res)==0){	
						die("fail");
					}
					else {	
						$row=mysqli_fetch_array($res);
						$tot=$row["total"];
						$frnd=$row["friends"];
						$total = 15728640+$frnd*524288;
						$newtot=$tot+($size/1024);
							if($newtot>$total){
								$name="../tmpfile";
								if(is_dir($name)){
									echo($name);
									unlinkr($name);
									rmdir("$name");
									mkdir("$name");
								}
								//else{echo("not there");}
								$_SESSION["drivefull"] = true;
								header( "Location:/home.php" );
									
							}
							else{
								$size1=$size/1024;
								$root = $_SERVER["DOCUMENT_ROOT"];
								$userfolder=$_SESSION["user_folder_md5"];
								//$k=str_replace("htdocs","users",$root);
								$id=$_SESSION["user_id"];
								include($root."/secure/mainfolder.php");
								//$log_directory = $k."/".$id;
								$log_directory = $root."/users/".$mainfold."/".$userfolder;	
								$floc=$_POST["hid_loc"];
								if($floc!="")	
								$_SESSION["lastnextid"]=str_replace(" ","%20",$floc);
								else
								$_SESSION["lastnextid"]="mydrive";	
									$log_dir=$log_directory."/".$floc;
								
								foreach($cmprsn as $value)
									{
										$cp=str_replace(" ","%20",$log_dir."/".$value);
										copy("../tmpfile/".$value,$cp);	
										unlink("../tmpfile/".$value);										
										//db part starts
										if($floc!="")
											$loc=str_replace(" ","%20",$floc."/".$value);
										else
											$loc=str_replace(" ","%20",$value);
										$date=date('Y-m-d H:i:s');
										$size=filesize($log_dir."/".$value);
										$size=$size/1024;
										$size=round($size,2);
										$t = explode('.',$value);
										$extfile = end($t);
										$query="select * from files where name='$loc' and uid='$id';";
										$res=mysqli_query($con,$query) or die(mysqli_error($con));
										if (mysqli_num_rows($res)!=0){
											$row=mysqli_fetch_array($res);
											$delsize=$row["size"];
											$query="delete from files where uid='$id' and name='$loc';";
											$res=mysqli_query($con,$query) or die(mysqli_error($con));
											$query="update users set total=total-'$delsize' where id='$id';";
											$res=mysqli_query($con,$query) or die(mysqli_error($con));
										}
										$query="insert into files (uid,name,size,type,uploaded_on,link) VALUES('$id','$loc','$size','$extfile','$date','')";
										$res=mysqli_query($con,$query) or die(mysqli_error($con));
											//db part ends here
									}
									$i=0;
									foreach($no_cmprsn as $value)
									{			
										$tmp =str_replace(" ","%20",$tmp_no_cmprsn[$i]);
										$cptmp=str_replace(" ","%20",$log_dir."/".$value);
										copy($tmp,$cptmp);
										//echo($log_dir."/".$value);
										if($floc!="")
											$loc=str_replace(" ","%20",$floc."/".$value);
										else
											$loc=str_replace(" ","%20",$value);
										$date=date('Y-m-d H:i:s');
										$sval=str_replace(" ","%20",$value);
										$size=filesize($log_dir."/".$sval);
										$size=$size/1024;
                                       
										$size=round($size,2);
										$t = explode('.',$value);
										$extfile = end($t);
										$query="select * from files where name='$loc';";
										$res=mysqli_query($con,$query) or die(mysqli_error($con));
										
										if (mysqli_num_rows($res)!=0){
											$row=mysqli_fetch_array($res);
											$delsize=$row["size"];
											$query="delete from files where uid='$id' and name='$loc'";
											$res=mysqli_query($con,$query) or die(mysqli_error($con));
											$query="update users set total=total-'$delsize' where id='$id'";
											$res=mysqli_query($con,$query) or die(mysqli_error($con));
										}
										$query="insert into files (uid,name,size,type,uploaded_on,link) VALUES('$id','$loc','$size','$extfile','$date','')";
										$res=mysqli_query($con,$query) or die(mysqli_error($con));
										$i++;	
									}
									$query="update users set total=total+'$size1' where id='$id'";
										$res=mysqli_query($con,$query) or die(mysqli_error($con));
									$size1=round($size1,2);	
									$_SESSION["upsize"] = $size1;
									header( "Location:/home.php" );
																		
							}
							//require("../footer.php");
					}			
            }
	}
	else
		header("location:/login.php");
  ?>