<?php
   // Affichage des erreurs détaillées :
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   error_reporting(E_ALL);

	//recuperation des données
	require_once "../videos.php";
	require_once "../users.php";

	//connection à la basse de donner
	$pdo = DBConnect();
	$pdo ->query("DELETE FROM videos WHERE id_yt='7zBqopjayHY' or id_yt='6hhxvjvjxh'");

	
	//ajout users
	$user1 = User::add("Bonjour","world","bonjour@gmail.com","world");
	$user2 = User::add("Margot","bichette","bichette@@gmail.com","baramina");
	$user3 = User::add("Mina","nass","nass@@gmail.com","bon");
	$user4 = User::add("Baraka","barky","barky@@gmail.com.fr","bb555");

	//supp videos
	$video1 = Video::delvideos(1);
	$video2 = Video::delvideos(2);
	$video3 = Video::delvideos(3);
	$video4 = Video::delvideos(4);

	

	/*  ici Tests des ajouts
    	d'une video
	*/
	//test $user1
	try{ 
		addvideos("video1",$user1->id);
	} catch(Exception $e){
		echo($e->getMessage())."<br>\n";
	}

	//test $user2
	try{ 
		addvideos("video2",$user2->id);
	} catch(Exception $e){
		echo($e->getMessage())."<br>\n";
	}
	
	//test $user3
	try{ 
		addvideos("video3",$user3->id);
	} catch(Exception $e){
		echo($e->getMessage())."<br>\n";
	}
	//test $user4
	try{ 
		addvideos("video4",$user4->id);
	} catch(Exception $e){
		echo($e->getMessage())."<br>\n";
	}
	// test doublons"la video existe déja"
	
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
		if(delvideos($video1->id) !=1)
		{
			echo"la video que vous essayer de supprimer n'existe pas<br>\n";
		} else{
			echo"la video à été supprimer <br>\n";
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
			
			echo"l'id_yt de la video ne peux pa etre modiffier <br>\n";
		} else{
			echo"l'id_yt de la video a été modiffier <br>\n";
		}
		
	} catch (Exception $e) {
		echo($e->getMessage())."<br>\n";
	}	

	try { 
		if(modifvideos(233, "333brhhvo",2)!= 0){
			
			echo"l'id_yt de la video ne peux pa etre modiffier <br>\n";
		} else{
			echo"l'id_yt de la video a été modiffier <br>\n";
		}
		
	} catch (Exception $e) {
		echo($e->getMessage())."<br>\n";
	}
	
	//supression d'un user créer
/*	$user1->delete();
	$user2->delete();
	$user3->delete();
	$user4->delete();
*/
	// détruit une variable dont le nom à été passer en param
	unset($pdo);
