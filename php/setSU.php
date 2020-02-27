<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once "users.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentId = $_POST['userid'];
    $suId = User::getSUId();

    // Changement du rôle de l'utilisateur sélectionné
    User::setrole('ROLE_ADMIN', $currentId);

    // Changement du rôle du super utilisateur
    User::setrole('ROLE_USER', $suId);

    header("location: ../index.php");
}