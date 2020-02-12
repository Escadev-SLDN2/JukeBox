<?php
   // Affichage des erreurs détaillées :
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   error_reporting(E_ALL);

	//recuperation des données
	require_once "../videos.php";

	//connection à la basse de donner
	$pdo = DBConnect();
	$pdo ->query("DELETE FROM videos WHERE id_yt='7zBqopjayHY' or id_yt='6hhxvjvjxh'");

	/*  ici Tests des ajouts
    d'une video

	try{ 
		addvideos("7zBqopjayHY",6);
	} catch(Exception $e){
		echo($e->getMessage())."<br>\n";
	}

	try{ 
		addvideos("6hhxvjvjxh",2);
	} catch(Exception $e){
		echo($e->getMessage())."<br>\n";
	}
		*/

	//afficher teste addvideos
	try{
		if(GetIdVideo('7zBqopjayHY')==-1){
			echo "la video n'est pas dans la dbb <br>\n";
		}else{
			echo "la video est dans la bdd <br>\n";
		}
	}catch(Exception $e){echo($e->getMessage())."<br>\n";}

	try{
		if(GetIdVideo('7zBqopjayvh')==-1){
			echo "la video n'est pas dans la dbb <br>\n";
		}else{
			echo "la video est dans la bdd <br>\n";
		}
	}catch(Exception $e){echo($e->getMessage())."<br>\n";}
	

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



