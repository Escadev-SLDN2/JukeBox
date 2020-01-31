<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	include "../connect_user.php";

/*	Le but ici est de tester la connection d'un user

	echo "is connected :".(isUserConnected() ? "true" : "false")."<br>\n"; 
		Permet d'afficher si un user est connecte dans cette session ou non .
		
	echo "action :connection".(connectUser("test2localhost", "azerty2"))."<br>\n"; 
		Connecte un user.
		
	Changez "test2localhost" et "azerty2" pour correspondre au mail et au password d'un user present dans votre bdd.
	Remplacez "test2localhost" et "azerty2" par n'importe quel couple (mail, password) qui n'est pas present dans votre table users pour tester le refut de connexion par la fonction.

*/

	echo "is connected :".(isUserConnected() ? "true" : "false")."<br>\n";
	echo "action :connection ".(connectUser("test2localhost", "azerty2"))."<br>\n";
	echo "is connected :".(isUserConnected() ? "true" : "false")."<br>\n";
	echo "action :disconnection<br>\n"; disconnectUser();
	echo "is connected :".(isUserConnected() ? "true" : "false")."<br>\n";
	echo "action :connection ".(connectUser("test2localhost", "azerty"))."<br>\n";
	echo "is connected :".(isUserConnected() ? "true" : "false")."<br>\n";
	echo "action :connection ".(connectUser("testlocalhost", "azerty"))."<br>\n";
	echo "is connected :".(isUserConnected() ? "true" : "false")."<br>\n";
	echo "action :connection ".(connectUser("", ""))."<br>\n";
	echo "is connected :".(isUserConnected() ? "true" : "false")."<br>\n";

	Bdd::disconnect();
?>