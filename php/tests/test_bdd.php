<?php
	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);

	include "../connect_bdd.php";


/*	Le but ici est de tester si la connection et la deconnection avec la bdd fonctionnne

	echo "is pdo set :".(isset($pdo) ? "true" : "false")."<br>\n";	
		Permet d'afficher si la variable $pdo est initialisee ou non .
		
	$pdo =& Bdd::connect(); 
		Apelle la methode de la class Bdd qui sert à initialiser le pdo s'il ne l'est pas et renvois sa référence. ensuite elle lie la variable $pdo a cette reference.
		
	Bdd::disconnect($pdo); 
		Apelle la methode de la class Bdd qui sert à supprimer le pdo.
		
	foreach ($pdo->query("SELECT id, name, nickname FROM users") as $row){ print_r($row); echo "<br>\n";} 
		Permet d'afficher les resultats de la requette SELECT id, name, nickname FROM users;.
*/

	echo "is pdo set :".(isset($pdo) ? "true" : "false")."<br>\n";
	$pdo =& Bdd::connect();
	echo "is pdo set :".(isset($pdo) ? "true" : "false")."<br>\n";
	echo "action : SELECT id, name, nickname FROM users<br>\n";
	foreach ($pdo->query("SELECT id, name, nickname FROM users") as $row){ print_r($row); echo "<br>\n";}
	Bdd::disconnect($pdo);
	echo "is pdo set :".(isset($pdo) ? "true" : "false")."<br>\n";

?>