<?php include('include/header.php'); ?>

<div id="new-site">
	<form action="dbmanager.php" method="post" class="new-site">

	<div class="row-wrap cf">
		<label for="site">Site Name</label>
		<div class="input-wrap">
			<input type="text" name="site" />
		</div>
	</div>

	<div class="row-wrap cf">
		<label for="address">Address</label>
		<div class="input-wrap">
			<input type="text" name="address" />
		</div>
	</div>

	<div class="row-wrap cf">
		<label for="cross_street">Cross Street</label>
		<div class="input-wrap">
			<input type="text" name="cross_street" />
		</div>
	</div>
	<div class="row-wrap cf">
		<label for="neighborhood">Neighborhood</label>
		<div class="neighborhood-wrap">
			<?php foreach($neighborhoods as $neighborhood) { ?>
			<div class="radio-wrap cf">
				<input type="radio" name="neighborhood" value="<?php echo $neighborhood; ?>" />
				<span><?php echo $neighborhood; ?></span>
			</div>
			<?php } ?>
		</div>
	</div>

	<div class="row-wrap cf">
		<label for="size">Size</label>
		<div class="input-wrap">
			<input type="text" name="size" />
		</div>
	</div>

	<div class="row-wrap cf">
		<label for="frontage">Frontage</label>
		<div class="input-wrap">
			<input type="text" name="frontage" />
		</div>
	</div>

	<div class="row-wrap cf">
		<label for="asking_rent">Asking Rent <span class="rent">(per annum)</span></label>
		<div class="input-wrap">
			<input type="text" name="asking_rent" />
		</div>
	</div>

	<div class="row-wrap cf">
		<label for="asking_key">Asking Key Money</label>
		<div class="input-wrap">
			<input type="text" name="asking_key" />
		</div>
	</div>

	<div class="row-wrap cf">
		<div class="double-wrap">
			<label for="contact_name">Contact</label>
			<div class="input-wrap">
				<input type="text" name="contact_name" />
			</div>
		</div>

		<div class="double-wrap second">
			<label for="contact_number">Phone</label>
			<div class="input-wrap">
				<input type="text" name="contact_number" />
			</div>
		</div>
	</div>

	<div class="row-wrap cf">
		<label for="contact_company">Contact's Company</label>
		<div class="input-wrap">
			<input type="text" name="contact_company" />
		</div>
	</div>

	<div class="row-wrap cf">
		<label for="previous_use">Previous/Current Use</label>
		<div class="input-wrap">
			<input type="text" name="previous_use" />
		</div>
	</div>

	<div class="row-wrap cf">
		<div class="double-wrap">
			<label for="venting">Venting In Place</label>
			<div class="input-wrap">
				<select name="venting">
					<option value="0">No</option>
					<option value="1">Yes</option>
				</select>
			</div>
		</div>

		<div class="double-wrap second">
			<label for="venting_type">Type</label>
			<div class="input-wrap">
				<input type="text" name="venting_type" />
			</div>
		</div>
	</div>

	<div class="row-wrap cf">
		<label for="additional_info">Additional Info</label>
		<div class="input-wrap">
			<input type="text" name="additional_info" />
		</div>
	</div>

	<div class="row-wrap cf">
		<label for="delivery_date">Delivery Date</label>
		<div class="input-wrap">
			<input type="text" name="delivery_date" />
		</div>
	</div>

	<div class="row-wrap cf" id="clients">
		<div class="double-wrap">
			<label for="clients_recieved">Client Recieved</label>
			<div class="input-wrap">
				<input type="text" name="client1name" class="client-name" />
			</div>
		</div>

		<div class="double-wrap second">
			<label for="client_date">Date Sent</label>
			<div class="input-wrap">
				<input class="popup client-date" type="text" name="client1date" />
			</div>
		</div>
		<a href="#" class="plus">+</a>
	</div>

	<div class="row-wrap cf">
		<div class="double-wrap">
			<label for="bcd_broker">BCD Broker Name</label>
			<div class="input-wrap">
				<input type="text" name="bcd_broker" />
			</div>
		</div>

		<div class="double-wrap second">
			<label for="bcd_broker_date">Date</label>
			<div class="input-wrap">
				<input class="popup" type="text" name="bcd_broker_date" />
			</div>
		</div>
	</div>
	<input type="hidden" name="action" value="create" />
	<input class="enter" type="submit" />

	</form>

</div>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script type="text/javascript" src="static/js/libs/jquery.datepick.min.js"></script>

<script type="text/javascript" src="static/js/new-site.js"></script>
<?php include('include/footer.php'); ?>


<!--
	<div class="row-wrap cf">
		<label for=""></label>
		<input type="text" name="" />
	</div>

-->