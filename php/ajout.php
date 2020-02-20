<?php
// Affichage des erreurs détaillées :
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Récupération des données 
require_once "videos.php";
require_once "users.php";
session_start();
$user = $_SESSION['user'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        try {
            addvideos(trim($_POST['musicUrl']), $user->id);
        } catch (Exception $e) {
            echo ($e->getMessage()) . "<br>\n";
        }
    }
    exit;

