<?php
if (!empty($_GET['lat']) && !empty($_GET['long'])) {
	
	$latitude = $_GET['lat'];
	$longtitude = $_GET['long'];
	
	try {
		
		$objDb = new PDO ("mysql:host=localhost;dbname=map", "root", "password");
		$objDb->exec("SET CHARACTER SET utf8");
		
		$sql = "INSERT INTO `maps` (`latitude`, `longtitude`)
				VALUES (?, ?)";
		$statement = $objDb->prepare($sql);
		$statement->execute(array($latitude, $longtitude));
		
		echo json_encode(array('error' => false));
		
	} catch(PDOException $e) {
	
		echo json_encode(array('error' => true, 'message' => $e->getMessage()));
		
	}
	
} else {
	echo json_encode(array('error' => true));
}