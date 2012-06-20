<?php

include('libs/adodb/adodb.inc.php');

$action = $_POST['action'];

switch($action){
	case 'create':
		createSite();
		break;
	case 'update':
		updateSite();
		break;
	case 'delete':
		deleteSite();
		break;
	default:
		echo "Uh Oh...Something went wrong.";
		break;
}

function deleteSite(){
	$id = $_POST['id'];

	$query = "DELETE FROM sites WHERE id='$id'";
	runQuery($query);
}


function updateSite(){
	$id = $_POST['id'];
	$site = $_POST['site'];
	$address = $_POST['address'];
	$cross_street = $_POST['cross_street'];
	$neighborhood = $_POST['neighborhood'];
	$size = $_POST['size'];
	$frontage = $_POST['frontage'];
	$asking_rent = $_POST['asking_rent'];
	$asking_key = $_POST['asking_key'];
	$contact_name = $_POST['contact_name'];
	$contact_number = $_POST['contact_number'];
	$contact_company = $_POST['contact_company'];
	$previous_use = $_POST['previous_use'];
	$venting = $_POST['venting'];
	$venting_type = $_POST['venting_type'];
	$additional_info = $_POST['additional_info'];
	$delivery_date = $_POST['delivery_date'];
	$clients = $_POST['clients'];
	$bcd_broker = $_POST['bcd_broker'];
	$bcd_broker_date = $_POST['bcd_broker_date'];

	$query = "UPDATE sites SET ";
	$query .= "name='$site', ";
	$query .= "address='$address', ";
	$query .= "cross_street='$cross_street', ";
	$query .= "neighborhood='$neighborhood', ";
	$query .= "size='$size', ";
	$query .= "frontage='$frontage', ";
	$query .= "asking_rent='$asking_rent', ";
	$query .= "asking_key='$asking_key', ";
	$query .= "contact_name='$contact_name', ";
	$query .= "contact_number='$contact_number', ";
	$query .= "contact_company='$contact_company', ";
	$query .= "previous_use='$previous_use', ";
	$query .= "venting='$venting', ";
	$query .= "venting_type='$venting_type', ";
	$query .= "additional_info='$additional_info', ";
	$query .= "delivery_date='$delivery_date', ";
	$query .= "clients='$clients', ";
	$query .= "bcd_broker='$bcd_broker', ";
	$query .= "bcd_broker_date='$bcd_broker_date' ";

	$query .= "WHERE id='$id'";

	runQuery($query);

	//echo $query;
}


function createSite(){
	//getting all required vars
	$site = $_POST['site'];
	$address = $_POST['address'];
	$cross_street = $_POST['cross_street'];
	$neighborhood = $_POST['neighborhood'];
	$size = $_POST['size'];
	$frontage = $_POST['frontage'];
	$asking_rent = $_POST['asking_rent'];
	$asking_key = $_POST['asking_key'];
	$contact_name = $_POST['contact_name'];
	$contact_number = $_POST['contact_number'];
	$contact_company = $_POST['contact_company'];
	$previous_use = $_POST['previous_use'];
	$venting = $_POST['venting'];
	$venting_type = $_POST['venting_type'];
	$additional_info = $_POST['additional_info'];
	$delivery_date = $_POST['delivery_date'];
	$clients = $_POST['clients'];
	$bcd_broker = $_POST['bcd_broker'];
	$bcd_broker_date = $_POST['bcd_broker_date'];

	$query = "INSERT INTO `sites` (`id`, `name`, `address`, `cross_street`, `neighborhood`, `size`, `frontage`, `asking_rent`, `asking_key`, `contact_name`, `contact_number`, `contact_company`, `previous_use`, `venting`, `venting_type`, `additional_info`, `delivery_date`, `clients`, `bcd_broker`, `bcd_broker_date`) VALUES (NULL, '$site', '$address', '$cross_street', '$neighborhood', '$size', '$frontage', '$asking_rent', '$asking_key', '$contact_name', '$contact_number', '$contact_company', '$previous_use', '$venting', '$venting_type', '$additional_info', '$delivery_date', '$clients', '$bcd_broker', '$bcd_broker_date')";


	//echo $query;
	runQuery($query);
}


function runQuery($query){
	# non-persistent connection
	//$dsn = 'mysql://root:root@localhost/bcd_dev'; 
	$dsn = 'mysql://root:tigger01@localhost/bcd_dev';
	$db = NewADOConnection($dsn);
	if (!$db) die("Connection to databse failed");

	if ($db->Execute($query) === false) {
         print 'error: '.$conn->ErrorMsg();
	}
	else{
		print 'success';
	}
}


?>