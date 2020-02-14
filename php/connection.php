<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once "users.php";



$error_type = "";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(User::isConnected()) {
    header("location: ../");
    exit;
    }
    if(empty(trim($_POST['email'])) || empty(trim($_POST['password']))) {
        $error_type = "error-empty";
    } else {
        $mail = trim($_POST['email']);
        $pass = trim($_POST['password']);
    }

    if(empty($error_type)) {
        try {
            User::connect($mail, $pass);
            header("location: ../index.php?msg=success&conn=1");
            exit;
        }
        catch(Exception $e) {
            $error_type = $e->getMessage();
        }
    }
    header("location: ../index.php?msg=$error_type");
}
if($_SERVER["REQUEST_METHOD"] == "GET") {
    if(User::isConnected() && $_GET['deconnect']==true){
        $_SESSION['user']->disconnect();
        header("location: ../index.php?msg=success&conn=-1");
    }
}
