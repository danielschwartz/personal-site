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
<div id="new-site">
	<form action="dbmanager.php" method="post" class="new-site">
	<input type="hidden" name="id" value="<?php echo $result->fields[0]; ?>" />
	<div class="row-wrap cf">
		<label for="site">Site Name</label>
		<div class="input-wrap">
			<input type="text" name="site" value="<?php echo $result->fields[1]; ?>"/>
		</div>
	</div>

	<div class="row-wrap cf">
		<label for="address">Address</label>
		<div class="input-wrap">
			<input type="text" name="address" value="<?php echo $result->fields[2]; ?>"/>
		</div>
	</div>

	<div class="row-wrap cf">
		<label for="cross_street">Cross Street</label>
		<div class="input-wrap">
			<input type="text" name="cross_street" value="<?php echo $result->fields[3]; ?>"/>
		</div>
	</div>

	<div class="row-wrap cf">
		<label for="neighborhood">Neighborhood</label>
		<div class="neighborhood-wrap">
			<?php foreach($neighborhoods as $neighborhood) { ?>
			<div class="radio-wrap cf">
				<input type="radio" name="neighborhood" value="<?php echo $neighborhood; ?>" <?php if($neighborhood == $result->fields[4]){ echo "checked"; } ?>/>
				<span><?php echo $neighborhood; ?></span>
			</div>
			<?php } ?>
		</div>
	</div>

	<div class="row-wrap cf">
		<label for="size">Size</label>
		<div class="input-wrap">
			<input type="text" name="size" value="<?php echo $result->fields[5]; ?>"/>
		</div>
	</div>

	<div class="row-wrap cf">
		<label for="frontage">Frontage</label>
		<div class="input-wrap">
			<input type="text" name="frontage" value="<?php echo $result->fields[6]; ?>"/>
		</div>
	</div>

	<div class="row-wrap cf">
		<label for="asking_rent">Asking Rent <span class="rent">(per annum)</span></label>
		<div class="input-wrap">
			<input type="text" name="asking_rent" value="<?php echo $result->fields[7]; ?>"/>
		</div>
	</div>

	<div class="row-wrap cf">
		<label for="asking_key">Asking Key Money</label>
		<div class="input-wrap">
			<input type="text" name="asking_key" value="<?php echo $result->fields[8]; ?>"/>
		</div>
	</div>

	<div class="row-wrap cf">
		<div class="double-wrap">
			<label for="contact_name">Contact</label>
			<div class="input-wrap">
				<input type="text" name="contact_name" value="<?php echo $result->fields[9]; ?>"/>
			</div>
		</div>

		<div class="double-wrap second">
			<label for="contact_number">Phone</label>
			<div class="input-wrap">
				<input type="text" name="contact_number" value="<?php echo $result->fields[10]; ?>"/>
			</div>
		</div>
	</div>

	<div class="row-wrap cf">
		<label for="contact_company">Contact's Company</label>
		<div class="input-wrap">
			<input type="text" name="contact_company" value="<?php echo $result->fields[11]; ?>"/>
		</div>
	</div>

	<div class="row-wrap cf">
		<label for="previous_use">Previous/Current Use</label>
		<div class="input-wrap">
			<input type="text" name="previous_use" value="<?php echo $result->fields[12]; ?>"/>
		</div>
	</div>

	<div class="row-wrap cf">
		<div class="double-wrap">
			<label for="venting">Venting In Place</label>
			<div class="input-wrap">
				<select name="venting">
				<?php
					if($result->fields[13] == 0){
				?>
							<option value="0" selected>No</option>
							<option value="1">Yes</option>
				<?php
					} else { ?>
							<option value="0">No</option>
							<option value="1" selected>Yes</option>
				<?php } ?>
				</select>
			</div>
		</div>

		<div class="double-wrap second">
			<label for="venting_type">Type</label>
			<div class="input-wrap">
				<input type="text" name="venting_type" value="<?php echo $result->fields[14]; ?>"/>
			</div>
		</div>
	</div>

	<div class="row-wrap cf">
		<label for="additional_info">Additional Info</label>
		<div class="input-wrap">
			<input type="text" name="additional_info" value="<?php echo $result->fields[15]; ?>"/>
		</div>
	</div>

	<div class="row-wrap cf">
		<label for="delivery_date">Delivery Date</label>
		<div class="input-wrap">
			<input type="text" name="delivery_date" value="<?php echo $result->fields[16]; ?>"/>
		</div>
	</div>

	<div class="row-wrap cf" id="clients">
	<?php if($clients != null){ 
			foreach($clients as $i=>$client) { ?>
		<div class="double-wrap">
			<label for="clients_recieved">Clients Recieved</label>
			<div class="input-wrap">
				<input class="client-name" type="text" name="clients<?php echo $i+1; ?>name" value="<?php echo $client->name; ?>"/>
			</div>
		</div>

		<div class="double-wrap second">
			<label for="client_date">Date Sent</label>
			<div class="input-wrap">
				<input class="popup client-date" type="text" name="clients<?php echo $i+1; ?>date" value="<?php echo $client->date; ?>"/>
			</div>
		</div>
	<?php } 
		} else{ ?>
			<div class="double-wrap">
			<label for="clients_recieved">Clients Recieved</label>
			<div class="input-wrap">
				<input class="client-name" type="text" name="clients1name" value=""/>
			</div>
		</div>

		<div class="double-wrap second">
			<label for="client_date">Date Sent</label>
			<div class="input-wrap">
				<input class="popup client-date" type="text" name="clients1date" value=""/>
			</div>
		</div>
	<?php } ?>
	<a class="plus" href="#">+</a>
	</div>

	<div class="row-wrap cf">
		<div class="double-wrap">
			<label for="bcd_broker">BCD Broker Name</label>
			<div class="input-wrap">
				<input type="text" name="bcd_broker" value="<?php echo $result->fields[18]; ?>"/>
			</div>
		</div>

		<div class="double-wrap second">
			<label for="bcd_broker_date">Date</label>
			<div class="input-wrap">
				<input class="popup" type="text" name="bcd_broker_date" value="<?php echo $result->fields[19]; ?>"/>
			</div>
		</div>
	</div>
	<input type="hidden" name="action" value="update" />
	<input class="enter" type="submit" />

	</form>

</div>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script type="text/javascript" src="static/js/libs/jquery.datepick.min.js"></script>

<script type="text/javascript" src="static/js/edit-site.js"></script>

<?php include('include/footer.php'); ?>
