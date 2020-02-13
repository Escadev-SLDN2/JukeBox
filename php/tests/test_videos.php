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
	try{ 
		addvideos("6hhxvjgvgjxh",6);
	} catch(Exception $e){
		echo($e->getMessage())."<br>\n";
	}
	
	// test doublons
	try{ 
		addvideos("6hhxvjgvgjxh",6);
	} catch(Exception $e){
		echo($e->getMessage())."<br>\n";
	}


	//afficher teste addvideos
	try{
		if(GetIdVideo('SDdZx')==-1){
			echo "la video n'est pas dans la dbb <br>\n";
		}else{
			echo "la video est déja dans la bdd <br>\n";
		}
	}catch(Exception $e){echo($e->getMessage())."<br>\n";}

	try{
		if(GetIdVideo('7zBqo')==-1){
			echo "la video n'est pas dans la dbb <br>\n";
		}else{
			echo "la video est déja dans la bdd <br>\n";
		}
	}catch(Exception $e){echo($e->getMessage())."<br>\n";}
	

	/*	ici Tests des suppression
	 d'une video

	*/
	try {
		if(delvideos(4) == -1){
			echo"la videoà été supprimer <br>\n";
		} elseif(delvideos(8) == 0){
			echo"la video que vous essayer de supprimer n'existe pas<br>\n";
		} 
	} catch (Exception $e) {
		echo($e->getMessage())."<br>\n";
	}

	/*
		ici Tests des modification 
		d'une video
		*/		
	
	try { 
		if(modifvideos(4, "3368hjk",3)!= -1){
			
			echo"'id_yt de la video ne peux pa etre modiffier <br>\n";
		} else{
			echo"l'id_yt de la video a été modiffier <br>\n";
		}
		
	} catch (Exception $e) {
		echo($e->getMessage())."<br>\n";
	}	

	try { 
		if(modifvideos(7, "333bravo",2)!= 0){
			
			echo"'id_yt de la video ne peux pa etre modiffier <br>\n";
		} else{
			echo"l'id_yt de la video a été modiffier <br>\n";
		}
		
	} catch (Exception $e) {
		echo($e->getMessage())."<br>\n";
	}
	
	//supression d'un user créer



