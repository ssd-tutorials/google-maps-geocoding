<?php
$id = !empty($_GET['id']) ? $_GET['id'] : 1;
try {
		
	$objDb = new PDO ("mysql:host=localhost;dbname=map", "root", "password");
	$objDb->exec("SET CHARACTER SET utf8");
	
	$sql = "SELECT *
			FROM `maps`
			WHERE `id` = ?";
	$statement = $objDb->prepare($sql);
	$statement->execute(array($id));
	$row = $statement->fetch(PDO::FETCH_ASSOC);
	
} catch(PDOException $e) {

	echo $e->getMessage();
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Google Map Search</title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta http-equiv="imagetoolbar" content="no" />
<link href="/css/core.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div id="wrapper">
	
	<p><a href="/index.php">Back to the form</a></p>
	
	<div id="map_canvas" class="display" rel="<?php echo $row['latitude'].'='.$row['longtitude']; ?>">
			
	</div>

</div>


<script src="/js/jquery-1.6.2.min.js" type="text/javascript"></script>
<script src="/js/core.js" type="text/javascript"></script>
</body>
</html>