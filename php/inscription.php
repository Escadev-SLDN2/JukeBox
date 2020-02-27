<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once "users.php";
$error_type = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST['name'])) || empty(trim($_POST['nickname'])) || empty(trim($_POST['email'])) || empty(trim($_POST['password'])) || empty(trim($_POST['confirmPassword']))) {
        $error_type = "error-empty";
    } else if ($_POST['confirmPassword'] != $_POST['password']) {
        $error_type = "error-pass";
    } else {
        $pass = trim($_POST['password']);
        $nick = trim($_POST['nickname']);
        $mail = trim($_POST['email']);
        $name = trim($_POST['name']);
    }

    if (empty($error_type)) {
        try {
            $user = User::add($name, $nick, $mail, $pass);
        } catch (Exception $e) {
            $error_type = $e->getMessage();
        }
        if (isset($user)) {
            try {
                User::connect($user->mail, $pass);
                if (User::isConnected()) {
                    header("location: ../index.php?msg=success");
                    exit;
                }
            } catch (Exception $e) {
            }
        }
    }
}
header("location: ../index.php?msg=$error_type");
exit;
