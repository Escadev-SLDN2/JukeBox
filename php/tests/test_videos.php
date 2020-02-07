<?php
   // Affichage des erreurs détaillées :
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   error_reporting(E_ALL);

	//recuperation des données
	require_once "../videos.php";

	//connection à la basse de donner
	$pdo =& Bdd::connect();
	$pdo ->query("DELETE FROM videos WHERE id_yt='SDdZx' or id_yt='mbEciS'");

	//	Tests des ajouts
	try{$video1 = addvideos("SDdZx",5);} catch(Exception $e){echo($e->getMessage())."<br>\n";}
		//Cree un user dans la bdd et stocke le user dans une variable.
		//Si un user avec ce mail existe deja dans la bdd ou en cas d'autre d'erreur, affiche l'erreur.

	try{$video2 = addvideos("mbEciS",3); echo "<br>\n";} catch(Exception $e){echo($e->getMessage())."<br>\n";} 
		//Affiche l'array correspondant au user possedant l'id s'il y en a un, sinon affiche le message d'erreur.

	if(isset($video1)){try{print_r(getFormId($video1->id)); echo"<br>\n";} catch(Exception $e){echo($e->getMessage())."<br>\n";}}else{echo"video is not set <br>\n";}
	if(isset($video2)){try{print_r(getFormId($video2->id)); echo"<br>\n";} catch(Exception $e){echo($e->getMessage())."<br>\n";}}else{echo"video is not set <br>\n";}
	


/*  ici Tests des ajouts
    d'une video
*/
/*try{ $video1= Video::addvideos("SDdZx",5); } catch(Exception $e){echo($e->getMessage())."<br>\n";}
try{ $video2= Video::addvideos("mbEci",2); } catch(Exception $e){echo($e->getMessage())."<br>\n";}


if(isset($video1)){try{print_r (Video::getFromId($video1->id)); echo "<br>\n";} catch(Exception $e){echo($e->getMessage())."<br>\n";}}else{echo"video is not set <br>\n";}
if(isset($video2)){try{print_r (Video::getFromId($video2->id)); echo "<br>\n";} catch(Exception $e){echo($e->getMessage())."<br>\n";}}else{echo"video is not set <br>\n";}
*/
/*	ici Tests des suppression
	 d'une video

*/


/*	ici Tests des modification 
	d'une video

*/

