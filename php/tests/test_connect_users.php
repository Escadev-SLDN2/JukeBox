<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	include "../connect_user.php";

	echo (isUserConnected() ? "true" : "false")."<br>";
	echo (connectUser("test2localhost", "azerty2"))."<br>";
	echo (isUserConnected() ? "true" : "false")."<br>";
	disconnectUser();
	echo (isUserConnected() ? "true" : "false")."<br>";
	echo (connectUser("test2localhost", "azerty"))."<br>";
	echo (isUserConnected() ? "true" : "false")."<br>";
	echo (connectUser("testlocalhost", "azerty"))."<br>";
	echo (isUserConnected() ? "true" : "false")."<br>";
	echo (connectUser("", ""))."<br>";
	echo (isUserConnected() ? "true" : "false")."<br>";
?>