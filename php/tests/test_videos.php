<?php
   // Affichage des erreurs détaillées :
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   error_reporting(E_ALL);

	//recuperation des données
	require_once "../videos.php";

	//connection à la basse de donner
//	$pdo =& Bdd::connect();
//	$pdo ->query("DELETE FROM videos WHERE id_yt='SDdZx' or id_yt='mbEciS'");

	/*  ici Tests des ajouts
    d'une video
	*/

	/*try {
		addvideos("SDdhuZx",6);
	} catch (Exception $e) {
		echo($e->getMessage())."<br>\n";
	}

	/*	ici Tests des suppression
	 d'une video

	*/
	
	try {
		delvideos(71);
		delvideos(65); 
	} catch (Exception $e) {
		echo($e->getMessage())."<br>\n";
	}


	/*	ici Tests des modification 
		d'une video
	*/		

	try {
		modifvideos(63, "3368hjk",1);
	} catch (Exception $e) {
		echo($e->getMessage())."<br>\n";
	}
		
	//supression d'un user créer

