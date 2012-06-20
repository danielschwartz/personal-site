<?php include('include/header.php'); ?>
<?php 
	include('libs/adodb/adodb.inc.php');

	$db = NewADOConnection($dsn);
	if (!$db) die("Connection to databse failed");


	$keyword = $_POST['keyword'];

	$query = "SELECT id,name,size,address,neighborhood,asking_rent FROM sites WHERE ";
	$query .= "`name` LIKE '%$keyword%' OR ";
	$query .= "`address` LIKE '%$keyword%' OR ";
	$query .= "`cross_street` LIKE '%$keyword%' OR ";
	$query .= "`size` LIKE '%$keyword%' OR ";
	$query .= "`frontage` LIKE '%$keyword%' OR ";
	$query .= "`asking_rent` LIKE '%$keyword%' OR ";
	$query .= "`asking_key` LIKE '%$keyword%' OR ";
	$query .= "`contact_name` LIKE '%$keyword%' OR ";
	$query .= "`contact_number` LIKE '%$keyword%' OR ";
	$query .= "`contact_company` LIKE '%$keyword%' OR ";
	$query .= "`previous_use` LIKE '%$keyword%' OR ";
	$query .= "`venting_type` LIKE '%$keyword%' OR ";
	$query .= "`additional_info` LIKE '%$keyword%' OR ";
	$query .= "`bcd_broker` LIKE '%$keyword%'";

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
