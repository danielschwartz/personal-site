<?php
	$callback = $_GET['callback'];
	$json = file_get_contents('../alert.json');
	if($callback && ctype_alpha($callback))
		echo $callback . '(' . $json . ');';
	else
		echo $json;
?>