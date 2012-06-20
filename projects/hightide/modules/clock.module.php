<?php

date_default_timezone_set('GMT-4');
$format = 'g:i a';

if (!empty($_GET['format'])) 
    $format = $_GET['format']; 
    
/* DATA */
$time = date($format);

/* DISPLAY */
?>

<div class='jumbo vertical-center'>
    <span class='icon'>H</span><?php echo $time; ?>
</div>
