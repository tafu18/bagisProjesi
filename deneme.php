<?php 
include 'db.php';
$query = $db->prepare("SELECT * FROM `donation_and_demand_control` ORDER BY id DESC");
$query->execute();
$controls = $query->fetchAll(PDO::FETCH_ASSOC);
$output = [];
	foreach($controls as $control){
		array_push($output,$control);
	}


echo json_encode($output)

?>
