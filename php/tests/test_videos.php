<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	include "../videos.php";

/*	Tests des ajouts
    d'une video
*/

    addvideos("papase", 2);
    addvideos("baba", 1);

/*	Tests des suppression d'une video

	remplacez 15 par un id existant dans votre bdd et vérifiez le contenu de votre bdd pour confirmer le fonctionnement
*/

    delvideos(1);

/*	Tests des modification d'une video

	Remplacez les id des videos par ceux de video present dans votre bdd pour tester les modifications.
	Vérifiez le contenu de votre bdd pour confirmer le fonctionnement.
	Les valeurs que vous ne voullez pas modifier peuvent être remplacer par "" ou etre omis s'ils sont les derniers paramettres de la fonction.
*/

    //modifvideos(15, "blabla",20);
	//modifvideos(19, "bla5", 15);

?>