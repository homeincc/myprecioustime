<?php
	session_start();
	if (!IsSET($_SESSION["uid"])) {die("not user");}
	require "functions.php";
	

	function get_title($url) {
$page = file_get_contents($url);
$title = preg_replace('/<title>(.*)</title>/i', '$1', $page);
return htmlentities($title);
	}
	
?>
<!DOCTYPE html>
<html lang="cs">
<head>

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta charset="utf-8" />
<title>PInsight</title>


<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-theme.min.css">
<link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="css/jquery-ui.min.css">
<link rel="stylesheet" href="css/jquery-ui.structure.min.css">


<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/simple-lightbox.min.js"></script>
<script src="js/jquery-ui.min.js"></script>

<script>
	
$(document).ready(function () {
	//Main event loop
	
	//End of main event loop (document.ready)
});
</script>

</head>
<body>

<div id="header-container">
	<div id="logo-container">
		<h1>MyPreciousTime</h2><h3>by Home, Inc.</h3>
		<h4><em>I Want You Insight \o/\o/</em></h4>
	</div>
</div>


<div class="container" style="margin-top: 48px;">
	<div class="row">
		<?php
			$connection = Connect();
			$sql = "
SELECT    
        uid,
        source,
        url,
        ABS(males_pref)+ABS(females_pref)+ABS(age_young_pref)+ABS(age_mid_pref)+ABS(age_old_pref)+ABS(body_slim_pref)+ABS(body_mid_pref)+ABS(body_fat_pref)+ABS(soft_pref)+ABS(hard_pref)+ABS(profi_pref)+ABS(white_pref)+ABS(black_pref)+ABS(asian_pref)+ABS(couple_pref)+ABS(threesome_pref)+ABS(group_pref) AS match_no
    FROM (
SELECT
        u.id as uid,
        v.source,
        v.url,
        u.males - v.males AS males_pref,
        u.females - v.females AS females_pref,
        u.age_young - v.age_young AS age_young_pref,
        u.age_mid - v.age_mid AS age_mid_pref,
        u.age_old - v.age_old AS age_old_pref,
        u.body_slim - v.body_slim AS body_slim_pref,
        u.body_mid - v.body_mid AS body_mid_pref,
        u.body_fat - v.body_fat AS body_fat_pref,
        u.soft - v.soft AS soft_pref,
        u.hard - v.hard AS hard_pref,
        u.profi - v.profi AS profi_pref,
        u.white - v.white AS white_pref,
        u.black - v.black AS black_pref,
        u.asian - v.asian AS asian_pref,
        u.couple - v.couple AS couple_pref,
        u.threesome - v.threesome AS threesome_pref,
        u.group - v.`group` AS group_pref
    FROM user u
	CROSS JOIN videos_consolidated v WHERE u.id=? AND v.source='pornhub')a
	ORDER BY `match_no` ASC
	LIMIT 10
	;";
			$stmt = $connection->prepare($sql);
			$stmt->bind_param("i",$_SESSION["uid"]);
			$stmt->execute();
			$stmt->bind_result($uid,$source,$url,$match_no);
			while ($stmt->fetch()) {
				echo "<div class='video-feed'><a href='$url' target='_blank' data-url='$url'>".$url."</a></div>";
			}
		?>
	</div>
</div>

</body>
</html>