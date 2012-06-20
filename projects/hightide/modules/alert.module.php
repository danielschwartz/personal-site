<?php
	$alertJson = file_get_contents('../alert.json');
	$alertArray = json_decode($alertJson);
?>

<div class="alert-inner">
	<div class="alert-wrapper">
		<img width="300" src="resources/images/alert.png">
		<p><?php echo $alertArray->{'message'}; ?></p>
	</div>
</div>
<script>
	
	var alert = "<?php echo $alertArray->{'alert'}; ?>";
	var message = "<?php echo $alertArray->{'message'};?>";	
	
	if(alert && localStorage.getItem("alert-shown") === "false"){
		$("#countdown .mega").append('<div class="alert"><img src="resources/images/alert.png" width="40"><span>' + message + '</span></div>');
	}

	if(alert){
		$("#alert").addClass('alert-show');
		if(localStorage.getItem("alert-shown") === "false"){
			fadeInOut();
		}
		localStorage.setItem('alert-shown', true);
		
		//console.log(localStorage.getItem("alert-shown"));
		
	}
	else{
		$("#alert").hide();
		$("#alert").removeClass('alert-show');
		localStorage.setItem('alert-shown', false);
		$("#countdown .alert").remove();
		//console.log(localStorage.getItem("alert-shown"));	
	}
		

	function fadeInOut(){
		$(".alert-show").fadeIn('slow');
		$(".alert-show").fadeOut("slow");
		$(".alert-show").fadeIn('slow');
		$(".alert-show").fadeOut("slow");
	}
</script>

