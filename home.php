<?php
session_start();

if (!isset(	$_SESSION["user_id"])  || !isset($_SESSION["login_status"])){
	header("location:login.php");
	exit();
}
include('connect/db.php');
	$id=$_SESSION["user_id"];
	
//cal % for piechart
	$query="select * from users where id='$id'";
	$res=mysqli_query($con,$query);
	if(mysqli_num_rows($res)==0){	
		die("fail");
	}
	else {	
	$row=mysqli_fetch_array($res);
	$tot=$row["total"];
	$frnd=$row["friends"];
	//giving 512 mb for friend suggestion 15 gb main space and min unit is kb
	$per=$tot*100/(15728640+$frnd*524288);
	$tot_frnd=0.5*$frnd;
	$per = round($per,2);
	//echo($per);
	if($tot<=1024)
		$used=$tot."kb";
	else{
		$used_mb=round($tot/1024,2);
		if($used_mb<=1024)
			$used=$used_mb."mb";
		else{
			$used=round($used_mb/1024,2);
		$used=$used."gb";}
	}
	$tot_given=15728640+$frnd*524288;
	$tot_used= $tot;
	$tot_avail=$tot_given-$tot_used;
		if($tot_avail<=1024)
			$avail=$tot_avail."kb";
		else{
			$avail_mb=round($tot_avail/1024,2);
			if($avail_mb<=1024)
				$avail=$avail_mb."mb";
			else{
				$avail=round($avail_mb/1024,2);
			$avail=$avail."gb";}
		}
	}
?>
<?php
include "connect/db.php";
$root = $_SERVER["DOCUMENT_ROOT"];
//$k=str_replace("htdocs","users",$root);
			
//$log_directory = $k."/".$id;
$userfolder=$_SESSION["user_folder_md5"];
include($root."/secure/mainfolder.php");
$log_directory = $root."/users/".$mainfold."/".$userfolder;	

$folder_array = array();
$file_array = array();
$all_array = array();

if (is_dir($log_directory))
{
        if ($handle = opendir($log_directory))
        {
                while(($file = readdir($handle)) !== FALSE)
                {
					
					if($file !='.' && $file !='..'){
						$all_array[] =$file;
						}
                }
                closedir($handle);
        }
}
foreach($all_array as $value)
{
	if(is_dir($log_directory."/".$value))
	$folder_array[]=$value;	
	else
	$file_array[]=$value;
}
?>
<?php
$pathLen = 0;
function listing($link){
//$root = '/xampp/users/8';
include "connect/db.php";
$root = $_SERVER["DOCUMENT_ROOT"];
//$k=str_replace("htdocs","users",$root);
$id=$_SESSION["user_id"];
$userfolder=$_SESSION["user_folder_md5"];
include($root."/secure/mainfolder.php");
$log_directory = $root."/users/".$mainfold."/".$userfolder;	
				
//$log_directory = $k."/".$id;

$log_dir = $log_directory.$link;
$folder_array = array();
$file_array = array();
$all_array = array();
$count=0;
if (is_dir($log_dir))
{
        if ($handle = opendir($log_dir))
        {
                while(($file = readdir($handle)) !== FALSE)
                {
					if($file !='.' && $file !='..'){
						$all_array[] =$file;
						$count++;
						//echo("<span class='txt-blk'>$file</span>");
						}
                }
                closedir($handle);
        }
}
foreach($all_array as $value1)
{
	if(is_dir($log_dir."/".$value1))
	$folder_array[]=$value1;
	else
	$file_array[]=$value1;
}
$lid=substr($link, 1);
$p=substr($link, 0, strrpos( $link, '/') );
$p=substr($p,1);
if($p=='')
	$p="mydrive";	
$dolink=str_replace("%20"," ",$link);
	echo("<div class='panel panel-primary mg-0 hid disp-none' nextid='$lid'>
						<div class='panel-heading'>
							<h5><a class='txt-wh back btn' prev='$p'><big><big><i class='fa fa-arrow-left'></i></big></big></a> &nbsp;my drive  $dolink</h5>
						</div>
						<div class='panel-body'>
						
						<div class='container-fluid'><div class='row'>
							<div class='col-sm-6'>
								<button href='' class='folder_create bg-tr' floc='$lid'>
								<big><big><big><big><big><big> <i class='fa fa-plus txt-blk'></i></big></big></big></big></big></big>
								<span class='txt-blk'><b>Add new folder &nbsp;</b></span>	
								</button>
							</div>
							
							<div class='col-sm-6'>
								<a href='files/upload_files.php?floc=$lid' class='bg-tr file_up btn' floc='$lid'>
									<big><big><big><big><big><big> <i class='fa fa-upload txt-blk'></i></big></big></big></big></big></big>
									<span class='txt-blk'><b> upload files</b></span>
								</a>
							</div>");
							
						echo("</div></div>
						
			<hr class='mg-0 pd-0'/>");
						
							foreach($folder_array as $value)
							{	$cmplt_id = $lid."/".$value;
								/*echo("<div class='well pd-0'>
										<div class='row'>
										<div class='col-sm-10'>
										<button href='' class='root_folder txt-blk fold-next btn-block text-left bg-tr' value='$cmplt_id'>
										<h4> &nbsp;<i class='fa fa-folder txt-blu-lt'></i> $value</h4>
										</button>
										</div>
										<div class='col-sm-1'>
										<select class='form-control select_folder' select_link='$cmplt_id' floc='$cmplt_id'>
											<option></option>
											<option value='rename'>rename</option>
											
											<option value='fdelete'>delete folder</option>
											<option value='clear'>clear folder</option>
										</select>
										</div>
										<div class='col-sm-1'>
										<input type='checkbox' class='form-control'>
										</div>
										</div>
									</div>");*/
									$no_space=str_replace("%20"," ",$value);
									$words  = explode(' ', $no_space);
									$longestWordLength = 0;
									foreach ($words as $word) {
									   if (strlen($word) > $longestWordLength) {
										  $longestWordLength = strlen($word);
									   }
									}
									if($longestWordLength>20)
										$no_space="...".substr($no_space,strlen($no_space)-17);
									
									echo("<div class='well input-group pd-0'>
											<button href='' class='root_folder form-control txt-blk fold-next btn-block text-left bg-tr' value='$cmplt_id'>
												<h4> &nbsp;<i class='fa fa-folder txt-blu-lt z1'></i> $no_space</h4>
											</button>
										<span class='input-group-addon bg-tr'>
												<select class='form-control select_folder' select_link='$cmplt_id' floc='$cmplt_id'>
													<option></option>
													<option value='rename'>rename</option>
													
													<option value='fdelete'>delete folder</option>
													<option value='clear'>clear folder</option>
												</select>
										</span>
									</div>");
							}
							foreach($file_array as $value)
							{	
								$cmplt_id = $lid."/".$value;
								$sql="select * from files where uid='$id' and name='$cmplt_id';";
								$res = @mysqli_query($con,$sql)or die("unable to execute query");
								//echo($sql);
								if (mysqli_num_rows($res)==0){
									die(mysqli_error($con));
								}else{
									$row=mysqli_fetch_array($res);
									$size=$row["size"];
									$type=$row["type"];
									$flink = $row["link"];
									$date = $row["uploaded_on"];	
								}
								/*echo("
									<div class='well pd-0'>
										<div class='row'>
											<div class='col-sm-10'>
												<label href='' class='txt-blk btn-block text-left bg-tr' value='$cmplt_id' type='$type'>
												<h4> &nbsp;<i class='fa fa-file txt-blu-lt'></i> $value </h4>size : $size kb<br />created on : $date");
												if($flink!=""){
													echo("<br /><span>link : </span><span id='cp_$flink'>oriel.ml/drive/dwnldfile.php?link=$flink</span>
																
															<a href='' class='btt' btlink='$flink'><i class='fa fa-clipboard' title='copy link to share'></i></a>
														");
													
												}
												echo("</label>
											</div>
											<div class='col-sm-1'>
												<select class='form-control select_file' select_link='$cmplt_id' floc='$cmplt_id'>
												<option><i class='fa fa-list'></i></option>
												<option value='download'>download</option>
												<option value='rename'>rename</option>
												<option value='create_link'>create link</option>
												<option value='fdelete'>delete</option>");
												if($type=="jpg" || $type=="png" ||$type=="jpeg"||$type=="gif"||$type=="pdf"){
													echo("<option value='viewon'>view online</option>");
												}
												echo("</select>
											</div>
											<div class='col-sm-1'>
												<input type='checkbox' class='form-control'>
											</div>
										</div>
									</div>
								");*/
								$no_space=str_replace("%20"," ",$value);
								$words  = explode(' ', $no_space);
									$longestWordLength = 0;
									foreach ($words as $word) {
									   if (strlen($word) > $longestWordLength) {
										  $longestWordLength = strlen($word);
									   }
									}
									if($longestWordLength>20)
										$no_space="...".substr($no_space,strlen($no_space)-17);
									
								echo("
									<div class='well input-group pd-0'>
										<label href='' class='txt-blk btn-block text-left bg-tr' value='$cmplt_id' type='$type' style='font-size:x-small;'>
												<h5><b> &nbsp;<i class='fa fa-file z1 txt-blu-lt'></i> $no_space</b></h5>size : $size kb<br />created on : $date");
												if($flink!=""){
													echo("<br />link : <span id='cp_$flink'>oriel.ml/drive/dwnldfile.php?link=$flink</span>
																
															<a href='' class='btt' btlink='$flink' style='font-size:medium;'><i class='fa fa-clipboard' title='copy link to share'></i></a>
														");	
												}
												echo("</label>
												<span class='input-group-addon bg-tr'>
												<select class='form-control select_file' select_link='$cmplt_id' floc='$cmplt_id' type='$type'>
													<option></option>
													<option value='download'>download</option>
													<option value='rename'>rename</option>
													<option value='create_link'>create link</option>
													<option value='fdelete'>delete</option>");
												if($type=="jpg" || $type=="png" ||$type=="jpeg"||$type=="gif"||$type=="pdf"){
													echo("<option value='viewon'>view online</option>");
												}
												echo("</select>
												</span>
												
									</div>");
							}
						if ($count==0){
							echo("<br /><div class='jumbotron txt-blu-dk'><center><big>empty folder</big></center></div>");
						}
						echo("</div>
		</div>");
}
function myScanDir($dir, $level, $rootLen){
  global $pathLen;
  if ($handle = opendir($dir)) {
    $allFiles = array();
    while (false !== ($entry = readdir($handle))) {
      if ($entry != "." && $entry != "..") {
        if (is_dir($dir . "/" . $entry))
        {
          $allFiles[] = "D: " . $dir . "/" . $entry;
        }
        else
        {
          $allFiles[] = "F: " . $dir . "/" . $entry;
        }
      }
    }
    closedir($handle);
    natsort($allFiles);
    foreach($allFiles as $value)
    {
      $displayName = substr($value, $rootLen + 4);
      $fileName    = substr($value, 3);
      $linkName    = str_replace(" ", "%20", substr($value, $pathLen + 3));
      if (is_dir($fileName)) {
        //echo "<i class='fa fa-folder'></i>" . $linkName . "<br>\n";
		listing($linkName);
		//echo("<br />");
        myScanDir($fileName, $level + 1, strlen($fileName));
      } 
	  else {
        
      }
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
	<script src="bootstrap/js/jq.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="js/jquery.circliful.js"></script>
   
   <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="fa/css/fa.css" rel="stylesheet">

<link href="style.css" rel="stylesheet">
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="js/custom.js"></script>
<script>
$(document).ready(function(){
	
	$(".btt").click( function(){
		//alert("hmmm");
		//$("#tt").select();
		//document.execCommand("Copy");
		//alert("Copied the text");
		var id = $(this).attr("btlink");
		var $temp = $("<div>");
		$("body").append($temp);
		$temp.attr("contenteditable", true)
			   .html($("#cp_"+id ).html()).select()
			   .on("focus", function() { document.execCommand('selectAll',false,null) })
			   .focus();
		document.execCommand("copy");
		$temp.remove();
		alert("link copied to clipboard");
	});
	
});	
</script>

   </head>
   
<body>
<?php
//echo("dfgv".$_SESSION["lastnextid"].$_SESSION["user_folder_md5"]);
?>
<nav class=" navbar navbar-inverse navbar-fixed bg-blu-dk bd-0">
	<div class="container-fluid">
		<div class="navbar-header">
		<div class="navbar-brand">
			<span class="txt-wh">Oriel</span>	
		</div>
		<button data-toggle="collapse"  data-target="#dropdown" class="toggle navbar-toggle" type="button">
		<span class="fa fa-bars txt-wh"></span>
		</button>
		</div>
		<div class="collapse navbar-collapse" id="dropdown">
			<ul class="nav navbar-nav navbar-right txt-wh">
				
				<li id="profile"> <a href="me.php"> my profile</a></li>
				<li id="space"> <a href="space.php"> space details</a></li>
				<li id="help"> <a href="help.php"> help</a></li>
				<li id="logout"> <a href="logout.php"> Logout <i class="fa fa-sign-out"></i></a></li>
			</ul>
		</div>
	</div>
</nav>
<!-------------------------drive--------------------->
<div class="container-fluid">
	<div class="well pd-0 mg-0">
		<div class="clearfix">
		<span class="pull-left txt-blu-lt">&nbsp; <b>M Y &nbsp;&nbsp;&nbsp;D R I V E</b></span>
		<?php
					$query = "SELECT username from users where id='$id';";
					$res = @mysqli_query( $con, $query );
					$row = mysqli_fetch_array($res);
					$unm = $row["username"];
					$unm = strtoupper($unm);
					echo("
						<span class='pull-right'>Logged in as : <a href=''>$unm &nbsp;</a></span></div>
					");
		?>
	</div>
	<br />
	<div class="row">
		<div class="col-sm-1"></div>
		<div class="col-sm-8">
			<br />
			<?php
				if(isset($_SESSION["upsize"])){
					$s = $_SESSION["upsize"];
                       
					echo("
						<div class='alert alert-success alert-dismissable'>
							<a href='#' class='close' data-dismiss='alert'>&times;</a>
							Total Upload Size : $s KB
                           
						</div>
					");
					unset( $_SESSION["upsize"] );
                        unset( $_SESSION["lastsize"] );
				}
			?>
			<?php
				if(isset($_SESSION["drivefull"])){
					$s = $_SESSION["drivefull"];
					echo("
						<div class='alert alert-warning alert-dismissable'>
							<a href='#' class='close' data-dismiss='alert'>&times;</a>
							Not enough space in drive<br />Delete some files to upload your files.
						</div>
					");
					unset( $_SESSION["drivefull"] );
				}
			?>
			<div class="panel panel-primary mg-0 hid my" nextid="mydrive">
						<div class="panel-heading ">
							<h5>MY DRIVE</h5>
						</div>
						<div class="panel-body">
						
						<div class='container-fluid'><div class='row'>
							<div class='col-sm-6'>
								<button class='folder_create bg-tr' floc="">
								<big><big><big><big><big><big> <i class='fa fa-plus txt-blk'></i></big></big></big></big></big></big>
								<span class='txt-blk'><b>Add new folder &nbsp;</b></span>	
								</button>
								</div>
							<div class='col-sm-6'>
								<a href="files/upload_files.php?floc=''" class='bg-tr file_up btn' floc="">
									<big><big><big><big><big><big> <i class='fa fa-upload txt-blk'></i></big></big></big></big></big></big>
									<span class='txt-blk'><b> upload files</b></span>
								</a>
							</div>
							<!--<div class='col-sm-4'>
								<button href='' class='bg-tr'>
								<big><big><big><big><big><big> <i class='fa fa-upload txt-blk'></i></big></big></big></big></big></big><span class='txt-blk'><b> upload folders</b></span>
								</button>
								</div>-->
						</div></div>
						<hr class='mg-0 pd-0'/><br />
						<?php
							foreach($folder_array as $value)
							{
								$val= $value;
								/*echo("<div class='well pd-0' value='$val'>
										<div class='row'>
											<div class='col-xs-11'>
												<button href='' class='root_folder txt-blk fold-next btn-block text-left bg-tr' value='$val'>
												<h4> &nbsp;<i class='fa fa-folder txt-blu-lt'></i> $value</h4>
												</button>
											</div>
											<div class='col-xs-1'>
												<select class='form-control select_folder' select_link='$val' floc='$val'>
												<option><i class='fa fa-list'></i></option>
												<option value='rename'>rename</option>
												
												<option value='fdelete'>delete</option>
												<option value='clear'>clear folder</option>
												</select>
											</div>
											
										</div>
									</div>");*/
									$no_space=str_replace("%20"," ",$value);
									$words  = explode(' ', $no_space);
									$longestWordLength = 0;
									foreach ($words as $word) {
									   if (strlen($word) > $longestWordLength) {
										  $longestWordLength = strlen($word);
									   }
									}
									if($longestWordLength>20)
										$no_space="...".substr($no_space,strlen($no_space)-17);
									echo("<div class='well input-group pd-0' value='$val'>
										<button href='' class='root_folder form-control txt-blk fold-next btn-block text-left bg-tr' value='$val'>
										<h5><b> &nbsp;<i class='fa fa-folder txt-blu-lt z1'></i> $no_space</b></h5>
										</button>
										<span class='input-group-addon bg-tr'>
												<select class='form-control select_folder' select_link='$val' floc='$val'>
												<option></option>
												<option value='rename'>rename</option>
												
												<option value='fdelete'>delete</option>
												<option value='clear'>clear folder</option>
												</select>
										</span>
									</div>");
							}
							foreach($file_array as $value)
							{	
								$sql="select * from files where uid='$id' and name='$value';";
								$res = @mysqli_query($con,$sql)or die("unable to execute query");
								if (mysqli_num_rows($res)==0){
								die("fail");
								}
								$row=mysqli_fetch_array($res);
								$size=$row["size"];
								$type=$row["type"];
								$date = $row["uploaded_on"];
								$flink=$row["link"];
								/*echo("
									<div class='well pd-0'>
										<div class='row'>
											<div class='col-sm-10 col-xs-10'>
												<label href='' class='txt-blk btn-block text-left bg-tr' value='$value'>
												<h4> &nbsp;<i class='fa fa-file txt-blu-lt'></i> $value</h4>size : $size kb<br />created on : $date");
												if($flink!=""){
													echo("<br /><span>link : </span><span id='cp_$flink'>oriel.ml/drive/dwnldfile.php?link=$flink</span>
																
															<a href='' class='btt' btlink='$flink'><i class='fa fa-clipboard' title='copy link to share'></i></a>
														");
													
												}
												echo("</label>
											</div>
											<div class='col-sm-1 col-xs-1'>
												<select class='form-control select_file' select_link='$value' floc='$value' type='$type'>
												<option><i class='fa fa-list'></i></option>
												<option value='download'>download</option>
												<option value='rename'>rename</option>
												<option value='create_link'>create link</option>
												<option value='fdelete'>delete</option>");
												if($type=="jpg" || $type=="png" ||$type=="jpeg"||$type=="gif"||$type=="pdf"){
													echo("<option value='viewon'>view online</option>");
												}
												echo("</select>
											</div>
											<div class='col-sm-1 col-xs-1'>
												<input type='checkbox' class='form-control'>
											</div>
										</div>
									</div>
									");	*/
									$no_space=str_replace("%20"," ",$value);
									$words  = explode(' ', $no_space);
									$longestWordLength = 0;
									foreach ($words as $word) {
									   if (strlen($word) > $longestWordLength) {
										  $longestWordLength = strlen($word);
									   }
									}
									if($longestWordLength>20)
										$no_space="...".substr($no_space,strlen($no_space)-17);
									echo("
									<div class='well input-group pd-0'>
										<label href='' class='txt-blk btn-block text-left bg-tr' value='$value' style='font-size:x-small;'>
												<h5><b> &nbsp; <i class='fa fa-file z1 txt-blu-lt'></i> $no_space</b></h5>size : $size kb<br />created on : $date");
												if($flink!=""){
													echo("<br />link : <span id='cp_$flink'>oriel.ml/drive/dwnldfile.php?link=$flink</span>
																
															<a href='' class='btt' btlink='$flink' style='font-size:medium;'><i class='fa fa-clipboard' title='copy link to share'></i></a>
														");
													
												}
												echo("</label>
												<span class='input-group-addon bg-tr'>
												<select class='form-control select_file' select_link='$value' floc='$value' type='$type'>
													<option></option>
													<option value='download'>download</option>
													<option value='rename'>rename</option>
													<option value='create_link'>create link</option>
													<option value='fdelete'>delete</option>");
												if($type=="jpg" || $type=="png" ||$type=="jpeg"||$type=="gif"||$type=="pdf"){
													echo("<option value='viewon'>view online</option>");
												}
												echo("</select>
												</span>
												
									</div>");
									
							}
						?>	
						</div>
			</div>
			<?php		
					$root = $log_directory;
					$pathLen = strlen($root);
					myScanDir($root, 0, strlen($root));

			?>
		</div>
		<div class="col-sm-2 bd mg-tp-15">
			<br />		
				<div id="space-pie"></div>
				<b><center>total: 15gb + <?php echo("$tot_frnd"); ?> gb<br />used: <?php echo("$used"); ?><br />available: <?php echo("$avail"); ?></center></b><br />
			
			<ul class="nav txt-wh">
				<li><a class="fa fa-folder txt-wh root_menu bg-blk bd-rd-10 bd-blk" root_menu_value="mydrive" > all files </a></li>
				<?php
				foreach($folder_array as $value)
				{
					$no_space=str_replace("%20"," ",$value);
					$words  = explode(' ', $no_space);
									$longestWordLength = 0;
									foreach ($words as $word) {
									   if (strlen($word) > $longestWordLength) {
										  $longestWordLength = strlen($word);
									   }
									}
									if($longestWordLength>25)
										$no_space="...".substr($no_space,strlen($no_space)-20);
					echo("<li><a class='btn txt-left fa fa-folder root_menu txt-wh bg-blu-lt bd-rd-10 bd-blk ' root_menu_value='$value'> $no_space </a></li>");
				}
				?>
		 	</ul><br />
		</div>
		<div class="col-sm-1"></div>
	</div>
</div>
<br /><br />

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">CREATE FOLDER</h4>
      </div>
      <div class="modal-body">
        <input type="text" id="foldername" placeholder="enter the folder's name" class="form-control"><br />
		<button url="" class="btn bg-blu-lt btn-primary " id="btn_create_folder">create</button>
		<button type="button" class="btn btn-primary bg-blu-lt" data-dismiss="modal">Cancel</button>
	  </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>

<!---------------------------- rename modal---------------------->
<div id="renModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close ref" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">RENAME FOLDER</h4>
      </div>
      <div class="modal-body">
        <input type="text" id="newname" placeholder="enter the folder's new name" class="form-control"><br />
		<button url="" class="btn bg-blu-lt btn-primary " id="btn_ren_folder">rename</button>
		<button type="button" class="btn btn-primary bg-blu-lt ref" data-dismiss="modal">Cancel</button>
	  </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>
<div id="renfileModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close ref" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">RENAME FILE</h4>
      </div>
      <div class="modal-body">
        <input type="text" id="newfilename" placeholder="enter the file's new name" class="form-control"><br />
		<button url="" class="btn bg-blu-lt btn-primary " id="btn_ren_file">rename</button>
		<button type="button" class="btn btn-primary bg-blu-lt ref" data-dismiss="modal">Cancel</button>
	  </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>
<div id="shareoriel" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close ref" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">SHARE ORIEL AND GET MORE SPACE</h4>
      </div>
      <div class="modal-body">
	  <?php
		$sql="select * from users where id='$id';";
		$res = @mysqli_query($con,$sql)or die("unable to execute query");
		if (mysqli_num_rows($res)==0){
			die("fail");
		}
		$row=mysqli_fetch_array($res);
		$slink=$row["share_link"];						
        echo("<a href='http://www.facebook.com/sharer.php?s=100&p[checking]=YOUR_TITLE&p[summary]= oriel gives you 15gb cloud storage to store ur memories and hide your files&p[url]=oriel.ml/signup.php?slink=$slink&p[images][0]=images/4.png'
			target='_blank'><i class='fa fa-facebook fb'></i></a>");
		?>
			&nbsp;
		
	  </div>
      <div class="modal-footer" style="text-align:left;">
		On sharing oriel on facebook you'll get extra 0.5 gb upto 2 gb for each signup by your friend<br />  
        <button type="button" class="btn btn-primary pull-right ref" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<?php
include("footer.php");
?>
<script>
    $( document ).ready(function() {
		
		var fup = "<?php echo($_SESSION["lastnextid"]); ?>";
		$(".hid").addClass("disp-none");
		$( 'div[nextid="'+fup+'"]' ).removeClass("disp-none");
			//alert(fup);			
        $("#space-pie").circliful({
            animation: 1,
            animationStep: 6,
			backgroundColor: '#ccc',
            foregroundColor: '#008891',
            foregroundBorderWidth: 10,
            backgroundBorderWidth: 7,
            percent: <?php echo($per); ?>,
            iconColor: '#3498DB',
           //total: '100',
		   //part: '90', 
		    replacePercentageByText:'<?php echo($per.'%'); ?>' , 
            iconSize: '40',
			lineCap:'round',
            iconPosition: 'middle'
			
        });
		$("#share").click(function(){
			$("div#shareoriel").modal("show");
		});
		$("button.folder_create").click(function(){
					var fname = $(this).attr("floc");
					$("div.modal button#btn_create_folder").attr("url",fname);
					$("div#myModal").modal("show");
		});
		$("button#btn_create_folder").click(function(){
			var furl = $(this).attr("url");	
			var fname = $("#foldername").val().trim();
				$.post(
				"/folders/create_folder.php",
				{folder_loc:furl,fname:fname}
					).done(function(data){
					if(data=="present"){						
					alert("folder already exist");
					return;
					}
					else
					alert("folder created");
				location.reload();

				}).error(function(data,msg){
										
			});
		});
		$("button#btn_ren_folder").click(function(){
			var furl = $(this).attr("url");	
			//var fup= furl.substring(0, furl.lastIndexOf("/") );
			var fname = $("#newname").val().trim();
				$.post(
				"/folders/rename_folder.php",
				{folder_loc:furl,fname:fname}
					).done(function(data){
					if(data.endsWith("present")){
							//alert(data);
					alert("folder with this name already exist");
					return;
					}
					else{
						//alert(data);
						alert("folder renamed");
						location.reload();
						//$(".hid").addClass("disp-none");
						//$( 'div[nextid="'+fup+'"]' ).removeClass("disp-none");
						
					}
				}).error(function(data,msg){
										
			});
		});
		$("button#btn_ren_file").click(function(){
			var furl = $(this).attr("url");	
			var fname = $("#newfilename").val().trim();
				$.post(
				"/files/rename_files.php",
				{folder_loc:furl,fname:fname}
					).done(function(data){
						//alert(data);
					if(data.endsWith("present")){						
						alert("file with this name already exist");
						return;
					}
					else{
						alert("file renamed");
						location.reload();
					}
				}).error(function(data,msg){			
			});
		});
    });
</script>
<div id="share" class="sharefix txt-wh z2" style="background-Color:#24248f;">
<i class="fa fa-share"></i><h5>share</h5>
</div>
</body>
</html>