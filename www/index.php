<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="cs">
<head>

<title>PInsight</title>

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta charset="utf-8" />

<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-theme.min.css">
<link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="css/navbar.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="css/simplelightbox.min.css">


<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/simple-lightbox.min.js"></script>

<script>
$(document).ready(function () {
	//Main event loop
	
	$("#start").click(function () {
		window.location.assign("start.php");
	});
	
	//End of main event loop (document.ready)
});
</script>

</head>
<body>

<div id="header-container">
	<div id="logo-container">
		<h1>MyPreciousTime</h2><h3>by Home, Inc.</h3>
		<h4>I Want You Insight \o/\o/</h4>
	</div>
</div>


<div class="container" style="margin-top: 48px;">
	<div id="page" class="row">
		<div class="col-xs-12 text-center">
			<button type="button" name="start" id="start" class="btn btn-primary">I want my customized feed now!</button><br><br><br>
			<button type="button" name="login" id="login" class="btn btn-success">Login</button>
		</div>
	</div>
</div>

</body>
</html>