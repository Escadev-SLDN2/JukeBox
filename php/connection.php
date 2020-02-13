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
                        <a href="../"><img src="../assets/img/logo_escabox.png" width="50%" class="position-absolute mt-3 img-fluid" alt="ESCABOX"></a>
                    </div>
                    <!-- Titre -->
                    <div class="col-md-6 my-4 ml-5 ml-md-0 text-light d-flex align-items-center">
                        <a href="../"><img src="../assets/img/titre-escabox.png" alt="ESCABOX"></a>
                    </div>
                </div>
            </div>
        </header>



        <!-- Contenu page_super_admin -->
        <main>
            <!-- Conteneur Visionneuse, Vote et Ajout de musique-->
            <section>
                <div class="container mb-3">
                    <div class="row mx-sm-5">
                        <div class="col bg-secondary px-5 pt-5 pb-4  mx-sm-5">
                            <form method="POST" action="#">
                                <div class="form-group row connectLabel py-md-2 text-center <?php if(empty($error_message)){echo "d-none";}?>">
                                    <div class="col">
                                        <?php echo $error_message;?>
                                    </div>
                                </div>
                                <div class="form-group"> 
                                    <div class="row justify-content-between">
                                        <label class="col connectLabel p-1 px-md-3 mt-md-1 mr-md-3" for="nom">Mail </label>
                                        <input class="col-md-9 connectInput form-control" type="text" name="email" id="nom" placeholder="dupont.87400@mail.com" value="<?php if(isset($mail)){echo $mail;}?>" required/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row justify-content-between">
                                        <label class="col connectLabel p-1 px-md-3 mt-md-1 mr-md-3" for="mdp">Mdp </label>
                                        <input class="col-md-9 connectInput form-control" type="password" name="password" id="mdp" placeholder="motdepasse87" required/> 
                                    </div>
                                </div>
                                <div class="form-group d-flex justify-content-around mt-md-2 mb-mb-0">
                                    <a type="button" href="../index.html" class="btn btn-secondary rounded-pill" >Retour</a>
                                    <button type="submit" class="btn btn-danger rounded-pill">Valider</button>
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