<?php
session_start();
if (!isset(	$_SESSION["user_id"])){
	echo("kindly login to see the space details");
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
			$used=$used_mb." mb";
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
<html lang="en">
<head>
	<title>oriel</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/jquery.circliful.css">
	<script src="/bootstrap/js/jq.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="/js/jquery.circliful.js"></script>
   
   <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="/fa/css/fa.css" rel="stylesheet">

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
				
				<li id="profile"> <a href="/home.php"> my drive</a></li>
				<li id="logout"> <a href="/logout.php"> Logout <i class="fa fa-sign-out"></i></a></li>
			</ul>
		</div>
	</div>
</nav>
<div class="container-fluid">
	<div class="row">
		
		<div class="col-sm-6">
			<div id="spacing"></div>
		</div>
		<div class="col-sm-6">
		<?php $lt=100-$per; ?>
			<span class="txt-blu-lt"><center><h1><big><big><big><?= $used ?></big></big></big><span class="txt-blk"> used</span></h1></center></span><br />
			<span class="txt-blu-lt"><center><h1><big><big><big><?= $avail." (".$lt."%) " ?></big></big></big><span class="txt-blk"> left</span></h1></center></span><hr />
			<?php
			$img=0;$t=0;
				$sql="select * from files where uid='$id' and type='jpg' or type='jpeg' or type='png' or type='gif';";
				$res = @mysqli_query($con,$sql)or die("unable to execute query");
				while( $row = mysqli_fetch_array($res) ){
					$img+=$row["size"];
					$t+=$row["size"];
				}
				if($img<1024)
					$img=$img."kb";
				else{
					$img=$img/1024;
					if($img<1024)
						$img=$img."mb";
					else{
						$img=$img/1024;
						$img=$img."gb";
					}
					
				}
				echo("<center><h3>images : $img </h3></center>");
			?>
			<?php
			$vid=0;
				$sql="select * from files where uid='$id' and type='mov' or type='avi' or type='mp4' or type='flv';";
				$res = @mysqli_query($con,$sql)or die("unable to execute query");
				while( $row = mysqli_fetch_array($res) ){
					$vid+=$row["size"];
					$t+=$row["size"];
				}
				if($vid<1024)
					$vid=$vid."kb";
				else{
					$vid=$vid/1024;
					if($vid<1024)
						$vid=$vid."mb";
					else{
						$vid=$vid/1024;
						$vid=$vid."gb";
					}
					
				}
				echo("<center><h3>videos : $vid </h3></center>");
			?>
			<?php
			$vid=0;
				$sql="select * from files where uid='$id';";
				$res = @mysqli_query($con,$sql)or die("unable to execute query");
				while( $row = mysqli_fetch_array($res) ){
					$vid+=$row["size"];
				}
				
				$vid=$vid-$t;
				
				if($vid<1024)
					$vid=$vid."kb";
				else{
					$vid=$vid/1024;
					$vid=round($vid,2);
					if($vid<1024)
						$vid=$vid."mb";
					else{
						$vid=$vid/1024;
						$vid=round($vid,2);
						$vid=$vid."gb";
					}
					
				}
				echo("<center><h3>others : $vid </h3></center>");
			?>
			
		</div>
	</div>
</div>
<?php
$_SESSION["lastnextid"]="mydrive";
include("footer.php");
?>
</body>
</html>
<script>
    $( document ).ready(function() {
        $("#spacing").circliful({
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
	});
</script>