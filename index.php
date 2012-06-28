<?php ?>

<!DOCTYPE html>
<html>
  <head>
    <title>Daniel Schwartz</title>
	<link rel=StyleSheet href="reset.css" type="text/css">
	<link rel=StyleSheet href="global.css" type="text/css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <!-- start Mixpanel --><script type="text/javascript">(function(c,b){var a,d,h,e;a=c.createElement("script");a.type="text/javascript";a.async=!0;a.src=("https:"===c.location.protocol?"https:":"http:")+'//api.mixpanel.com/site_media/js/api/mixpanel.2.js';d=c.getElementsByTagName("script")[0];d.parentNode.insertBefore(a,d);b._i=[];b.init=function(a,c,f){function d(a,b){var c=b.split(".");2==c.length&&(a=a[c[0]],b=c[1]);a[b]=function(){a.push([b].concat(Array.prototype.slice.call(arguments,0)))}}var g=b;"undefined"!==typeof f?g=
b[f]=[]:f="mixpanel";g.people=g.people||[];h="disable track track_pageview track_links track_forms register register_once unregister identify name_tag set_config people.set people.increment".split(" ");for(e=0;e<h.length;e++)d(g,h[e]);b._i.push([a,c,f])};window.mixpanel=b})(document,window.mixpanel||[]);
mixpanel.init("3968295d4a53c81dbe093b7d3eb4b99e");</script><!-- end Mixpanel -->
    <script type="text/javascript">
        $(document).ready(function(){
            mixpanel.track('HP-View');

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
        });
    </script>
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
  </body>
</html>