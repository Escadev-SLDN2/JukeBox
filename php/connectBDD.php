<?php
//	Ce script se connecte à la BDD via un PDO.

//	modifier les valeurs ici pour adapter à la bdd en preprod et en prod
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'jukebox');
	define('DB_PASSWORD', 'A9Z8E1R2');
	define('DB_NAME', 'jukebox');

	try{
		$GLOBALS['pdo'] = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
		$GLOBALS['pdo']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "bdd connected <br>";
	} catch(PDOException $e){
		die("ERROR: Could not connect. " . $e->getMessage());
	}
	
?>