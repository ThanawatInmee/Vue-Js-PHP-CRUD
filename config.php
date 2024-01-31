<?php 

	$host = "localhost"; // Change Hosting
	$user = "root"; // Change Username Database
	$pass = ""; // Change Password Database
	$database = "vue"; // Change Database Name

	try {
		$db = new PDO("mysql:host=$host;dbname=$database", $user, $pass);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}

 ?>