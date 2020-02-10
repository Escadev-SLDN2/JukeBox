<?php
	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);
	require_once "../users.php";
	
	if(User::isMailUsed("test2localhost")){
        $user=User::getFromMail("test2localhost");	
	}else{
		$user=User::add("blabla", "bla", "test2localhost", "azerty2");
	}

/*	Le but ici est de tester la gestion des roles

	try{echo "is SU :".((User::isSUSet()) ? "true" : "false")."<br>\n";}catch(Exception $e){echo($e->getMessage())."<br>\n";}
		Permet d'afficher si un SU est desingne dans la bdd ou non .

	echo "is connected :".(User::isConnected() ? "true" : "false")."<br>\n";
		Permet d'afficher si un user est connecte dans cette session ou non .

	try{(User::connect("test2localhost", "azerty2")); echo"<br>\n";} catch(Exception $e){echo($e->getMessage())."<br>\n";}
		Connecte un user.
	
	try{$_SESSION['user']->changeRole(""); echo "action :set role SU<br>\n";}catch(Exception $e){echo($e->getMessage())."<br>\n";}
		Change le role du user connecte actuellement.

*/

	try{echo "is SU :".((User::isSUSet()) ? "true" : "false")."<br>\n";}catch(Exception $e){echo($e->getMessage())."<br>\n";}
	echo "is connected :".(User::isConnected() ? "true" : "false")."<br>\n";
	echo "action :connection ";
	try{(User::connect("test2localhost", "azerty2")); echo"<br>\n";} catch(Exception $e){echo($e->getMessage())."<br>\n";}
	echo "is connected :".(User::isConnected() ? "true" : "false")."<br>\n";
	try{echo "is SU :".((User::isSUSet()) ? "true" : "false")."<br>\n";}catch(Exception $e){echo($e->getMessage())."<br>\n";}
	try{$_SESSION['user']->changeRole("SU"); echo "action :set role SU<br>\n";}catch(Exception $e){echo($e->getMessage())."<br>\n";}
	try{echo "is SU :".((User::isSUSet()) ? "true" : "false")."<br>\n";}catch(Exception $e){echo($e->getMessage())."<br>\n";}
	try{$_SESSION['user']->changeRole("NULL"); echo "action :set role NULL<br>\n";}catch(Exception $e){echo($e->getMessage())."<br>\n";}
	try{echo "is SU :".((User::isSUSet()) ? "true" : "false")."<br>\n";}catch(Exception $e){echo($e->getMessage())."<br>\n";}
	User::disconnect();
	$user->delete();
	Bdd::disconnect();

/* 
	la page devrait afficher :

		is SU :false
		is connected :false
		action :connection
		is connected :true
		is SU :false
		action :set role SU
		is SU :true
		action :set role NULL
		is SU :false
*/
?>