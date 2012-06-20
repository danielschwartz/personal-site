<?php
	/* Get All Hero Images */
	
	$heros = glob("images/portfolio/heros/*.*");
	
	$heros_div;
	
	foreach($heros as $hero){
		
		$dir = explode("/", $hero);
		$name = explode(".", $dir[3]);
		
		$heros_div .= '<img class="hero" lightbox="' . $name[0] . '" src="' . $hero . '" />';
	}
	
	/* Get All Colorbox Images */
	
	$images_div;
	
	$handle = opendir('images/portfolio/lightbox/');

	while (false !== ($file = readdir($handle))) {
	  	if(($file != ".DS_Store") && ($file != ".") && ($file != "..")){
			
			$images = glob('images/portfolio/lightbox/' . $file . '/*.*');
		
			foreach($images as $image){
				$images_div .= '<a rel="' . $file . '" href="' . $image . '"><img src="' . $image . '"/></a>';
			}
		}
	}
?>


<!DOCTYPE html>

<html lang="en">

<?php include('header.php'); ?>

<body id="portfolio">
	<?php include('menu.php'); ?>
	
	<div class="heros">
		<?php echo $heros_div; ?>
	</div>
	
	
	<div class="images">
		<?php echo $images_div; ?>
	</div>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
	<script src="js/jquery.colorbox.js"></script>
	<script>
		
		$.each($(".hero"), function(index, value) { 
		 	var selector = 'a[rel="' + $(this).attr('lightbox') + '"]';
			$(selector).colorbox();
		});
		
		
		$("a[rel='burton']").colorbox();
		
		$(".hero").click(function(){
			var selector = 'a[rel="' + $(this).attr('lightbox') + '"]:first';
			console.log(selector);
			
			$(selector).click();
			return false;
		});
	</script>
</body>
</html>








