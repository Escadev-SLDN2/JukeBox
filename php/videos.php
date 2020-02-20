<?php
// Affichage des erreurs détaillées :
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Récupération des données 
require_once "bdd.php";

//ajout d'une video à la BDD
function addvideos(string $id_yt, int $user_id)
{
    $pdo = DBConnect();
    $sql = "INSERT INTO videos (id_yt, user_id) VALUES (:id_yt, :user_id)";

    //interdit les doublond grace à l'id_yt
    if (GetIdVideo($id_yt) != -1) {
        throw new Exception("la video existe déja");
    } else {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_yt', $id_yt, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
    }
}

/*
    recupérartion de l'id video garce à l'id_yt
    */
function GetIdVideo(string $id_yt)
{
    $pdo = DBConnect();
    $sql = "SELECT id FROM videos WHERE id_yt='$id_yt'";
    $result = $pdo->query($sql);
    if ($result->rowcount() > 1) {          //verrifie les doublons
        throw new Exception('deux fois meme videos ');
    } elseif ($result->rowcount() == 1) {   //verifie qu'une seule video avec id_yt
        $tab = $result->fetch();          //recupére une ligne depuis le resultat associé à la PDO
        return $tab['id'];              //affiche id sous forme d'un tableau
    } elseif ($result->rowcount() == 0) {    //aucune video
        return -1;
    }
}

//modifier la video dans la BDD
function modifvideos(int $id, string $id_yt, int $user_id = -1)
{
    $pdo = DBConnect();
    $sql = "UPDATE videos SET ";
    $nb = 0;

    if (strlen($id_yt) != 0) {

        $sql .= "id_yt = :id_yt";
        $nb = $nb + 1;
    }
    if ($user_id != -1) {
        if ($nb >= 1) {
            $sql .= ", ";
        }

        $sql .= "user_id= :user_id";
        $nb = $nb + 1;
    }

    $sql .= " WHERE id=:id";


    if ($stmt = $pdo->prepare($sql)) {
        // lie les paramettres de la requette avec les variables correspondantes si elles ont ete passe en paramettres
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if (strlen($id_yt) != 0) {
            $stmt->bindParam(":id_yt", $id_yt, PDO::PARAM_STR);
        }
        if ($user_id != -1) {
            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        }

        if (!($stmt->execute())) {
            throw new Exception('Stmt->execute() error');
        }
    } else {
        throw new Exception('$pdo->prepare($sql) error');
    }
}

// suppression d'une video dans la bdd
function delvideos(int $id)
{

    $pdo = DBConnect();
    $sql = "DELETE FROM videos WHERE id = :id";

    if ($stmt = $pdo->prepare($sql)) {

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if (!($stmt->execute())) {
            throw new Exception("Something went wrong. Please try again later.");
        }
    }
}
