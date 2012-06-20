<?php

include "../helpers/functions.php";

$mayrdBugs = $mayrdTotal = $pepBugs = $pepTotal = $clearBugs = $clearTotal = $asmeBugs = $asmeTotal = $swimBugs = $swimTotal = 0;

$projectArray = array('MAYRD', 'PEP', 'CCIHR', 'ASMEDEV', 'BAOS', 'SXM');


foreach($projectArray as $project){
	switch($project){
		case 'MAYRD':
			$bar1Bugs = getBugCount($project);
			$bar1Total = getTotalCount($project);
			break;
		case 'PEP':
			$bar2Bugs = getBugCount($project);
			$bar2Total = getTotalCount($project);
			break;
		case 'CCIHR':
			$bar3Bugs = getBugCount($project);
			$bar3Total = getTotalCount($project);
			break;
		case 'ASMEDEV':
			$bar4Bugs = getBugCount($project);
			$bar4Total = getTotalCount($project);
			break;
		case 'BAOS':
			$bar5Bugs = getBugCount($project);
			$bar5Total = getTotalCount($project);
			break;
		case 'SXM':
			$bar6Bugs = getBugCount($project);
			$bar6Total = getTotalCount($project);
			break;
	}
}

class Bar {
    function __construct($name, $height, $remaining) {
        $this->name = $name;
        $this->height = $height;
        $this->remaining = $remaining;
    }
}

/* DATA */
$bars = array();
$bars[] = new Bar('MAYBELLINE',  $bar1Bugs,   $bar1Total); 
$bars[] = new Bar('PEPSI',      $bar2Bugs,   $bar2Total); 
$bars[] = new Bar('I &#9829; RADIO',    $bar3Bugs,   $bar3Total); 
$bars[] = new Bar('ASME',   $bar4Bugs,   $bar4Total); 
$bars[] = new Bar('OPENSKIES', $bar5Bugs,   $bar5Total);
$bars[] = new Bar('SIRIUS/XM',   $bar6Bugs,   $bar6Total);


/* DISPLAY */
$max_height = 0;
foreach($bars as $bar) {
    if ($bar->height > $max_height)
        $max_height = $bar->height;
}

// change these
$max_bar_width = 300;
$default_padding = 12;

// don't change these
$total_outer = ($default_padding * 2); // (paddings + borders)
$max_width = $_GET['width'];
$num_bars = count($bars);
$bar_width = floor(min($max_bar_width, ($max_width - ($total_outer * $num_bars)) / $num_bars));
$final_padding = max($default_padding, ($max_width - (($bar_width + $total_outer) * $num_bars)) / $num_bars / 2);

?>
<div>
  <div class="bars">
<?php for($j = 0; $j < count($bars); $j++) {
    $bar = $bars[$j];
    $count = $j + 1;
    //$bar_height =  ($bar->height / $max_height) * $_GET['height'];
	$bar_height = ($bar->height/$bar->remaining) * $_GET['height'];
    $bar_height = floor($bar_height);
    $top_offset = $_GET['height'] - $bar_height;
    
?>
    <div class='bar' style='margin-top: <?php echo $top_offset . 'px; width: ' .
                            $bar_width . 'px; padding: 0 ' . $final_padding . 'px;' ?>'>
        <div class='header'><?php echo '<span class="total">'. $bar->height .'</span> / <span class="remaining">'. $bar->remaining .'</span>'; ?></div>
        <div class='view' id='bar_<?php echo $count ?>' style='height: <?php echo $bar_height; ?>px;'></div>
    </div>
<?php } ?>
  </div>
<?php for($j = 0; $j < count($bars); $j++) {
    $bar = $bars[$j]; 
?>  
    <div class='bar-title' style='width: <?php echo $bar_width . 'px; padding: 0 ' . $final_padding . 'px;' ?>'>
        <span class='title'><?php echo $bar->name ?></span>
    </div>
<?php } ?>        
<div style='clear:both'></div>
</div>

<script type="text/javascript">
	$.each($(".bar"), function(index, value) { 
	  	var height = $(this).height();
		var margin = 300 - height;
		$(this).css('margin-top', margin);
	});
</script>
