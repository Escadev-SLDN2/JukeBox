<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once "users.php";
$error = "";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty(trim($_POST['name']))) {
        $error .= "veuillez entrer votre nom. <br>\n";
    } else {
        $name = trim($_POST['name']);
    }
    if(empty(trim($_POST['nickname']))) {
        $error .= "veuillez entrer votre pseudo. <br>\n";
    } else {
        $nick = trim($_POST['nickname']);
    }
    if(empty(trim($_POST['email']))) {
        $error .= "Veuillez entrer votre email. <br>\n";
    } else {
        $mail = trim($_POST['email']);
    }
    if(empty(trim($_POST['password']))) {
        $error .= "Veuillez entrer votre mot de passe. <br>\n";
    } else {
        $pass = trim($_POST['password']);
    }
    if(empty($error)) {
        try {
            $user = User::add($name, $nick, $mail, $pass);
        }
        catch(Exception $e) {
            $error = $e->getMessage(). "<br>\n";
        }
        if(isset($user)) {
            User::connect($user->mail, $pass);
            if(User::isConnected()) {
                header("location: ../index.html");
                exit;
            } else {
                $error = "Erreur de connexion <br>\n";
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

    <head>

        <!-- Ici se trouvent les mtadonnes pour le navigateur -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- Ici se trouvent les mtadonnes pour le moteur de recherche (et le navigateur) -->
        <title>Escabox</title>
        <meta name="description" content="Ce petit paragraphe sera affich dans les SERP, juste sous le titre des pages.">

        <!-- Ici se trouvent les liens vers les fichiers favicons -->
        <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
        <link rel="manifest" href="site.webmanifest">
        <link rel="mask-icon" href="safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">

        <!-- Ici se trouvent les liens vers les feuilles de styles -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="../assets/css/style.css">

    </head>


    <body>

        <!-- Header -->
        <header>
            <div class="container-fluid bg-dark mb-5">
                <div class="row">
                    <!-- Logo -->
                    <div class="col-2 text-light d-block align-items-start justify-content-center">
                        <img src="assets/img/logo_escabox.png" width="50%" class="position-absolute mt-3" alt="ESCABOX">
                    </div>
                    <!-- Titre -->
                    <div class="col-sm-6 text-light d-flex align-items-center">
                        <img src="assets/img/titre-escabox.png" alt="ESCABOX">
                    </div>
                </div>
            </div>
        </header>



        <!-- Contenu page_super_admin -->
        <main>
            <!-- Conteneur Visionneuse, Vote et Ajout de musique-->
            <section>
                <div class="container mb-3">
                    <div class="row mx-5">
                        <div class="col bg-secondary p-5 mx-5">
                            <form class="form" action="#" method="POST" role="form" autocomplete="off">
                                <div class="container ">
                                    <div class="form-group row justify-content-between">
                                        <label for="inputName" class="col connectLabel pl-3 pr-3 mt-1 mr-3" >Nom :*</label>
                                        <input type="text" class="form-control col-sm-9" id="inputName" placeholder="Nom Prenom" value="<?php echo(isset($name)? $name : "")?>" name="name" required>
                                    </div>
                                    <div class="form-group row justify-content-between">
                                        <label for="inputPseudo" class="col connectLabel pl-2 pr-2 mt-1 mr-3">Pseudo :*</label>
                                        <input type="text" class="form-control col-sm-9" id="inputPseudo" placeholder="Pseudo" value="<?php echo(isset($nick)? $nick : "")?>" name="nickname" required>
                                    </div>
                                    <div class="form-group row justify-content-between">
                                        <label for="inputEmail" class="col connectLabel pl-3 pr-3 mt-1 mr-3">Email :*</label>
                                        <input type="email" class="form-control col-sm-9" id="inputEmail" placeholder="mail@gmail.com" value="<?php echo(isset($mail)? $mail : "")?>" name="email" required>
                                    </div>
                                    <div class="form-group row justify-content-between">
                                        <label for="inputPassword" class="col connectLabel pl-2 pr-2 mt-1 mr-3">Mdp :*</label>
                                        <input type="password" class="form-control col-sm-9" id="inputPassword" placeholder="Mot de passe" name="password" required>
                                    </div>
                                    <div class="form-group row justify-content-between connectLabel text-center">
                                        <?phpecho $error;?>
                                    </div>
                                    <!--Bouton s'inscrire-->
                                    <div class="form-group d-flex justify-content-around mt-2 mb-0">
                                        <a type="button" href="../index.html" class="btn btn-secondary rounded-pill" >Retour</a>
                                        <button type="submit" class="btn btn-danger rounded-pill">S'inscrire</button>
                                    </div>
                                    
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer>
            <div class="container-fluid bg-dark">
                <div class="row">
                    <div class="col">
                        Footer
                    </div>
                </div>
            </div>
        </footer>

        <!-- Ici se trouvent les liens vers les fichiers javascript -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
