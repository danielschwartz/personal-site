<?php include('include/header.php'); ?>
<?php 
	include('libs/adodb/adodb.inc.php');

	$db = NewADOConnection($dsn);
	if (!$db) die("Connection to databse failed");


	$query = "SELECT id,name,size,address,neighborhood,asking_rent FROM sites";

	$result = $db->Execute($query);
?>
<div id="view-all">

	<?php
	while (!$result->EOF) {
	?>
		<div class="item-wrap cf">
			<a href="<?php echo 'view.php?id='.$result->fields[0]; ?>"><?php echo $result->fields[1]; ?></a>
			<p><?php echo $result->fields[4]; ?></p>
			<p><?php echo $result->fields[3]; ?></p>
			<p><?php echo $result->fields[2]; ?> sq ft.</p>
			<p>$<?php echo $result->fields[5]; ?></p>
		</div>
	<?php
		$result->MoveNext();
	}
	?>



</div>

<?php include('include/footer.php'); ?>
