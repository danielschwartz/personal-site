<?php
$feed = "http://www.nytimes.com/services/xml/rss/nyt/GlobalHome.xml";

$rawFeed = file_get_contents($feed); 
$xml = new SimpleXmlElement($rawFeed);
?>

<div class='jumbo'>
	<ul id="twitter-feed">
		<?php
			foreach($xml->channel->item as $item) {
				$title = "&#160;" . $item->title . "&#160;&#160;&#160;";
				$desc = $item->description;
		?>
		<li><span><? echo $title ?>|</span></li>
		<?php } ?>
	</ul>
</div>

<script type='text/javascript'>
	$("ul#twitter-feed").liScroll();
</script>