<?php
	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);
	require_once "../users.php";

/*	Le but ici est de tester la connection d'un user

	echo "is connected :".(isConnected() ? "true" : "false")."<br>\n"; 
		Permet d'afficher si un user est connecte dans cette session ou non .
		
	echo "action :connection".(connect("test2localhost", "azerty2"))."<br>\n"; 
		Connecte un user.
		
	Changez "test2localhost" et "azerty2" pour correspondre au mail et au password d'un user present dans votre bdd.
	Remplacez "test2localhost" et "azerty2" par n'importe quel couple (mail, password) qui n'est pas present dans votre table users pour tester le refut de connexion par la fonction.

*/
	if(User::getIdFromMail("test2localhost")==-1){
		$user=User::add("blabla", "bla", "test2localhost", "azerty2");
	}else{
		$user=User::getFromId(User::getIdFromMail("test2localhost"));	
	}


	echo "is connected :".(User::isConnected() ? "true" : "false")."<br>\n";
	echo "action :connection ";
	try{(User::connect("test2localhost", "azerty2")); echo"<br>\n";} catch(Exception $e){echo($e->getMessage())."<br>\n";}
	echo "is connected :".(User::isConnected() ? "true" : "false")."<br>\n";
	echo "action :disconnection<br>\n"; User::disconnect();
	echo "is connected :".(User::isConnected() ? "true" : "false")."<br>\n";
	echo "action :connection ";
	try{(User::connect("test2localhost", "azerty")); echo"<br>\n";} catch(Exception $e){echo($e->getMessage())."<br>\n";}
	echo "is connected :".(User::isConnected() ? "true" : "false")."<br>\n";
	echo "action :connection ";
	try{(User::connect("testlocalhost", "azerty")); echo"<br>\n";} catch(Exception $e){echo($e->getMessage())."<br>\n";}
	echo "is connected :".(User::isConnected() ? "true" : "false")."<br>\n";
	echo "action :connection ";
	try{(User::connect("", "")); echo"<br>\n";} catch(Exception $e){echo($e->getMessage())."<br>\n";}
	echo "is connected :".(User::isConnected() ? "true" : "false")."<br>\n";

	$user->delete();
	Bdd::disconnect();
?>