<?php

function getForecastArray($zip){
	$xml = simplexml_load_file('http://api.wunderground.com/auto/wui/geo/ForecastXML/index.xml?query=' . $zip);
	
	$forecasts;
	
	foreach($xml->simpleforecast->forecastday as $forecast){
		$day; 
		
		$day['day'] = $forecast->date->weekday[0];
		$day['high'] = $forecast->high->fahrenheit[0];
		$day['low'] = $forecast->low->fahrenheit[0];
		$day['icon'] = $forecast->icon[0];
		
		$forecasts[] = $day;
	}
	
	return $forecasts;
}


function getLineStatus($route){
	
	$feed = 'http://www.mta.info/status/serviceStatus.txt';
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $feed);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	$contents = curl_exec ($ch);

	$xml = simplexml_load_string($contents);

	curl_close ($ch);
	$status = "";
	foreach($xml->subway->line as $line){
		//see if our route char is located within the name
		if($line->name == $route)
			$status = $line->status;
	}
	
	return (string) $status;
	

}

function getNextTrain($line, $route){
	$query = mysql_query("SELECT * FROM stop_times JOIN trips ON stop_times.trip_id = trips.trip_id WHERE stop_id IN ('$line') AND route_id = '$route' AND departure_time > CURRENT_TIMESTAMP + INTERVAL '10' MINUTE LIMIT 1") or die(mysql_error());
	
	$train = mysql_fetch_array($query);
	
	
	$formattedTime = date("g:i a", strtotime($train['departure_time']));
	
	return $formattedTime;
}


function getCurrentVersion($project){
	
	$feed = "https://jira.hugeinc.com/browse/" . $project;
	
	$jiraUser = "techdisplay";

	$jiraAuth = "techdisplay:t3chdisplay";
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $feed);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_USERPWD, $jiraAuth);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	$contents = curl_exec ($ch);
	
	echo "<div id='scraped-page-$project' style='display:none'>" . $contents . "</div>";
}

function getTotalCount($project){
	$feed = 'https://jira.hugeinc.com/sr/jira.issueviews:searchrequest-xml/temp/SearchRequest.xml?jqlQuery=project+%3D+'. $project . '+ORDER+BY+priority+DESC&tempMax=1000';
	
	$xml = curlOperations($feed);
	
	$counter = 0;
	foreach($xml->channel->item as $item){
		$counter++;
	}
	
	return $counter;
}


function getBugCount($project){
	
	$feed = 'https://jira.hugeinc.com/sr/jira.issueviews:searchrequest-xml/temp/SearchRequest.xml?jqlQuery=project+%3D+' . $project . '+AND+status+in+(Open,+%22In+Progress%22,+Reopened,+%22Ready+for+Testing+-+QA%22,+New,+%22Testing+in+Progress+%22)+ORDER+BY+priority+DESC&tempMax=1000';
	
	$xml = curlOperations($feed);
	
	$counter = 0;
	foreach($xml->channel->item as $item){
		$counter++;
	}
	
	return $counter;
}

function curlOperations($rawFeed){
	$jiraUser = "techdisplay";

	$jiraAuth = "techdisplay:t3chdisplay";
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $rawFeed);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_USERPWD, $jiraAuth);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	$contents = curl_exec ($ch);

	$xml = simplexml_load_string($contents);

	curl_close ($ch);
	
	return $xml;
}

function getDiffTime($query){
	//get current time
	list($hoursNow, $minsNow, $secsNow) = explode(":", date('H:i:s', time()));
	$nowTime = ($hoursNow * 60) + $minsNow;
	
	//run sql query and break apart returned time
	$train = mysql_fetch_array($query);
	list($hours, $mins, $secs) = explode(":", $train['departure_time']);
	
	$departureTime = ($hours * 60) + $mins;
	
	$timeDiff = $departureTime - $nowTime;
	
	return($timeDiff);
}


?>