<?php

include "../helpers/functions.php";

/* DATA */
$data = array(
  array('MAYBELLINE',     'Go/NoGo', '30/Dec/10', 'Z@statuspanic, H@statuspanic'),
  array('PEPSI',       'Ongoing', '1/Dec/10', 'Z@statuspanic, L@statuspanic, I@statuspanic'),
  array('I &#9829; RADIO', '1.0', '15/Dec/10', 'Z@statuspanic, H@statuspanic, P@statuspanic'),
  array('OPENSKIES',  '2.12.2', '1/Dec/10', 'G@statuspanic, L@statuspanic'),
  array('Four Seasons',     'Kickoff', '21/Nov/10', 'L@statuspanic, G@statuspanic, I@statuspanic')
);

/* DISPLAY 
getCurrentVersion("MAYRD");
getCurrentVersion("PEP");
getCurrentVersion("CCIHR");
getCurrentVersion("SXM");
getCurrentVersion("BAOS");
*/
?>

<div>
    <table border='0' width='100%' cellpadding='0' cellspacing='10'>
    <?php
    $count = 0;
    foreach($data as $row) {
        $class = ($count % 2 == 1 ? " class='alt'" : '');
		$rowNum = $count + 1;
        echo "<tr$class id='row$rowNum'>";
        for($j = 0; $j < count($row); $j++) {
            if ($j!=3) {
                echo "<td class='cell_$j'>$row[$j]</td>";
            } else {
                $gravatar = ''; 
                $array = preg_split('/,/', $row[$j], -1, PREG_SPLIT_NO_EMPTY);
                foreach ($array as $email) {
                    $gravatar .= '<img src="http://www.gravatar.com/avatar.php?gravatar_id='. md5($email) .'&s=40&d=monsterid"> ';            
                }
                echo "<td class='cell_$j'>$gravatar</td>";
            }

        }
        echo '</tr>';
        $count++;
    }
    
    ?>
    
    </table>
	<script>
		/* clean this shit up.... 

		var row1Versions = $("#scraped-page-MAYRD").find('#fragdueversions .vevent');
		var row2Versions = $("#scraped-page-PEP").find('#fragdueversions .vevent');
		var row3Versions = $("#scraped-page-CCIHR").find('#fragdueversions .vevent');
		var row4Versions = $("#scraped-page-BAOS").find('#fragdueversions .vevent');
		var row5Versions = $("#scraped-page-SXM").find('#fragdueversions .vevent');

		var text1 = $(row1Versions[0]).find('a').text();
		var text2 = $(row2Versions[0]).find('a').text();
		var text3 = $(row3Versions[0]).find('a').text();
		var text4 = $(row4Versions[0]).find('a').text();
		var text5 = $(row5Versions[0]).find('a').text();
		
		var ending1 = $(row1Versions[0]).find("abbr").text();
		var ending2 = $(row2Versions[0]).find("abbr").text();
		var ending3 = $(row3Versions[0]).find("abbr").text();
		var ending4 = $(row4Versions[0]).find("abbr").text();
		var ending5 = $(row5Versions[0]).find("abbr").text();
		
		$("#row1").find(".cell_1").text(text1);
		$("#row2").find(".cell_1").text(text2);
		$("#row3").find(".cell_1").text(text3);
		$("#row4").find(".cell_1").text(text4);
		$("#row5").find(".cell_1").text(text5);
		
		$("#row1").find(".cell_2").text(ending1);
		$("#row2").find(".cell_2").text(ending2);
		$("#row3").find(".cell_2").text(ending3);
		$("#row4").find(".cell_2").text(ending4);
		$("#row5").find(".cell_2").text(ending5);
		
		//custom writing for when Jira doesnt get what we want
		$("#row4").find(".cell_1").text("2.12.2");
		$("#row4").find(".cell_2").text("1/Nov/10");
		
		*/
	</script>
</div>

