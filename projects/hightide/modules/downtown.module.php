<?php

//intialize and connect to our db
include "../helpers/dbconn.php";
include "../helpers/functions.php";

$items = array(
    // 'bubble' => 'line'
	'F|orange'  => array(getNextTrain('F18S', 'F'), getLineStatus("BDFM")),
    'A|blue'     => array(getNextTrain('A40S', 'A'), getLineStatus("ACE")),
    'C|blue'    => array(getNextTrain('A40S', 'C'), getLineStatus("ACE")),
    '2|red'    => array(getNextTrain('231S', '2'), getLineStatus("123")),
    '3|red' => array(getNextTrain('231S', '3'), getLineStatus("123"))
);

?>


<h2>Downtown Trains</h2>
<ul>
	<?php foreach($items as $bubble => $line) { 
        $bubble = explode('|', $bubble);
        $color  = $bubble[1];
        $bubble = $bubble[0];

		//color our service message correctly
		switch($line[1]) {
			case 'GOOD SERVICE':
				$status_color = "green";
				break;
			case 'DELAYS':
				$status_color = "red";
				break;
			case 'PLANNED WORK':
				$status_color = "#FF8000";
				break;
			default:
				$status_color = "grey";
				break;
		}
        ?>
        <li>
			<span class="status" <?php echo 'style=color:' . $status_color . ';' ?> ><?php echo $line[1] ?></span>
            <span class='<?php echo $color ?> bubble'>
                <span class='background'>E</span>
                <span class='display'><?php echo $bubble ?></span>
            </span>
            <span class='content'><?php echo $line[0] ?></span>
        </li>

    <?php } ?>
</ul>