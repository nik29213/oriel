<html>
<head>
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

<script type="text/javascript">
  $(document).ready(function(){
    $('#share_bt').click(function(e){
		alert("vhggvh");
      e.preventDefault();
      FB.ui(
        {
          method: 'feed',
          name: 'This is the content of the "name" field.',
          link: 'gh.hhj',
          caption: 'Caption like which appear as title of the dialog box',
          description: 'Small description of the post',
          message: ''
        }
      );
    });
  });
</script>
</head>
<body>
<button id="share_bt">share on fb</button>
</body>
</html>