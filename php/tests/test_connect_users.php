<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	include "../connect_user.php";

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
?>