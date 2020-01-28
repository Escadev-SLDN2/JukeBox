<?php
//	Ce script se connecte à la BDD via un PDO.

//	modifier les valeurs ici pour adapter à la bdd en preprod et en prod
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'phpjukebox');
	define('DB_PASSWORD', '');
	define('DB_NAME', 'test');

	try{
		$pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e){
		die("ERROR: Could not connect. " . $e->getMessage());
	}
?>