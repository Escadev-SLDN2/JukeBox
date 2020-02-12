<?php
require_once "../users.php";

if(isset($_COOKIE['userId'])){
	echo "votre cookie 'userId' contiend : ".$_COOKIE['userId']."<br>\n";
}else{
	echo "vos cookies sont vides pour ce site"."<br>\n";	
}

if(isset($_SESSION["user"])){
	echo "votre session contiend : ";
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

