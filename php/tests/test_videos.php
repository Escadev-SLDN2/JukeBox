<?php
   // Affichage des erreurs détaillées :
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   error_reporting(E_ALL);
   use PHPUnit\Framework\TestCase;

	//recuperation des données
	require_once "../videos.php";

	//connection à la basse de donner
	$pdo = DBConnect();
	$pdo ->query("DELETE FROM videos WHERE id_yt='7zBqopjayHY' or id_yt='6hhxvjvjxh'");

	/*  ici Tests des ajouts
    d'une video
	*/
	try{ 
		addvideos("7zBqopjayHY",6);
	} catch(Exception $e){
		echo($e->getMessage())."<br>\n";
	}
	try{ 
		addvideos("6hhxvjvjxh",9);
	} catch(Exception $e){
		echo($e->getMessage())."<br>\n";
	}

	//afficher teste addvideos
	//try{echo(GetIdVideo()); echo"<br>\n";} catch(Exception $e){echo($e->getMessage())."<br>\n";}
	

	/*	ici Tests des suppression
	 d'une video

	*/
	try {
		delvideos(63);
	} catch (Exception $e) {
		echo($e->getMessage())."<br>\n";
	}

	/*
		ici Tests des modification 
		d'une video
		*/		
	
	try {
		modifvideos(63, "3368hjk",1);
	} catch (Exception $e) {
		echo($e->getMessage())."<br>\n";
	}	
	
	//supression d'un user créer



