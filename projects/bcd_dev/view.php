<?php include('include/header.php'); ?>
<?php 
	include('libs/adodb/adodb.inc.php');

	$db = NewADOConnection($dsn);
	if (!$db) die("Connection to databse failed");

	$id = $_GET['id'];

	$query = "SELECT * FROM sites WHERE id=$id";

	$result = $db->Execute($query);


	$clients = json_decode($result->fields[17]);
?>
<div id="view">

		<div class="row-wrap cf">
			<label>Name</label>
			<p><?php echo $result->fields[1]; ?></p>
		</div>
		<div class="row-wrap cf">
			<label>Address</label>
			<p><?php echo $result->fields[2]; ?></p>
		</div>
		<div class="row-wrap cf">
			<label>Cross Street</label>
			<p><?php echo $result->fields[3]; ?></p>
		</div>
		<div class="row-wrap cf">
			<label>Neighborhood</label>
			<p><?php echo $result->fields[4]; ?></p>
		</div>
		<div class="row-wrap cf">
			<label>Size</label>
			<p><?php echo $result->fields[5]; ?> sq ft.</p>
		</div>
		<div class="row-wrap cf">
			<label>Frontage</label>
			<p><?php echo $result->fields[6]; ?> sq ft</p>
		</div>
		<div class="row-wrap cf">
			<label>Asking Rent</label>
			<p>$<?php echo $result->fields[7]; ?></p>
		</div>
		<div class="row-wrap cf">
			<label>Asking Key Money</label>
			<p>$<?php echo $result->fields[8]; ?></p>
		</div>
		<div class="row-wrap cf">
			<div class="double-wrap">
				<label>Contact</label>
				<p><?php echo $result->fields[9]; ?></p>
			</div>

			<div class="double-wrap second">
				<label>Phone</label>
				<p><?php echo $result->fields[10]; ?></p>
			</div>
		</div>
		<div class="row-wrap cf">
			<label>Contact's Company</label>
			<p><?php echo $result->fields[11]; ?></p>
		</div>
		<div class="row-wrap cf">
			<label>Previous Use</label>
			<p><?php echo $result->fields[12]; ?></p>
		</div>
		<div class="row-wrap cf">
			<div class="double-wrap">
				<label>Venting</label>
				<p><?php if($result->fields[13] == 1){
						echo "Yes";
					} else {
						echo "No";
					} ?></p>
			</div>

			<div class="double-wrap second">
				<label>Venting Type</label>
				<p><?php echo $result->fields[14]; ?></p>
			</div>
		</div>
		<div class="row-wrap cf">
			<label>Additional Info</label>
			<p><?php echo $result->fields[15]; ?></p>
		</div>
		<div class="row-wrap cf">
			<label>Delivery Date</label>
			<p><?php echo $result->fields[16]; ?></p>
		</div>
		<div class="row-wrap cf">
		<?php foreach ($clients as $client) { ?>
			<div class="double-wrap">
				<label>Client Recieved</label>
				<p><?php echo $client->name; ?></p>
			</div>

			<div class="double-wrap second">
				<label>Date</label>
				<p><?php echo $client->date; ?></p>
			</div>
		<?php } ?>
		</div>
		<div class="row-wrap cf">
			<div class="double-wrap">
				<label>BCD Broker</label>
				<p><?php echo $result->fields[18]; ?></p>
			</div>

			<div class="double-wrap second">
				<label>Date</label>
				<p><?php echo $result->fields[19]; ?></p>
			</div>
		</div>
		<a class="edit" href="<?php echo 'edit.php?id='.$result->fields[0]; ?>">Edit</a>
		<br />
		<br />
		<form action="dbmanager.php" method="post">
			<input type="hidden" name="id" value="<?php echo $result->fields[0]; ?>" />
			<input type="hidden" name="action" value="delete" />
			<input class="enter delete" type="submit" value="Delete" />
		</form>
</div>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script type="text/javascript" src="static/js/view.js"></script>

<?php include('include/footer.php'); ?>
