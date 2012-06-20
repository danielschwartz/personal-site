<?php include('include/header.php'); ?>
<?php 

?>
<div id="search-advanced">
	<form action="advanced-results.php" method="post">
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
		<label for="street">Street</label>
		<div class="input-wrap">
			<input type="text" name="street" />
		</div>
	</div>

	<div class="row-wrap cf">
		<div class="double-wrap">
			<label for="date_start">Date Range</label>
			<div class="input-wrap">
				<input type="text" name="date_start" class="popup"/>
			</div>
		</div>

		<div class="double-wrap second">
			<label for="date_end">to</label>
			<div class="input-wrap">
				<input type="text" name="date_end" class="popup"/>
			</div>
		</div>
	</div>

	<div class="row-wrap cf">
		<div class="double-wrap">
			<label for="size_start">Size Range</label>
			<div class="input-wrap">
				<input type="text" name="size_start" />
			</div>
		</div>

		<div class="double-wrap second">
			<label for="size_end">to</label>
			<div class="input-wrap">
				<input type="text" name="size_end" />
			</div>
		</div>
	</div>

	<div class="row-wrap cf">
		<div class="double-wrap">
			<label for="rent_start">Asking Rent Range <br/><span class="rent">(per annum)</span></label>
			<div class="input-wrap">
				<input type="text" name="rent_start" />
			</div>
		</div>

		<div class="double-wrap second">
			<label for="rent_end">to</label>
			<div class="input-wrap">
				<input type="text" name="rent_end" />
			</div>
		</div>
	</div>
	<input class="enter" type="submit" />
	</form>
</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script type="text/javascript" src="static/js/libs/jquery.datepick.min.js"></script>

<script type="text/javascript" src="static/js/search-advanced.js"></script>
<?php include('include/footer.php'); ?>
