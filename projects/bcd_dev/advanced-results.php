<?php include('include/header.php'); ?>
<?php 
	include('libs/adodb/adodb.inc.php');

	$db = NewADOConnection($dsn);
	if (!$db) die("Connection to databse failed");


	$street = $_POST['street'];
	$neighborhood = $_POST['neighborhood'];
	$date_start = $_POST['date_start'];
	$date_end = $_POST['date_end'];
	$size_start = $_POST['size_start'];
	$size_end = $_POST['size_end'];
	$rent_start = $_POST['rent_start'];
	$rent_end = $_POST['rent_end'];

	//Truth Vars
	$dates = false;
	$size = false;
	$rent = false;
	$address = false;

	$query = "SELECT id,name,size,address,neighborhood,asking_rent FROM sites WHERE ";

	if($date_start != "" || $date_end != ""){ $dates = true; }
	if($size_start != "" || $size_end != ""){ $size = true; }
	if($rent_start != "" || $rent_end != ""){ $rent = true; }
	if($address != ""){ $address = true; }

	if($dates){ $query .= "`delivery_date` BETWEEN '$date_start' AND '$date_end' AND "; }
	if($size){ $query .= "`size` BETWEEN '$size_start' AND '$size_end' AND "; }
	if($rent){ $query .= "`asking_rent` BETWEEN '$rent_start' AND '$rent_end' AND "; }
	if($street){ $query .= "`name` LIKE'%$street%' OR `address` LIKE'%$street%' AND"; }

	$query .= "`neighborhood` LIKE'%$neighborhood%'";

	$result = $db->Execute($query);

	echo $query;
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
