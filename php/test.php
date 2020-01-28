<?php
	require_once "connectBDD.php";
	include "users.php";

	echo isset($GLOBALS['pdo']) ? 'true' : 'false';
//	$pdo->query('INSERT INTO users (name, nickname, email, hash_pass) VALUES ("blabla2", "bla2", "bla2@bla", "ref4e6r")');

//	tests ajouts

//	addUser("test", "tt", "test@localhost", "test");
//	addUser(test2, tt2, test2localhost, test2);
//	addUser(3, tt3, test3localhost, test3);

//	tests suppression

//	delUser(13);


//	tests modification

//	modUser(14); cause une erreur
//	modUser(15, "blabla", "bla", "bla@bla", "azerty");
//	modUser(16, "", "bla2");
//	modUser(17, "", "", "bla3@bla");
//	modUser(18, "", "", "", "azerty2");
	modUser(19, "", "bla5", "", "azea");

//	tests getIdFromMail()

//	tests get userFromId()
	unset($GLOBALS['pdo']);
?>