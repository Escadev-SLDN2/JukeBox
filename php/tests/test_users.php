<?php
	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);
	include "../users.php";
	$pdo =& Bdd::connect();
	$pdo->query("DELETE FROM users");

/*	Tests des ajouts
	try{print_r (getUserFromId($id)); echo "<br>\n";} catch(Exception $e){echo($e->getMessage())."<br>\n";} 
		Affiche l'array correspondant au user possedant l'id s'il y en a un, sinon affiche le message d'erreur.
*/

	try{$user0 = User::add("test0", "tt0", "test0@localhost", "test");} catch(Exception $e){echo($e->getMessage())."<br>\n";}
	try{$test = User::add("test0", "tt0", "test0@localhost", "test");} catch(Exception $e){echo($e->getMessage())."<br>\n";}
	try{$user1 = User::add("test1", "tt1", "test1@localhost", "test");} catch(Exception $e){echo($e->getMessage())."<br>\n";}
	try{$user2 = User::add("test2", "tt2", "test2@localhost", "test");} catch(Exception $e){echo($e->getMessage())."<br>\n";}

	if(isset($user0)){try{print_r (User::getFromId($user0->id)); echo "<br>\n";} catch(Exception $e){echo($e->getMessage())."<br>\n";}}else{echo"User is not set <br>\n";}
	if(isset($test)){try{print_r (User::getFromId($test->id)); echo "<br>\n";} catch(Exception $e){echo($e->getMessage())."<br>\n";}}else{echo"User is not set <br>\n";}
	if(isset($user1)){try{print_r (User::getFromId($user1->id)); echo "<br>\n";} catch(Exception $e){echo($e->getMessage())."<br>\n";}}else{echo"User is not set <br>\n";}
	if(isset($user2)){try{print_r (User::getFromId($user2->id)); echo "<br>\n";} catch(Exception $e){echo($e->getMessage())."<br>\n";}}else{echo"User is not set <br>\n";}

/*	Tests des suppression

*/
	if(isset($user0)){$user0->delete();}

/*	Tests des modification

	Remplacez les id des utilisateur par ceux d'user present dans votre bdd pour tester les modifications.
	Vérifiez le contenu de votre bdd pour confirmer le fonctionnement.
	Les valeurs que vous ne voullez pas modifier peuvent être remplacer par "" ou etre omis s'ils sont les derniers paramettres de la fonction.
*/

	$user1->modify("blabla", "bla", "bla@bla", "azerty");
	$user2->modify("", "bla5", "", "azea");
	try{print_r (User::getFromId($user1->id)); echo "<br>\n";} catch(Exception $e){echo($e->getMessage())."<br>\n";}
	try{print_r (User::getFromId($user2->id)); echo "<br>\n";} catch(Exception $e){echo($e->getMessage())."<br>\n";}

/*	Tests de getUserIdFromMail()

	try{echo (getUserIdFromMail("test2localhost"))."<br>\n";} catch(Exception $e){echo($e->getMessage())."<br>\n";} 
		Affiche l'id du user possedant ce mail s'il y en a un, sinon affiche le message d'erreur.	
*/

	try{echo (User::getIdFromMail("test@test"))."<br>\n";} catch(Exception $e){echo($e->getMessage())."<br>\n";}
	try{echo (User::getIdFromMail($user1->mail))."<br>\n";} catch(Exception $e){echo($e->getMessage())."<br>\n";}

/*	Tests de isPasswdValid()

	echo (isPasswdValid(18,"azerty2") ? "true" : "false")."<br>\n"; 
		Permet d'afficher si le couple (id, password) est valide ou non .
		
*/

	echo (User::isPasswdValid($user1->id,"azerty") ? "true" : "false")."<br>\n";
	echo (User::isPasswdValid($user1->id,"test") ? "true" : "false")."<br>\n";

	$user1->delete();
	$user2->delete();
	Bdd::disconnect();
?>