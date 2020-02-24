<?php
// Affichage des erreurs détaillées :
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Récupération des données 
require_once "videos.php";
require_once "users.php";
if(User::isConnected()){
    $user = $_SESSION['user'];
    $error_type = "error-dupe";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty(trim($_POST['musicUrl']))){
            header("location: ../index.php?msg=$error_type");
        }
        try {
            preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', trim($_POST['musicUrl']), $match);
            $youtube_id = $match[1];
            } catch (Exception $e) {
            echo ($e->getMessage()) . "<br>\n";
        }

        if ($youtube_id = $match[1])
        try{
            addvideos($youtube_id, $user->id);
            header("location: ../index.php?msg=success&vid=1");
            exit;
            
        }catch (Exception $e) {
            echo (header("location: ../index.php?msg=error-dupe"));
            exit;
        }
        else if ($youtube_id = $match[0]){
            echo ($e->getMessage()) . "<br>\n";
        }
        header("location: ../index.php?msg=error-url");
    }    
    exit;
}