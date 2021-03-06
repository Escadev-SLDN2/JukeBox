<?php
require_once "php/users.php";
require_once "php/videos.php";
$isConn = false;
$alertType = "d-none";
$users = User::findAll();
$videos = findAllVideoYtId();
shuffle($videos);
$msg = $_GET['msg'];
$conn = $_GET['conn'];
$vid = $_GET ['vid'];
$i = 0;
if (User::isConnected()) {
    $isConn = true;
    $user = $_SESSION['user'];
}

if (!empty($msg)) {
    if ($msg == "success") {
        $alertType = "alert-success";
        if ($conn == "1") {
            $alertMsg = "Vous êtes bien connecté.&nbsp Bonjour, &nbsp".$user->nick;
        } else if ($conn == "-1") {
            $alertMsg = "Vous êtes bien déconnecté";
        } else if ($vid == "1") {
            $alertMsg = "La vidéo a bien été ajoutée";
        } else {
            $alertMsg = "Vous êtes bien inscrit";
        }
    } else {
        $alertType = "alert-danger";
        if ($msg == "error-empty") {
            $alertMsg = "Veuillez remplir tous les champs obligatoires";
        }
        if ($msg == "error-email") {
            $alertMsg = "L'adresse email est déjà utilisée";
        }
        if ($msg == "error-pass") {
            $alertMsg = "Les mots de passe ne correspondent pas";
        }
        if ($msg == "error-connect") {
            $alertMsg = "Email ou mot de passe invalide";
        }
        if ($msg == "error-dupes") {
            $alertMsg = "La vidéo existe déjà dans la BDD";
        }
        if ($msg == "error-url"){
            $alertMsg = "L'URL n'est pas correct, il faut un URL youtube";
        }
    }
}



?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <!-- Ici se trouvent les métadonnées pour le navigateur -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Ici se trouvent les métadonnées pour le moteur de recherche (et le navigateur) -->
    <title>Escabox</title>
    <meta name="description" content="Ce petit paragraphe sera affiché dans les SERP, juste sous le titre des pages.">

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/css/glide.core.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/css/glide.theme.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

</head>


<body>

    <!-- Header -->
    <header>
        <div class="container-fluid bg-dark py-1 mb-3">
            <div class="row">
                <!-- Logo -->
                <div class="col-2 text-light d-block align-items-start justify-content-center">
                    <a href="index.php"><img src="assets/img/logo_escabox.png" class="logo position-absolute mt-3 img-fluid" alt="ESCABOX"></a>
                </div>
                <!-- Titre -->
               
                <div class="col-sm-3 ml-3 ml-md-0 text-light d-flex align-items-center">
                    <h1 id="titre" class="my-3">ESCABOX</h1>
                </div>
                
                <!-- Inscription et Connexion
          Ici devrait se trouver le bouton Déconnexion pour les utilisateurs connectés et l'Administrateur -->
                <div class="col py-2 text-right">

                    <div class="row mb-1">
                        <?php if (!$isConn) { ?>
                            <div class="col-sm-4 offset-sm-3 col-10">
                                <button type="button" class="btn btn-danger ml-5 pl-3 my-3 boubou " data-toggle="modal" data-target="#inscriptionModal">
                                    Inscription
                                </button>
                                <!--POPUP-->
                                <div id="inscriptionModal" class="modal" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <!--Header du POPUP-->
                                            <div class="modal-header bg-dark py-2 px-2">
                                                <h5 class="modal-title text-light">Inscription</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <!--body du POPUP-->
                                            <div class="modal-body bg-secondary">
                                                <form class="form" action="php/inscription.php" method="POST" role="form">
                                                    <div class="container">

                                                        <div class="form-group row justify-content-between">
                                                            <label for="inputName" class="col-12 connectLabel pl-3 pr-3 mt-1">Nom :*</label>
                                                            <input type="text" class="form-control col-sm-12" id="inputName" placeholder="nom complet" name="name" required>
                                                        </div>

                                                        <div class="form-group row justify-content-between">
                                                            <label for="inputPseudo" class="col-12 connectLabel pl-2 pr-2 mt-1">Pseudo :*</label>
                                                            <input type="text" class="form-control col-sm-12" id="inputPseudo" placeholder="pseudo" name="nickname" required>
                                                        </div>

                                                        <div class="form-group row justify-content-between">
                                                            <label for="inputEmail" class="col connectLabel pl-3 pr-3 mt-1">Email :*</label>
                                                            <input type="email" class="form-control col-sm-12" id="inputEmail" placeholder="email@gmail.com" name="email" required>
                                                        </div>

                                                        <div class="form-group row justify-content-between">
                                                            <label for="inputPassword" class="col connectLabel pl-2 pr-2 mt-1">Mot de passe
                                                                :*</label>
                                                            <input type="password" class="form-control col-sm-12" id="inputPassword" placeholder="petitekokinedu87" name="password" required>
                                                        </div>

                                                        <div class="form-group row justify-content-between">
                                                            <label for="inputPassword" class="col connectLabel pl-2 pr-2 mt-1">Confirmation mot de passe
                                                                :*</label>
                                                            <input type="password" class="form-control col-sm-12" id="confirmPassword" placeholder="petitekokinedu87" name="confirmPassword" required>
                                                        </div>

                                                        <!--Bouton s'inscrire-->
                                                        <div class="form-group d-flex justify-content-around mt-2 mb-0">
                                                            <button type="button" class="btn btn-secondary rounded-pill px-4 py-1" data-dismiss="modal" aria-label="Close">
                                                                <i class="fas fa-long-arrow-alt-left"></i> Annuler
                                                            </button>
                                                            <button type="submit" class="btn btn-danger rounded-pill px-4 py-1">
                                                                <i class="fas fa-check"></i> S'inscrire
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--pop up 2-->

                            <div class="col-sm-4 col-10">

                                <button type="button" class="btn btn-danger ml-5 pl-3 my-3 boubou <?php if ($isConn) {
                                                                                                    echo "d-none";
                                                                                                } ?> " data-toggle="modal" data-target="#connexionModal">
                                    Connexion
                                </button>
                                <div id="connexionModal" class="modal" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <!--Header du POPUP-->
                                            <div class="modal-header bg-dark py-2 px-2">
                                                <h5 class="modal-title text-light">Connexion</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <!--body du POPUP-->
                                            <div class="modal-body bg-secondary">
                                                <form class="form" action="php/connection.php" method="POST" role="form">
                                                    <div class="container">


                                                        <div class="form-group row justify-content-between">
                                                            <label for="signin" class="col-12 connectLabel pl-3 pr-3 mt-1">Email :*</label>
                                                            <input type="email" class="form-control col-sm-12" id="signin" placeholder="email@gmail.com" name="email" required>
                                                        </div>

                                                        <div class="form-group row justify-content-between">
                                                            <label for="password" class="col-12 connectLabel pl-2 pr-2 mt-1">Mot de passe
                                                                :*</label>
                                                            <input type="password" class="form-control col-sm-12" id="password" placeholder="petitekokinedu87" name="password" required>
                                                        </div>


                                                        <!--Bouton s'inscrire-->
                                                        <div class="form-group d-flex justify-content-around mt-2 mb-0">
                                                            <button type="button" class="btn btn-secondary rounded-pill px-4 py-1" data-dismiss="modal" aria-label="Close">
                                                                <i class="fas fa-long-arrow-alt-left"></i> Annuler
                                                            </button>
                                                            <button type="submit" class="btn btn-danger rounded-pill px-4 py-1">
                                                                <i class="fas fa-check"></i> Connexion
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        <?php } ?>
                        <?php if ($isConn) { ?>
                            <div class="col-sm-5 col-8 mt-2 text-pop">
                                
                                <?php 
                                echo "Bonjour,&nbsp" . ($user->nick) ;
                            
                                ?>
                                
                            </div>
                           
                            <div class="col-sm-4 col-8 offset-2 ">
                                
                                    <a type="button" class="btn btn-danger ml-5 pl-3 my-3 boubou" href="php/connection.php?deconnect=true">
                                        Déconnexion
                                    </a>

                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </header>



    <!-- Contenu page_super_admin -->
    <main>

        <div class="alert <?php echo $alertType; ?> alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>
                <?php echo $alertMsg; ?></strong>
        </div>

        <!-- Conteneur Visionneuse, Passer, Vote et Ajout de musique-->
        <section>
            <div class="container mb-3">
                <div class="row">

                    <!-- Conteneur Visionneuse (Visiteur) -->
                    <div class="col-12 col-lg-7 mb-2">
                        <div class="container">
                            <div class="row">
                                <div class="col bg-dark text-light">
                                    Visionneuse
                                    <div id="video-placeholder">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if ($isConn) { ?>
                        <!-- Conteneur Passer, Vote et Ajout de musique (Connecté) -->
                        <div class="col ">

                            <!-- Conteneur Passer et Voter -->

                            <div class="container mb-2">
                                <div class="row">
                                    <?php if ($user->isSU()) { ?>


                                        <!-- Conteneur Passer -->
                                        <div class="col mr-2">

                                            <!--Header Passer -->
                                            <div class="row">
                                                <div class="col bg-dark text-light">
                                                    Passer vidéo
                                                </div>
                                            </div>

                                            <!-- Contenu Passer -->
                                            <div class="row">
                                                <div class="col bg-secondary py-4 d-flex align-items-center justify-content-around">
                                                    <button id="next"><i class="fas fa-step-forward"></i></button>
                                                </div>
                                            </div>

                                        </div>
                                    <?php } ?>

                                    <!-- Conteneur Vote -->
                                    <div class="col">

                                        <!--Header Vote -->
                                        <div class="row">
                                            <div class="col-12 bg-dark text-light">
                                                Vote
                                            </div>
                                        </div>

                                        <!-- Contenu Vote -->
                                        <div class="row">
                                            <div class="col bg-secondary py-4 d-flex align-items-center justify-content-around">
                                                <button><i class="fas fa-thumbs-down"></i></button>
                                                [-1]
                                                <button><i class="fas fa-thumbs-up"></i></button>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>


                            <!-- Ajout -->
                            <div class="container adding_music_container">
                                <form class="form" action="php/ajout.php" method="POST" role="form">

                                    <!--Header Ajout -->
                                    <div class="row">
                                        <div class="col bg-dark text-light">
                                            Ajouter une vidéo
                                        </div>
                                    </div>

                                    <!-- Contenu Ajout -->
                                    <div class="row">

                                        <div class="col bg-secondary py-3">

                                            <div class="form-group row d-flex align-items-center">

                                                <div class="col-sm-4">
                                                    <label class="connectInput py-2 mt-2 text-center w-100" for="musicUrl">URL</label>
                                                </div>

                                                <div class="col">
                                                    <input type="url" class="form-control" name="musicUrl" id="musicUrl" placeholder="https://" required>
                                                </div>

                                            </div>

                                            <div class="form-group row d-flex align-items-start">

                                                <div class="col-sm-4">
                                                    <label class="connectInput py-2 text-center w-100" for="keyWords">Mots-clés</label>
                                                </div>

                                                <div class="col">
                                                    <textarea type="email" class="form-control" name="keyWords" id="keyWords" placeholder="ex: rock" required></textarea>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <button name="add_music" type="submit" class="btn btn-danger w-100">
                                                        Ajouter
                                                    </button>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </form>
                            </div>

                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>


        <!-- Les trois options (Admin) -->
        <?php if ($isConn && $user->isSU()) { ?>

            <section>
                <div class="container mb-2 ">

                    <div class="row">

                        <div class="col-lg-4 order-2 order-lg-1">
                            <button type="button" class="btn btn-danger w-100" data-toggle="collapse" data-target="#collapseExample">Choix de la Playlist</button>
                        </div>

                        <div class="col mb-2 text-right order-1 order-lg-2">

                            <form class="form" action="php/setSU.php" method="POST">

                                <div class="input-group">

                                    <select name="userid" class="custom-select" id="inputGroupSelect04">
                                        <option>Choisir un utilisateur connecté</option>
                                        <?php if ($isConn) { ?>
                                            <?php foreach ($users as $listUser) { ?>

                                                <option value="<?php echo $listUser['id'] ?>"><?php echo $listUser['name'] ?></option>

                                            <?php } ?>
                                        <?php } ?>
                                    </select>

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-danger btn-give-admin" data-toggle="tooltip" data-placement="top" title="Donner le rôle Administrateur"><i class="fas fa-user-tie"></i></button>
                                    </div>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>
            </section>



            <!-- Choix de la playlist / CdlP (Admin) -->

            <!-- [Thomas] N'ayant pas réussi à faire fonctionné padding-x (px),
          j'ai doublé les conteneurs afin de respecter les paddings
          des premiers conteneurs (visionneuse/vote/ajout/les quatres fonctions).
          L'"astuce" est répété pour le carousel des vidéos en cours et Table_gestion_admin -->

            <section>
                <div class="collapse" id="collapseExample">
                    <div class="container mb-3">
                        <div class="row">
                            <div class="col">

                                <div class="container">

                                    <!-- Header CdlP -->
                                    <header>
                                        <div class="row">
                                            <div class="col bg-dark text-light">
                                                Choix de la playlist
                                            </div>
                                        </div>
                                    </header>

                                    <!-- Contenu CdlP -->
                                    <div class="row pt-1 pb-3 bg-light">
                                        <div class="col">
                                            <div class="btn-group-toggle" data-toggle="buttons">
                                                <label class="btn btn-toggle">
                                                    <input type="checkbox" checked autocomplete="off">
                                                    metal
                                                </label>
                                                <label class="btn btn-toggle">
                                                    <input type="checkbox" checked autocomplete="off">
                                                    calme
                                                </label>
                                                <label class="btn btn-toggle">
                                                    <input type="checkbox" checked autocomplete="off">
                                                    travail
                                                </label>
                                                <label class="btn btn-toggle">
                                                    <input type="checkbox" checked autocomplete="off">
                                                    lo-fi
                                                </label>
                                                <label class="btn btn-toggle">
                                                    <input type="checkbox" checked autocomplete="off">
                                                    mathieu
                                                </label>
                                                <label class="btn btn-toggle">
                                                    <input type="checkbox" checked autocomplete="off">
                                                    RnB
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Footer CdlP -->
                                    <footer>
                                        <div class="row py-1 bg-secondary border-top border-dark">

                                            <div class="col-sm-10 d-flex justify-content-end align-items-center">
                                                x vidéo(s) sélectionnée(s)
                                            </div>

                                            <div class="col text-center">
                                                <button type="button" class="btn btn-danger">
                                                    Valider
                                                </button>
                                            </div>

                                        </div>
                                    </footer>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php } ?>

        

        <!-- Carousel vidéo (Visiteur) -->

        <section>
                <div class="container mb-3 mt-3">
                    <div class="row">
                        <div class="col">
                        

                            <div class="container ">

                                <!-- Header Carousel -->
                                <header>
                                    <div class="row">
                                        <div class="col bg-dark text-light">
                                            Vidéo/Playlist en cours
                                        </div>
                                    </div>
                                </header>                     

                                <!-- Contenu Carousel -->

                                <div class="row ">
                                    <div class="col-md-12 bg-secondary">
                                         <div class="glide">
                                            <div class="glide__track" data-glide-el="track">
                                                <ul class="glide__slides">
<?php foreach($videos as $id_yt){ ?>
                                                    <li class="glide__slide">
                                                        <img src="http://img.youtube.com/vi/<?php echo $id_yt ?>/0.jpg" alt="Image" style="max-width:100%;" <?php if($isConn) echo "onClick='changeVideo(".$i.")'"; ?>>
                                                        <div class="row">
                                                            <div class="col offset-1 offset-md-0 text-center">
                                                                <?php echo getVideoTitle($id_yt)."\n";?>
                                                            </div>
                                                        </div>
                                                    </li>
<?php $i++; } ?>
                                                </ul>
                                            </div>
                                            <div class="glide__arrows" data-glide-el="controls">
                                                <button class="glide__arrow glide__arrow--left" style="border: none; outline: none;" data-glide-dir="<"><i style="font-size: 60px" class="fas fa-chevron-circle-left text-danger" aria-hidden="true"></i></button>
                                                <button class="glide__arrow glide__arrow--right" style="border: none" data-glide-dir=">"><i class="fas fa-4x fa-chevron-circle-right text-danger" aria-hidden="true"></i></button>
                                            </div>
                                        </div>                                                
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

                <!-- Gestion des vidéos et playlist (Admin) -->


        <?php if ($isConn && $user->isSU()) { ?>
        
            <section>

                <div class="container mb-3">
                    <div class="row">
                        
                            <div class="col">

                                <div class="container bg-secondary">

                                    <!-- Header Gestion_playlist -->
                                    <header>

                                        <div class="row">
                                            <div class="col bg-dark text-light">
                                                Liste des vidéos
                                            </div>
                                        </div>

                                    </header>


                                    <!-- Contenu Gestion_playlist -->

                                    <div class="row">

                                        <div class="table-responsive tableFixHead">
                                            <table class="table table-sm table-striped">
                                                <thead>
                                                    <tr scope="row">
                                                        <th scope="col px-2">Titre des vidéos</th>
                                                        <th scope="col">Lien</th>
                                                        <th scope="col">Mots-clés</th>
                                                        <th scope="col">Modifier</th>
                                                        <th scope="col">Supprimer</th>
                                                        <th scope="col"> <input type="checkbox" name="Check" id="Check" /> </th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Kimi no Na wa. "Sparkle" - Extended(Sound only)</td>
                                                        <td>mdEy1m6vtsM</td>
                                                        <td>Manga</td>
                                                        <td> <button class="btn btn-dark" title="Modifier"><i class="fas fa-edit"></i></button> </td>
                                                        <td> <button class="btn btn-dark" title="Supprimer"><i class="fas fa-trash-alt"></i></button> </td>
                                                        <td> <input type="checkbox" name="Check" id="Check" /> <br /> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kimi no Na wa. "Sparkle" - Extended(Sound only)</td>
                                                        <td>mdEy1m6vtsM</td>
                                                        <td>Manga</td>
                                                        <td> <button class="btn btn-danger" title="Modifier"><i class="fas fa-edit"></i></button> </td>
                                                        <td> <button class="btn btn-danger" title="Supprimer"><i class="fas fa-trash-alt"></i></button> </td>
                                                        <td> <input type="checkbox" name="Check" id="Check" /> <br /> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kimi no Na wa. "Sparkle" - Extended(Sound only)</td>
                                                        <td>mdEy1m6vtsM</td>
                                                        <td>Manga</td>
                                                        <td> <button class="btn btn-dark" title="Modifier"><i class="fas fa-edit"></i></button> </td>
                                                        <td> <button class="btn btn-dark" title="Supprimer"><i class="fas fa-trash-alt"></i></button> </td>
                                                        <td> <input type="checkbox" name="Check" id="Check" /> <br /> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kimi no Na wa. "Sparkle" - Extended(Sound only)</td>
                                                        <td>mdEy1m6vtsM</td>
                                                        <td>Manga</td>
                                                        <td> <button class="btn btn-danger " title="Modifier"><i class="fas fa-edit"></i></button> </td>
                                                        <td> <button class="btn btn-danger" title="Supprimer"><i class="fas fa-trash-alt"></i></button> </td>
                                                        <td> <input type="checkbox" name="Check" id="Check" /> <br /> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kimi no Na wa. "Sparkle" - Extended(Sound only)</td>
                                                        <td>mdEy1m6vtsM</td>
                                                        <td>Manga</td>
                                                        <td> <button class="btn btn-dark" title="Modifier"><i class="fas fa-edit"></i></button> </td>
                                                        <td> <button class="btn btn-dark" title="Supprimer"><i class="fas fa-trash-alt"></i></button> </td>
                                                        <td> <input type="checkbox" name="Check" id="Check" /> <br /> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kimi no Na wa. "Sparkle" - Extended(Sound only)</td>
                                                        <td>mdEy1m6vtsM</td>
                                                        <td>Manga</td>
                                                        <td> <button class="btn btn-danger " title="Modifier"><i class="fas fa-edit"></i></button> </td>
                                                        <td> <button class="btn btn-danger" title="Supprimer"><i class="fas fa-trash-alt"></i></button> </td>
                                                        <td> <input type="checkbox" name="Check" id="Check" /> <br /> </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                    <!-- Footer Gestion_playlist -->
                                    <footer>
                                        <div class="row border-top border-dark">

                                            <div class="col-6 col-sm-3 my-auto">
                                                <input class="text" type="text" name="mots-clés" />
                                            </div>

                                            <div class="col-6 col-sm-3  my-2">
                                                <button class="btn btn-danger">Enregistrer le Mot-clé</button>
                                            </div>

                                            <div class="col-6 col-sm-3 my-2">
                                                <button class="btn btn-danger">Supprimer le Mot-clé</button>
                                            </div>

                                            <div class="col-6 col-sm-3 my-2">
                                                <button class="btn btn-danger">Supprimer videos</button>
                                            </div>

                                        </div>

                                    </footer>

                                </div>
                            
                            </div>
                        
                    </div>
                </div>

            </section>
        <?php } ?>
      


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
    <script src="https://kit.fontawesome.com/86d37fbec9.js" crossorigin="anonymous"></script>
    <script src="https://www.youtube.com/iframe_api"></script>
    <script src="https://cdn.jsdelivr.net/npm/@glidejs/glide"></script>
    <script>
        var player;

        function onYouTubeIframeAPIReady() {
            player = new YT.Player('video-placeholder', {
                width: '100%',
                height: 400,
                events: { 'onStateChange': onPlayerStateChange },
                videoId: '<?php echo array_shift($videos); ?>',
                playerVars: {
                    autoplay: 1,
                    playlist: '<?php echo implode(",",$videos); ?>',
                    loop: 1

                },

            });
        }
        
        let carousel = new Glide(".glide", {
            type: 'slide',
            startAt: 0,
            perView : 4,
        });
        carousel.mount();

        $('#next').on('click', function() {
            player.nextVideo()
        });
        let previousVideo= 0;
        function onPlayerStateChange(event) {
            if(event.data == 3 && player.getPlaylistIndex()!=previousVideo){
               carousel.go("="+player.getPlaylistIndex());
                previousVideo = player.getPlaylistIndex();
            }
        }
            
        function changeVideo(id){
            player.playVideoAt(id);
        }

    </script>
    
</body>

</html>
