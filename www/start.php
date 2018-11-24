<?php
	session_start();
	
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
	var page_index = 1;
	
	function set_page(pid) {
		$(".startup-action").collapse("hide");
		$(".startup-action[data-page="+pid+"]").collapse("show");
	}
	
	var selection_tree = {
		"gender": [{
			"title": "Male",
			"img": "male.jpg",
			"show_title": false,
			"link": [{
				"title": "Younger",
				"img": "young.male.jpg",
				"show_title": true
			},{
				"title": "Older",
				"img": "old.male.jpg",
				"show_title": true
			}]
		},{
			"title": "Female",
			"img": "female.jpg",
			"show_title": false
		}
		]
	};
	
	function slider_change(e,ui) {
		var spage = $(this).attr("data-slider");
		$(".button[data-slider="+spage+"]").removeClass("ui");
		$(".button[data-slider="+spage+"][data-val="+ui.value+"]").addClass("ui");
	}
	

$(document).ready(function () {
	//Main event loop
	
	
	
	set_page(1);
	

	$(".button").click(function () {
		$(".slider[data-slider="+$(this).attr("data-slider")+"]").slider("value",$(this).attr("data-val"));
	});
	
	$(".button,.btn[data-slider].next").not(".done").click(function () {
		page_index+=1;
		set_page(page_index);
	});
	
	$(".btn[data-slider].back").click(function () {
		page_index-=1;
		set_page(page_index);
	});
	
	$(".button[data-slider=gender],.btn[data-slider=gender]").click(function () {
		var t,val;
		val = $(".slider[data-slider=gender]").slider("value");
		if (val==0) {
			t = "Girls";
		} else if (val==1) {
			t = "You don\'t care";
		} else {
			t = "Boys";
			//age
			$("div[data-slider=age][data-val=0] > img").attr("src","img/young.male.jpg");
			$("div[data-slider=age][data-val=2] > img").attr("src","img/old.male.jpg");
			//amateur
			$("div[data-slider=amateur][data-val=0] > img").attr("src","img/amateur.male.jpg");
			$("div[data-slider=amateur][data-val=2] > img").attr("src","img/profi.male.jpg");
			//body
			$("div[data-slider=body][data-val=0] > img").attr("src","img/skinny.male.jpg");
			$("div[data-slider=body][data-val=2] > img").attr("src","img/fat.male.jpg");
		}
		$("#selected-gender").text(t);
	});

	$(".done").click(function () {
		$("div.overmodal").css("display","block");
		var data = {
				"males": $(".slider[data-slider=gender]").slider("value")/2*1,
				"females": Math.abs($(".slider[data-slider=gender]").slider("value")-2)/2*1,
				"age_young": Math.abs($(".slider[data-slider=age]").slider("value")-2)/2*1,
				"age_mid": Math.abs($(".slider[data-slider=age]").slider("value")-2)/2*1,
				"age_old": $(".slider[data-slider=age]").slider("value")/2*1,
				"body_slim": Math.abs($(".slider[data-slider=body]").slider("value")-2)/2*1,
				"body_mid": $(".slider[data-slider=body]").slider("value")/2*1,
				"body_fat": $(".slider[data-slider=body]").slider("value")/2*1,
				"soft": Math.abs($(".slider[data-slider=core]").slider("value")-2)/2*1,
				"hard": $(".slider[data-slider=core]").slider("value")/2*1,
				"profi": $(".slider[data-slider=amateur]").slider("value")/2*1,
				"amateur": Math.abs($(".slider[data-slider=amateur]").slider("value")-2)/2*1,
				"white": 0.5,
				"black": 0.5,
				"asian": 0.5,
				"couple": 0.5,
				"threesome": 0.5,
				"group": 0.5
			};
		$.ajax({
			type: "POST",
			url: "user.add.php",
			data: data,
			success: function (e) {window.location.replace("feed.php");},
			dataType: "text"
		});
	});
	
	$(".slider").slider({"min": 0, "max": 2, "value": 1, "slide": slider_change, "change": slider_change});
	
	
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
	<div id="page" class="row">
		<div class="col-xs-12 text-center">
			<button type="button" name="login" id="login" class="btn btn-success">I've been through this already! Login</button>
		</div>
	</div>
</div>

<div class="container">
	<div class="row startup-action collapse" data-page="1">
		<div class="col-xs-12"><h2>I am interested in:</h2></div>
		<div class="row text-center">
			<div class="col-xs-4"><div class="button" data-slider="gender" data-val="0"><img src="img/female.png" class="gender" alt="Female">Women</div></div>
			<div class="col-xs-4"><div class="slider" data-slider="gender"></div></div>
			<div class="col-xs-4"><div class="button" data-slider="gender" data-val="2"><img src="img/male.png" class="gender" alt="Male">Men</div></div>
		</div>
		<div class="col-xs-12 text-center">
		<br><br>
			<button type="button" class="btn btn-primary next" data-slider="gender">Next</button><br><br>
			<span class="page-counter">1 / 5</span>
		</div>
	</div>
	
	
	<div class="row startup-action collapse" data-page="2">
		<div class="col-xs-12"><h2><span id="selected-gender"></span>, eh? Tell me more!</h2></div>
		<div class="row text-center">
			<div class="col-xs-4"><div class="button" data-slider="age" data-val="0"><img src="img/young.jpg" alt="Young">Young</div></div>
			<div class="col-xs-4"><div class="slider" data-slider="age"></div></div>
			<div class="col-xs-4"><div class="button" data-slider="age" data-val="2"><img src="img/old.jpg" alt="Old">Older</div></div>
		</div>
		<div class="col-xs-12 text-center">
		<br><br>
			<button type="button" class="btn btn-secondary back" data-slider="age">Back</button>
			<button type="button" class="btn btn-primary next" data-slider="age">Next</button><br><br>
			<span class="page-counter">2 / 5</span>
		</div>
	</div>
	
	
	<div class="row startup-action collapse" data-page="3">
		<div class="col-xs-12"><h2>Amateur vs. Professional?</h2></div>
		<div class="row text-center">
			<div class="col-xs-4"><div class="button" data-slider="amateur" data-val="0"><img src="img/amateur.jpg" alt="Young">Amateur</div></div>
			<div class="col-xs-4"><div class="slider" data-slider="amateur"></div></div>
			<div class="col-xs-4"><div class="button" data-slider="amateur" data-val="2"><img src="img/profi.jpg" alt="Old">Professional</div></div>
		</div>
		<div class="col-xs-12 text-center">
		<br><br>
			<button type="button" class="btn btn-secondary back" data-slider="age">Back</button>
			<button type="button" class="btn btn-primary next" data-slider="amateur">Next</button><br><br>
			<span class="page-counter">3 / 5</span>
		</div>
	</div>
	
	<div class="row startup-action collapse" data-page="4">
		<div class="col-xs-12"><h2>Body constitution?</h2></div>
		<div class="row text-center">
			<div class="col-xs-4"><div class="button" data-slider="body" data-val="0"><img src="img/skinny.jpg" alt="Young">Skinny</div></div>
			<div class="col-xs-4"><div class="slider" data-slider="body"></div></div>
			<div class="col-xs-4"><div class="button" data-slider="body" data-val="2"><img src="img/fat.jpg" alt="Old">Fat</div></div>
		</div>
		<div class="col-xs-12 text-center">
		<br><br>
			<button type="button" class="btn btn-secondary back" data-slider="age">Back</button>
			<button type="button" class="btn btn-primary next" data-slider="body">Next</button><br><br>
			<span class="page-counter">4 / 5</span>
		</div>
	</div>
	
	<div class="row startup-action collapse" data-page="5">
		<div class="col-xs-12"><h2>Core selection</h2></div>
		<div class="row text-center">
			<div class="col-xs-4"><div class="button done" data-slider="core" data-val="0"><img src="img/soft.jpg" alt="Young">Soft</div></div>
			<div class="col-xs-4"><div class="slider" data-slider="core"></div></div>
			<div class="col-xs-4"><div class="button done" data-slider="core" data-val="2"><img src="img/intense.jpg" alt="Old">Intense</div></div>
		</div>
		<div class="col-xs-12 text-center">
		<br><br>
			<button type="button" class="btn btn-secondary back" data-slider="age">Back</button>
			<button type="button" class="btn btn-success done">Done!</button>
			<br><br>
			<span class="page-counter">5 / 5</span>
		</div>
	</div>
</div>

<div class="overmodal">
	<img src="img/loader.gif" alt="Loader">
	<span>Your porn is about to be ready in a minute...<span>
</div>

</body>
</html>