<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	include "../connect_bdd.php";

	echo "is pdo set :".(isset($pdo) ? "true" : "false")."<br>\n";
	$pdo =& Bdd::connect();
	echo "is pdo set :".(isset($pdo) ? "true" : "false")."<br>\n";
	echo "action : SELECT id, name, nickname FROM users<br>\n";
	foreach ($pdo->query("SELECT id, name, nickname FROM users") as $row){ print_r($row); echo "<br>\n";}
	Bdd::disconnect($pdo);
	echo "is pdo set :".(isset($pdo) ? "true" : "false")."<br>\n";

?>