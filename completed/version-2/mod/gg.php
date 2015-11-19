<?php
$post_code = stripcslashes($_GET['pc']);

if (!empty($post_code)) {

	$post_code = urlencode($post_code);
	
	$location = 'http://maps.googleapis.com/maps/api/geocode/json?address='.$post_code.'&sensor=false';
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $location);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	curl_close($ch);
	
	echo $result;

}