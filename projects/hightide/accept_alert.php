<?php
	$alert = $_POST['alert'];
	$message = $_POST['message'];
	
	if(!empty($alert)){
		$data = array('success'=> true, 'message'=>$message);
		
		$json = array('alert' => $alert, 'message'=>$message);
		
		$file = fopen('alert.json', 'w');
		fwrite($file, json_encode($json));
		fclose($file);
		
		echo json_encode($data);
	}
	else{
		$data = array('success'=> false);
		echo json_encode($data);
	}
?>

