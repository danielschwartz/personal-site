<?php ?>

<!DOCTYPE html>
<html>
  <head>
    <title>Daniel Schwartz</title>
	<link rel=StyleSheet href="reset.css" type="text/css">
	<link rel=StyleSheet href="global.css" type="text/css">
  </head>
  <body>
	<div class="wrapper">
		<ul id="menu">
			<li><a href="">About.</a></li>
			<li><a href="">Work.</a></li>
			<li class="projects"><a href="">Projects.</a></li>
		
			<ul id="projects">
				<span class="brace">&#123;</span>
				<li><a href="/projects/hightide">Hightide.</a></li>
				<li><a href="/projects/hugebuilder/huge.html">HUGE Builder.</a></li>
				<!-- <li><a href="/projects/dashboard">Dashboard.</a></li> -->
				<span class="brace">&#125;</span>
			</ul>
		</ul>
		<div id="hero">
			<span>Eventually.</span>
		</div>
	</div>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
	<script type="text/javascript">
		var windowHeight = window.innerHeight,
			heroHeight = $("#hero").height();
			
		$("#hero").css('margin-top', (windowHeight - heroHeight) / 3);
		
		$(".projects").click(function(e) {
			e.preventDefault();
			var projectList = $("#projects");
			
			if(projectList.is(":hidden")){
				$(this).addClass("active");
				projectList.fadeIn('slow');
			}
			else{
				$(this).removeClass("active");
				projectList.fadeOut('slow');
			}
		});
	</script>
  </body>
</html>