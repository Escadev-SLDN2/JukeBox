<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once "../users.php";
session_start();

if(isset($_COOKIE['userId'])){
	echo "votre cookie 'userId' contiend : ".$_COOKIE['userId']."<br>\n";
}else{
	echo "vos cookies sont vides pour ce site"."<br>\n";	
}
if(isset($_SESSION["user"])){
	echo "votre session contient : ";
	print_r($_SESSION);
	echo "<br>\n";
}else{
	echo "votre session est vide pour ce site"."<br>\n";	
}

if(User::isConnected()){
	echo "vous êtes connecté"."<br>\n";
}else{
	echo "vous n'êtes pas connectés"."<br>\n";
}

if(isset($_SESSION["user"])){
	echo "votre session contient : ";
	print_r($_SESSION);
	echo "<br>\n";
}else{
	echo "votre session est vide pour ce site"."<br>\n";	
}

