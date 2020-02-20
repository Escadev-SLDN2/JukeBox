<?php
// Affichage des erreurs détaillées :
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Récupération des données 
require_once "videos.php";

$error_type = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty(trim($_POST['musicURL'])) {
            $error_type = "error-empty";
        }
    }
    if (empty($error_type)) {
        try {
            User::addvideos($mail, $pass);
            header("location: ../index.php?msg=success&conn=1");
            exit;
        } catch (Exception $e) {
            $error_type = $e->getMessage();
        }
    }

