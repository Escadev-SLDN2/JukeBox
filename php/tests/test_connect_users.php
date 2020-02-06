<?php
	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);
	require_once "../users.php";

/*	Le but ici est de tester la connection d'un user

	echo "is connected :".(User::isConnected() ? "true" : "false")."<br>\n";
		Permet d'afficher si un user est connecte dans cette session ou non .
		
	try{(User::connect("test2localhost", "azerty2")); echo"<br>\n";} catch(Exception $e){echo($e->getMessage())."<br>\n";} 
		Connecte un user si le id et le passwd est valide. Sinon affiche l'erreur.
		
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

/* 
	la page devrait afficher :
	
		is connected :false
		action :connection
		is connected :true
		action :disconnection
		is connected :false
		action :connection Invalid Password
		is connected :false
		action :connection Invalid Password
		is connected :false
		action :connection Please enter your email.
		is connected :false
*/
?>