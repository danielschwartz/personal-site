<?php

include "../helpers/functions.php";

/* Time Functions */

date_default_timezone_set('GMT-4');
$format = 'g:ia';

if (!empty($_GET['format'])) 
    $format = $_GET['format']; 
    
/* DATA */
$time = date($format);

/* Weather Functions */

/* DATA */

$zipcode = $_GET['zipcode'];
$airport = $_GET['airport'];


$current = simplexml_load_file('http://api.wunderground.com/auto/wui/geo/WXCurrentObXML/index.xml?query=KNYC');

$curTemp = $current->temp_f[0];
$curIcon = $current->icon[0];

$forecasts = getForecastArray('11201');
?>

<ul class="forecasts">
	<li class="today">
		<span class="time"><?php echo $time; ?></span>
		<div class="weather">
			<span class="temp"><?php echo $curTemp; ?>°</span>
			<img src="resources/images/weather/<?php echo $curIcon ?>.png" />
		</div>
	</li>
	<?php
		$limit = 0;
	
		foreach($forecasts as $forecast){
			if($limit > 4){
				break;
			}
			$day = substr($forecast['day'], 0, 3);
			$icon = $forecast['icon'];
			$high = $forecast['high'];
			$low = $forecast['low'];			
	?>	

	<li class="other">
		<span class="day"><?php echo $day ?></span>
		<img src="resources/images/weather/<?php echo $icon ?>.png" />
		<span class="high-low"><?php echo $high ?>°/<?php echo $low ?>°</span>
	</li>
	
	<?php
		$limit++;
		}
	?>
</ul>