<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	include "../connect_user.php";

	try{echo "is SU :".((isSUserSet()) ? "true" : "false")."<br>\n";}catch(Exception $e){echo($e->getMessage())."<br>\n";}
	echo "is connected :".(isUserConnected() ? "true" : "false")."<br>\n";
	echo "action :connection".(connectUser("test2localhost", "azerty2"))."<br>\n";
	echo "is connected :".(isUserConnected() ? "true" : "false")."<br>\n";
	try{echo "is SU :".((isSUserSet()) ? "true" : "false")."<br>\n";}catch(Exception $e){echo($e->getMessage())."<br>\n";}
	try{changeConnectedUserRole("SU"); echo "action :set role SU<br>\n";}catch(Exception $e){echo($e->getMessage())."<br>\n";}
	try{echo "is SU :".((isSUserSet()) ? "true" : "false")."<br>\n";}catch(Exception $e){echo($e->getMessage())."<br>\n";}
	try{changeConnectedUserRole("NULL"); echo "action :set role NULL<br>\n";}catch(Exception $e){echo($e->getMessage())."<br>\n";}
	disconnectUser();
?>