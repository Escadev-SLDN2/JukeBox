<?php
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		require_once "../connectBDD.php";
		include "../users.php";

//		tests des ajouts

//		addUser("test", "tt", "test@localhost", "test");
//		addUser(test2, tt2, test2localhost, test2);
//		addUser(3, tt3, test3localhost, test3);

//		tests des suppression

//		delUser(13);

//		tests des modification

//		modUser(15, "blabla", "bla", "bla@bla", "azerty");
//		modUser(16, "", "bla2");
//		modUser(17, "", "", "bla3@bla");
//		modUser(18, "", "", "", "azerty2");
//		modUser(19, "", "bla5", "", "azea");

//		tests de getUserIdFromMail()

//		try{echo getUserIdFromMail("test2localhost");} catch(Exception $e){echo($e->getMessage());}
//		try{echo getUserIdFromMail("");} catch(Exception $e){echo($e->getMessage());}

//		tests de getUserFromId()
	
//		try{echo getUserFromId(18);} catch(Exception $e){echo($e->getMessage());}
//		try{echo getUserFromId(-1);} catch(Exception $e){echo($e->getMessage());}
	
//		tests de isPasswdValid()

//		echo (isPasswdValid(18,"azerty2") ? "true" : "false")."<br>";
//		echo (isPasswdValid(18,"azerty3") ? "true" : "false")."<br>";
//		echo (isPasswdValid(-1,"azerty3") ? "true" : "false")."<br>";

		unset($GLOBALS['pdo']);
?>