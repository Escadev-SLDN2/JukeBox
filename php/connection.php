<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once "users.php";

if(User::isConnected()) {
    header("location: ../");
    exit;
}

$error_message = "";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty(trim($_POST['email']))) {
        $error_message .= "Veuillez entrer votre email. <br>\n";
    } else {
        $mail = trim($_POST['email']);
    }
    if(empty(trim($_POST['password']))) {
        $error_message .= "Veuillez entrer votre mot de passe. <br>\n";
    } else {
        $pass = trim($_POST['password']);
    }
    if(empty($error)) {
        try {
            User::connect($mail, $pass);
            if(User::isConnected()) {
                header("location: ../index.html");
                exit;
            } else {
                $error_message = "Erreur de connexion <br>\n";
            }
        }
        catch(Exception $e) {
            $error_message .= $e->getMessage(). "<br>\n";
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
                <div class="row ">
                    <!-- Logo -->
                    <div class="col-2 text-light d-block align-items-start justify-content-center">
                        <img src="../assets/img/logo_escabox.png" width="50%" class="position-absolute mt-3" alt="ESCABOX">
                    </div>
                    <!-- Titre -->
                    <div class="col-md-6 text-light d-flex align-items-center">
                        <img src="../assets/img/titre-escabox.png" alt="ESCABOX">
                    </div>
                </div>
            </div>
        </header>



        <!-- Contenu page_super_admin -->
        <main>
            <!-- Conteneur Visionneuse, Vote et Ajout de musique-->
            <section>
                <div class="container mb-3">
                    <div class="row mx-md-5">
                        <div class="col bg-secondary p-5 mx-md-5">
                            <form method="POST" action="#">
                                <div class="form-group"> 
                                    <div class="row">
                                        <div class="col-3">
                                            <label class="connectLabel  px-md-3 mt-md-1 mr-md-3" for="nom">Mail </label>
                                        </div>
                                        <div class="col-9">
                                            <input class="connectInput form-control" type="text" name="email" id="nom" placeholder="dupont.87400@mail.com" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-3">
                                            <label class="connectLabel px-md-3 mt-md-1 mr-md-3" for="mdp">Mdp </label>
                                        </div>
                                        <div class="col-9">                            
                                            <input class="connectInput form-control" type="password" name="password" id="mdp" placeholder="motdepasse87" required/> 
                                        </div>           
                                    </div>                                  
                                </div>
                                <div class="row"> 
                                    <input class="col form-group buttonv" type="submit" value="Valider"> 
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
