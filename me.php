<?php
session_start();
$root = $_SERVER["DOCUMENT_ROOT"];
include ($root."/connect/db.php");
$id=$_SESSION["user_id"];
$_SESSION["lastnextid"]="mydrive";
$sql="select * from users where id='$id';";
		$res = @mysqli_query($con,$sql)or die("unable to execute query");
		if (mysqli_num_rows($res)==0){
			die("error occured .we recommend you to login again.");
		}
		else{
			$row=mysqli_fetch_array($res);
			$unm=$row["username"];
			$email=$row["email"];
			$phone=$row["phone"];
			$tot=$row["total"];
			$password=$row["password"];
			$country=$row["country"];
			$created=$row["created_on"];
			$frnd=$row["friends"];
			$per=$tot*100/(15728640+$frnd*524288);
			$tot_frnd=0.5*$frnd;
			$per = (int)$per;
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
<script>
	$(document).ready(function(){	
		$(".menuprofile").click( function(){
			$(".m").removeClass("bg-blk");
			$(".m").addClass("bg-blu-dk");
			$(this).addClass("bg-blk");
			$(".p").addClass("disp-none");
			$( "#myprofile" ).removeClass("disp-none");
			
		});
		$(".menupass").click( function(){
			
			$(".m").removeClass("bg-blk");
			$(".m").addClass("bg-blu-dk");
			$(this).addClass("bg-blk");
			$(".p").addClass("disp-none");
			$( "#chngpassword" ).removeClass("disp-none");
			
		});
		$(".menudelete").click( function(){
			
			$(".m").removeClass("bg-blk");
			$(".m").addClass("bg-blu-dk");
			$(this).addClass("bg-blk");
			$(".p").addClass("disp-none");
			$( "#delaccnt" ).removeClass("disp-none");
			
		});
		$("#pedit").click( function(){
			
			$("#pedit").addClass("disp-none");
			$( "#pemail" ).removeAttr("readonly");
			$( "#pcountry" ).removeAttr("readonly");
			$( "#pphone" ).removeAttr("readonly");
			$( "#psave" ).removeClass("disp-none");
			$( "#pcancel" ).removeClass("disp-none");
		});
		$("#psave").click( function(){
			
			$("#psave").addClass("disp-none");
			$( "#pemail" ).attr("readonly",true);
			$( "#pcountry" ).attr("readonly",true);
			$( "#pphone" ).attr("readonly",true);
			$( "#pedit" ).removeClass("disp-none");
			$( "#pcancel" ).addClass("disp-none");
		});
		$(".can").click( function(){
			location.reload();
		});
		$("#chngsave").click( function(){
			var chngold=$("#chngold").val() || false;
			var chngnew=$("#chngnew").val() || false;
			if(!chngold){
				$("#errpass").text("enter the old password");
				return;
			}
			if(!chngnew){
				$("#errpass").text("enter the new password");
				return;
			}
			if(chngnew.length<8){
			$("#errpass").text("password should be atleast 8 characters long");
			return;
			}
				$.post(
						"/accnt/newpass.php",
						{
							chngold:chngold,
							chngnew:chngnew
						}).done(function( data ){
						if(data=="success"){
							alert("password changed .We recommend you to logout and then login with new password");
							location.reload();
							return;
						}
						else if(data=="wrngold"){
							$("#errpass").text("old password is not matching with your password");
							return;
						}
						}).error(function(data,msg){
							$("#errpass").text(" error in password changing.try again");
						});
				
				});
		$("#psave").click( function(){
			var pcountry=$("#pcountry").val() || false;
			var pemail=$("#pemail").val() || false;
			var pphone=$("#pphone").val() || false;
			if(!pcountry){
				$("#ppass").text("enter the old password");
				return;
			}
			if(!pemail){
				$("#ppass").text("enter the new password");
				return;
			}
			if(!pphone){
			$("#ppass").text("enter the phone no.");
			return;
			}
			if(pphone.length<10){
			$("#ppass").text("phone no. should be 10 digits long");
			return;	
			}
			if(!isNum(pphone)){
			errs("mobile number should be numeric");
			return;
			}
		
				$.post(
						"/accnt/editaccnt.php",
						{
							pcountry:pcountry,
							pemail:pemail,
							pphone:pphone
						}).done(function( data ){
						if(data=="success"){
							alert("account details successfully edited");
							location.reload();
							return;
						}
						
						}).error(function(data,msg){
							$("#ppass").text(" error in editing account details.try again");
						});
				
				});	
				
				$("#delyes").click( function(){
					window.location="accnt/delaccnt.php";
				});	
		
				
				
							function isNum(num) {
								return ((num%1)==0);
							}					
	});
</script>
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
				
				<li id="profile"> <a href="/home.php"> My drive</a></li>
				<li id="space"> <a href="/space.php"> manage space</a></li>
				<li id="help"> <a href="/help.php"> help</a></li>
				<li id="logout"> <a href="/logout.php"> Logout <i class="fa fa-sign-out"></i></a></li>
			</ul>
		</div>
	</div>
</nav>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-1"></div>
		<div class="col-sm-3 "><center>
			<img src="images/me.gif">
			<ul class="nav txt-wh">
				<li><a class="menuprofile m txt-wh bg-blk txt-wh bd-rd-10 bd-wh">profile</a></li>
				<li><a class="menupass m txt-wh bg-blu-dk txt-wh bd-rd-10 bd-wh">change password</a></li>
				<li><a class="menudelete m txt-wh bg-blu-dk txt-wh bd-rd-10 bd-wh">Delete account</a></li>
				
				<br /><br />
			</ul>
			</center>
		</div>
		<div class="col-sm-7 bd-lt">
			<center>
				<h1>Welcome <?= $unm ?></h1><br />
			</center>
				<div class="well p" id="myprofile">
					<center><h2 class="txt-blu-lt"><u>Account details</u></h2></center>
						<table class="table-responsive">
							<tr>
								<td>Email &nbsp;</td><td><input type="text" id="pemail" class="form-control txt-blk" value="<?= $email?>" readonly></td>
							</tr>
							<tr>
								<td>Username &nbsp;</td><td><input type="text" class="form-control txt-blk" value="<?= $unm?>" readonly></td>
							</tr>
							<tr>
								<td>Password &nbsp;</td><td><input type="text" class="form-control txt-blk" value="<?= $password?>" readonly></td>
							</tr>
							<tr>
								<td>Country &nbsp;</td><td><input type="text" id="pcountry" class="form-control txt-blk" value="<?= $country?>" readonly></td>
							</tr>
							<tr>
								<td>Phone &nbsp;</td><td><input type="text" id="pphone" class="form-control txt-blk" value="<?= $phone?>" readonly></td>
							</tr>
							<tr>
								<td>Account created on &nbsp;</td><td><input type="text" class="form-control txt-blk" value="<?= $created?>" readonly></td>
							</tr>
							
						</table>
						<center><h2 class="txt-blu-lt"><u>Space details</u></h2></center>
						<table class="table-responsive">
							<tr>
								<td>Total &nbsp;</td><td><input type="text" class="form-control txt-blk" value="15gb + <?php echo("$tot_frnd"); ?> gb" readonly></td>
							</tr>
							<tr>
								<td>Used &nbsp;</td><td><input type="text" class="form-control txt-blk" value="<?=$used?>" readonly></td>
							</tr>
							<tr>
								<td>available &nbsp;</td><td><input type="text" class="form-control txt-blk" value="<?=$avail?>" readonly></td>
							</tr>
							
						</table>
						<br />
						<br />
						<center><button id="pedit" class="btn btn-primary bg-blu-lt">Edit Details</button>
						<button id="psave" class="btn btn-primary bg-blu-lt disp-none">Save</button>
						<button id="pcancel" class="btn btn-primary can bg-blu-lt disp-none">Cancel</button></center>
						<p id="ppass" class="txt-red"><center> </center></p>
					
				</div>
				<div class="well disp-none p" id="chngpassword">
					<center><h2 class="txt-blu-lt"><u>Change Password</u></h2></center>
						<table class="table-responsive">
							<tr>
								<td>Username &nbsp;</td><td><input type="text" class="form-control" value="<?=$unm ?>" readonly></td>
							</tr>
							<tr>
								<td>Old Password &nbsp;</td><td><input type="text" id="chngold" class="form-control"></td>
							</tr>
							<tr>
								<td>New Password &nbsp;</td><td><input type="text" id="chngnew" class="form-control"></td>
							</tr>
							
						</table>
							<br />
							<br />
							<center><button id="chngsave" class="btn btn-primary bg-blu-lt">Save Password</button>
							<button id="chngcancel" class="btn btn-primary can bg-blu-lt">Cancel</button></center>
							<p id="errpass" class="txt-red"><center> </center></p>
				</div>
				<div class="well disp-none p" id="delaccnt">
					<center><h2 class="txt-blu-lt"><u>Delete Account</u></h2></center>
						<br />
						<h4>Deleting account will delete all your files from Oriel.You'll not be able to access your files through the shareable links.Still wanna delete your account???</h4>
						<center><br />
							<div class="btn-group delcnfrm">
								<button id="delyes" class="btn btn-primary bg-blu-lt">yes</button>
								<button id="delno" class="btn btn-primary can bg-blu-lt">no</button>
							</div>
						</center>
						<br /><br /><br /><br />
				</div>
				
			
		</div>
			<div class="col-sm-1"></div>
			
		</div>
	</div>
</div>
<br /><br />
<?php
include("footer.php");
?>
</body>
</html>