<?php
// Affichage des erreurs détaillées :
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Récupération des données 
require_once "videos.php";
require_once "users.php";
if (User::isConnected()) {
    $user = $_SESSION['user'];
    $error_type = "error-url";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty(trim($_POST['musicUrl']))) {
            header("location: ../index.php?msg=$error_type");
        }
        try {
            preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', trim($_POST['musicUrl']), $match);
        } catch (Exception $e) {
            header("location: ../index.php?msg=$error_type");
        }
        if (empty($match)) {
            header("location: ../index.php?msg=$error_type");
        } else if ($youtube_id = $match[1])
            try {
                addvideos($youtube_id, $user->id);
                header("location: ../index.php?msg=success&vid=1");
            } catch (Exception $e) {
                header("location: ../index.php?msg=error-dupes");
            }
    }
    exit;
}
