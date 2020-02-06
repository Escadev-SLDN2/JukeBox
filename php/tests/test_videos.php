<?php
   // Affichage des erreurs détaillées :
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   error_reporting(E_ALL);

	//recuperation des données
	require_once "../videos.php";

	//connection à la basse de donner
	$pdo = $ Bdd::connect();
	$pdo ->query("DELETE FROM videos WHERE ")
	

/*  ici Tests des ajouts
    d'une video
*/
try{
	//affichage de la liste des videos

	foreach($bdd->query('SELECT * from videos', PDO::FETCH_ASSOC) as $row){
		print_r($row);
	}
	
	echo 'ajouts video';

	//fermeture de la connexion
	$bdd=null;
}

catch


/*	ici Tests des suppression
	 d'une video

*/


/*	ici Tests des modification 
	d'une video

*/

?>