<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	include "../users.php";

//	tests des ajouts

//	addUser("test", "tt", "test@localhost", "test");
//	addUser(test2, tt2, test2localhost, test2);
//	addUser(3, tt3, test3localhost, test3);

//	tests des suppression

//	delUser(13);

//	tests des modification

//	modUser(15, "blabla", "bla", "bla@bla", "azerty");
//	modUser(16, "", "bla2");
//	modUser(17, "", "", "bla3@bla");
//	modUser(18, "", "", "", "azerty2");
//	modUser(19, "", "bla5", "", "azea");

//	tests de getUserIdFromMail()

	try{echo (getUserIdFromMail("test2localhost"))."<br>\n";} catch(Exception $e){echo($e->getMessage())."<br>\n";}
//	try{echo (getUserIdFromMail(""))."<br>\n";} catch(Exception $e){echo($e->getMessage())."<br>\n";}

//	tests de getUserFromId()

	try{print_r (getUserFromId(18)); echo "<br>\n";} catch(Exception $e){echo($e->getMessage())."<br>\n";}
//	try{print_r (getUserFromId()); echo "<br>\n";} catch(Exception $e){echo($e->getMessage())."<br>\n";}

//	tests de isPasswdValid()
	echo (isPasswdValid(18,"azerty2") ? "true" : "false")."<br>\n";
//	echo (isPasswdValid(18,"azerty3") ? "true" : "false")."<br>\n";
//	echo (isPasswdValid(-1,"azerty3") ? "true" : "false")."<br>\n";

	Bdd::disconnect();
?>