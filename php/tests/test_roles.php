<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	include "../connect_user.php";

/*	Le but ici est de tester la gestion des roles

	try{echo "is SU :".((isSUserSet()) ? "true" : "false")."<br>\n";}catch(Exception $e){echo($e->getMessage())."<br>\n";}
		Permet d'afficher si un SU est desingne dans la bdd ou non .

	echo "is connected :".(isUserConnected() ? "true" : "false")."<br>\n"; 
		Permet d'afficher si un user est connecte dans cette session ou non .

	echo "action :connection".(connectUser("test2localhost", "azerty2"))."<br>\n"; 
		Connecte un user.
	
	Changez "test2localhost" et "azerty2" pour correspondre au mail et au password d'un user present dans votre bdd.

	try{changeConnectedUserRole("SU"); echo "action :set role SU<br>\n";}catch(Exception $e){echo($e->getMessage())."<br>\n";} 
		Donne le role "SU" au user connecte actuellement.

	try{changeConnectedUserRole("NULL"); echo "action :set role NULL<br>\n";}catch(Exception $e){echo($e->getMessage())."<br>\n";} 
		Enleve le role "SU" au user connecte actuellement. 
*/

	try{echo "is SU :".((User::isSUserSet()) ? "true" : "false")."<br>\n";}catch(Exception $e){echo($e->getMessage())."<br>\n";}
	echo "is connected :".(isUserConnected() ? "true" : "false")."<br>\n";
	echo "action :connection".(connectUser("test2localhost", "azerty2"))."<br>\n";
	echo "is connected :".(isUserConnected() ? "true" : "false")."<br>\n";
	try{echo "is SU :".((User::isSUserSet()) ? "true" : "false")."<br>\n";}catch(Exception $e){echo($e->getMessage())."<br>\n";}
	try{$_SESSION['user']->changeUserRole("SU"); echo "action :set role SU<br>\n";}catch(Exception $e){echo($e->getMessage())."<br>\n";}
	try{echo "is SU :".((User::isSUserSet()) ? "true" : "false")."<br>\n";}catch(Exception $e){echo($e->getMessage())."<br>\n";}
	try{$_SESSION['user']->changeUserRole("NULL"); echo "action :set role NULL<br>\n";}catch(Exception $e){echo($e->getMessage())."<br>\n";}
	try{echo "is SU :".((User::isSUserSet()) ? "true" : "false")."<br>\n";}catch(Exception $e){echo($e->getMessage())."<br>\n";}
	disconnectUser();

	Bdd::disconnect();
?>