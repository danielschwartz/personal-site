<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title>BCD Development Sites Database</title>
	
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.3.0/build/cssreset/reset-min.css">
	<link rel="stylesheet" href="static/css/global.css"> 
	<link rel="stylesheet" href="static/css/libs/jquery.datepick.css">
	<?php 
		$neighborhoods = array(
			'Bowery',
			'Chelsea',
			'East Village',
			'Financial District',
			'Gramercy/Murray Hill',
			'Greenwich Village/West Village',
			'Harlem',
			'Lower East Side',
			'Meatpacking District',
			'Midtown East',
			'Midtown West',
			'NoHo',
			'Nolita',
			'Plaza District',
			'SoHo',
			'Times Square',
			'Tribeca',
			'Union Square/Flatiron District',
			'Upper East Side',
			'Upper West Side',
			'Upper Manhattan',
			'Brooklyn',
			'Queens'
		);

		//$dsn = 'mysql://root:root@localhost/bcd_dev';
		$dsn = 'mysql://root:tigger01@localhost/bcd_dev';
	?>
</head>
<body>
	<div class="content cf">
		<div id="header">
			<a href="index.php" class="logo"><img src="static/img/header-logo.png" /></a>

			<div class="search-wrap">
				<form class="search-box" method="post" action="search-all.php">
					<input class="keyword" type="text" name="keyword" />
					<input type="hidden" name="action" value="view-all" />
					<input class="submit" type="submit" />
				</form>
			</div>
			<ul class="links">
				<li><a href="new-site.php">Enter Site Info</a></li>
				<li><a href="view-all.php">View Database</a></li>
				<li><a href="search-advanced.php">Adv. Search</a></li>
			</ul>
		</div>