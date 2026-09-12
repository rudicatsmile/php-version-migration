<?php

	$mysqli = @new mysqli('db-server', 'root', 'ra11-192011', 'simbada',3306);
	if ($mysqli->connect_errno) {
	    die('Connect Error: ' . $mysqli->connect_errno);
	}
	
	date_default_timezone_set("Asia/Jakarta");
	$filter_waktu = " AND DATE(waktu) = CURDATE() ";
	$model_antrian = 1;
	
	
	
?>
