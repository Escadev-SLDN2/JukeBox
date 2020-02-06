<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	include "../users.php";

/*	Tests des ajouts
	
*/

	addUser("test", "tt", "test@localhost", "test");

/*	Tests des suppression

	remplacez 13 par un id existant dans votre bdd et vérifiez le contenu de votre bdd pour confirmer le fonctionnement
*/

	delUser(13);

/*	Tests des modification

	Remplacez les id des utilisateur par ceux d'user present dans votre bdd pour tester les modifications.
	Vérifiez le contenu de votre bdd pour confirmer le fonctionnement.
	Les valeurs que vous ne voullez pas modifier peuvent être remplacer par "" ou etre omis s'ils sont les derniers paramettres de la fonction.
*/

	modUser(15, "blabla", "bla", "bla@bla", "azerty");
	modUser(19, "", "bla5", "", "azea");

/*	Tests de getUserIdFromMail()

	try{echo (getUserIdFromMail("test2localhost"))."<br>\n";} catch(Exception $e){echo($e->getMessage())."<br>\n";} 
		Affiche l'id du user possedant ce mail s'il y en a un, sinon affiche le message d'erreur.
		
	Remplacez "test2localhost" par le mail d'un user present dans votre table users pour tester le fonctionnement normal de la fonction.
	Remplacez "test2localhost" par n'importe quoi qui n'est pas present en mail dans votre table users pour tester le fonctionnement du message d'erreur de la fonction.
*/

	try{echo (getUserIdFromMail("test2localhost"))."<br>\n";} catch(Exception $e){echo($e->getMessage())."<br>\n";}

/*	Tests de getUserFromId()

	try{print_r (getUserFromId(18)); echo "<br>\n";} catch(Exception $e){echo($e->getMessage())."<br>\n";} 
		Affiche l'array correspondant au user possedant l'id s'il y en a un, sinon affiche le message d'erreur.
		
	Remplacez 18 par l'id d'un user present dans votre table users pour tester le fonctionnement normal de la fonction.
	Remplacez 18 par n'importe quoi qui n'est pas present en id dans votre table users pour tester le fonctionnement du message d'erreur de la fonction.
*/

	try{print_r (getUserFromId(18)); echo "<br>\n";} catch(Exception $e){echo($e->getMessage())."<br>\n";}

/*	Tests de isPasswdValid()

	echo (isPasswdValid(18,"azerty2") ? "true" : "false")."<br>\n"; 
		Permet d'afficher si le couple (id, password) est valide ou non .
		
	Remplacez 18 et "azerty2" par l'id et le mot de passe d'un user present dans votre table users pour tester la validation par la fonction.
	Remplacez 18 et "azerty2" par n'importe quel couple (id, password) qui n'est pas present dans votre table users pour tester l'invalidation par la fonction.
*/

	echo (isPasswdValid(18,"azerty2") ? "true" : "false")."<br>\n";


	Bdd::disconnect();
?>