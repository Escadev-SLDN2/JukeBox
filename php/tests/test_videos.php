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
$pdo->query("DELETE FROM videos WHERE id_yt='video1' OR id_yt='video2' OR id_yt='video3' OR id_yt='video4' ");
$pdo->query("DELETE FROM users WHERE nickname='w' OR nickname='b' OR nickname='n' OR nickname='R'");



//ajout users
$user1 = User::add("Bon", "w", "w@gmail.com", "wo");
$user2 = User::add("Mar", "b", "b@gmail.com", "ba");
$user3 = User::add("Min", "n", "n@gmail.com", "bo");
$user4 = User::add("Bar", "R", "R@gmail.com.fr", "bi");

//supp videos




/*  ici Tests des ajouts
    	d'une video
	*/
//test $user1
try {
	addvideos("video1", $user1->id);
} catch (Exception $e) {
	echo ($e->getMessage()) . "<br>\n";
}

//test $user2
try {
	addvideos("video2", $user2->id);
} catch (Exception $e) {
	echo ($e->getMessage()) . "<br>\n";
}

//test $user3
try {
	addvideos("video3", $user3->id);
} catch (Exception $e) {
	echo ($e->getMessage()) . "<br>\n";
}
//test $user4
try {
	addvideos("video4", $user4->id);
} catch (Exception $e) {
	echo ($e->getMessage()) . "<br>\n";
}
// test doublons"la video existe déja"

//afficher teste addvideos
try {
	if (GetIdVideo('video1') == -1) {
		echo "la video n'est pas dans la dbb <br>\n";
	} else {
		echo "la video est déja dans la bdd <br>\n";
	}
} catch (Exception $e) {
	echo ($e->getMessage()) . "<br>\n";
}

try {
	if (GetIdVideo('video5') == -1) {
		echo "la video n'est pas dans la dbb <br>\n";
	} else {
		echo "la video est déja dans la bdd <br>\n";
	}
} catch (Exception $e) {
	echo ($e->getMessage()) . "<br>\n";
}


/*	ici Tests des suppression
	 d'une video

	
	try {
		if(delvideos(1) !=1)
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
	if (modifvideos(0, "video1", 1) != -1) {

		echo "l'id_yt de la video ne peux pa etre modiffier <br>\n";
	} else {
		echo "l'id_yt de la video a été modiffier <br>\n";
	}
} catch (Exception $e) {
	echo ($e->getMessage()) . "<br>\n";
}

try {
	if (modifvideos(0, "video3", 2) != 0) {

		echo "l'id_yt de la video ne peux pa etre modiffier <br>\n";
	} else {
		echo "l'id_yt de la video a été modiffier <br>\n";
	}
} catch (Exception $e) {
	echo ($e->getMessage()) . "<br>\n";
}

//suppresion des videos
$pdo->query("DELETE FROM videos WHERE id_yt='video1' OR id_yt='video2' OR id_yt='video3' OR id_yt='video4' ");
//supression d'un user créer
$user1->delete();
$user2->delete();
$user3->delete();
$user4->delete();


// détruit une variable dont le nom à été passer en param
unset($pdo);
