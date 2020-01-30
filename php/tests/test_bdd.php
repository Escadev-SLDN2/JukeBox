<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	include "../connectBDD.php";

//	echo (isset($pdo) ? "true" : "false")."<br>";
//	$pdo =& Bdd::connect();
//	echo (isset($pdo) ? "true" : "false")."<br>";
//	foreach ($pdo->query("SELECT id, name, nickname FROM users") as $row){print_r($row); echo "<br>";}
//	Bdd::disconnect($pdo);
//	echo (isset($pdo) ? "true" : "false")."<br>";

?>