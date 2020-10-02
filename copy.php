<?php
if(!isset($_GET["cpylink"]))
	exit();
?>
<html>
<head>
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
</head>
<body>

<p>Click on the button to copy the text from the text field. Try to paste the text (e.g. ctrl+v) afterwards in a different window, to see the effect.</p>
<?php
$flink=$_GET["cpylink"];
$cp="oriel.ml/drive/dwnldfile.php?link=$flink";
echo("<input id='myInput' value='$cp'>");
?>
<a class="bt" id="btcp">Copy text</a>
<p class="para">The document.execCommand() method is not supported in IE9 and earlier.</p>
</body>
</html>
<script>
$(document).ready(function(){
//var txt="yesssss";	
//$("#myInput").val(txt);
//$(".bt").click();
$("#btcp")[0].click();
	$(".bt").click(function(){
		//var id = $(this).attr("value");
		//$(".hid").addClass("disp-none");
		//$( 'div[nextid="'+id+'"]' ).removeClass("disp-none");
		//var copyText = $("#myInput").val().trim();
		//var txt="ggh";
		
		  $("#myInput").select();
		  document.execCommand("Copy");
		  alert("Copied the text");
		  //alert(copyText);
	});
	$("#btcp")[0].click();
	//$(".bt").click();
	function copy(selector){
  var $temp = $("<div>");
  $("body").append($temp);
  $temp.attr("contenteditable", true)
       .html($(".para").html()).select()
       .on("focus", function() { document.execCommand('selectAll',false,null) })
       .focus();
  document.execCommand("copy");
  $temp.remove();
}
	function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  document.execCommand("Copy");
  alert("link copied");
}
});
</script>

