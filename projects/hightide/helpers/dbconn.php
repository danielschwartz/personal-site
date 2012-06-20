<?php

//connect to db
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'tigger01';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');

$dbname = 'mta_gtfs';
mysql_select_db($dbname);
//end connect to db

?>