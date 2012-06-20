<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US" xml:lang="en-US" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<title>Hightide Alert! Beta.</title>
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0a2/jquery.mobile-1.0a2.min.css" />
    <link rel='stylesheet' type='text/css' href='resources/panic.css' />
    </style>
</head>
<body>
    <div data-role="page">
	 	<div data-role="content">
			<ul data-role="listview" data-inset="true" data-theme="c" data-dividertheme="h">
				<li>Hightide Alert! Beta.</li>
				<li><a rel="static">Food in 2F Kitchen!</a></li>
				<li><a rel="static">Food in 3F Kitchen!</a></li>
				<li><a rel="custom">Custom Message...</a></li>
				<li><a rel="shutoff">Clear Alert</a><li>
			</ul>	
		</div><!-- /content -->

	<script src="http://code.jquery.com/jquery-1.4.4.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.0a2/jquery.mobile-1.0a2.min.js"></script>
	<script>
		$("a").click(function(e){
			var json;
			
			switch($(this).attr('rel')){
				case 'static':
					json = {
						alert: true,
						message: $(this).text()
					}
					break;
				case 'shutoff':
					json = {
						alert: false,
						message: "none"
					}
					break;
				case 'custom':
					var prompt = window.prompt("Type Your Message","");
					console.log(prompt);
					json = {
						alert: true,
						message: prompt
					}
					break;
			}
						
			$.ajax({
				type: "POST",
				dataType: "json",
				data: json,
				url: "accept_alert.php",
				success: function(data) {
					if(data.success="true")
						alert("Alert Successfully Posted");
					else
						alert("uh oh something happened, try again!");
				}
			});
			
			
		});
	</script
</body>
</html>