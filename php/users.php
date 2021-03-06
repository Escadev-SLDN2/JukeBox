<?php

declare(strict_types=1);
require_once "bdd.php";

class User
{
    public $id;
    public $name;
    public $nick;
    public $mail;
    public $role;

    //	contructeur d'user
    public function __construct(int $id, string $name, string $nick, string $mail, string $role)
    {
        $this->id = $id;
        $this->name = $name;
        $this->nick = $nick;
        $this->mail = $mail;
        $this->role = $role;
    }

    //	Ajout/suppression/modification d'un user

    //    Récupère tous les utilisateurs
    public static function findAll()
    {
        $pdo = DBConnect();
        $sql = "SELECT * FROM users WHERE role='ROLE_USER'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    //	supprime un utilisateur de la bdd
    public function delete()
    {
        $pdo = DBConnect();
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':id' => $this->id));
    }

    //	modifie la ligne d'un utilisateur dans la bdd
    //	ne modifie que les champs necessaires
    public function modify(string $name = "", string $nick = "", string $mail = "", string $pass = "", $role = "")
    {
        $pdo = DBConnect();
        $sql = "UPDATE users SET ";
        $nb = 0;
        $parametres = array();
        //	dans chaque cas on ajoute a la requete les valeurs a modifier si elles ont ete passe en paramettres
        //	si il y a au moins un element avant, on rajoute une virgule et un espace pour respecter la synthaxe
        if (!empty($name)) {
            $sql .= "name = :name";
            $nb++;
        }
        if (!empty($nick)) {
            if ($nb >= 1) {
                $sql .= ", ";
            }
            $sql .= "nickname = :nick";
            $nb++;
        }
        if (!empty($mail)) {
            if ($nb >= 1) {
                $sql .= ", ";
            }
            $sql .= "email = :mail";
            $nb++;
        }
        if (!empty($pass)) {
            if ($nb >= 1) {
                $sql .= ", ";
            }
            $sql .= "hash_pass = :hash";
            $nb++;
        }
        if (!empty($role)) {
            if ($nb >= 1) {
                $sql .= ", ";
            }
            $sql .= "role = :role";
            $nb++;
        }
        $sql .= " WHERE id=:id";
        $stmt = $pdo->prepare($sql);
        $parametres[':id'] = $this->id;
        if (!empty($name)) {
            $parametres[':name'] = $name;
        }
        if (!empty($nick)) {
            $parametres[':nick'] = $nick;
        }
        if (!empty($mail)) {
            $parametres[':mail'] = $mail;
        }
        if (!empty($pass)) {
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $parametres[':hash'] = $hash;
        }
        if (!empty($role)) {
            $parametres[':role'] = $role;
        }
        $stmt->execute($parametres);
        if (!empty($name)) {
            $this->name = $name;
        }
        if (!empty($nick)) {
            $this->nick = $nick;
        }
        if (!empty($mail)) {
            $this->mail = $mail;
        }
        if (!empty($role)) {
            $this->role = $role;
        }
    }

    //	ne modifie que le role d'un user
    public function changeRole(string $role)
    {
        $this->modify("", "", "", "", $role);
    }

    //	renvoi l'id de l'utilisateur a qui appartient le mail
    public static function getIdFromMail(string $mail)
    {
        $pdo = DBConnect();
        $sql = "SELECT id FROM users WHERE email=:mail";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':mail' => $mail));
        if ($stmt->rowcount() > 1) {
            throw new Exception("Multiple Users with this email");
        } else if ($stmt->rowcount() == 0) {
            return -1;
        }
        $row = $stmt->fetch();
        $id = (int) $row['id'];
        return $id;
    }

    public static function isMailUsed(string $mail)
    {
        $id = self::getIdFromMail($mail);
        if ($id == -1) {
            return false;
        }
        return true;
    }

    //	renvoi les donnes de l'user identifie par l'id
    public static function getFromId(int $id)
    {
        $pdo = DBConnect();
        $sql = "SELECT name, nickname, email, role FROM users WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':id' => $id));
        if ($stmt->rowcount() == 1) {
            $row = $stmt->fetch();
            $user = new User((int) $id, $row['name'], $row['nickname'], $row['email'], (string) $row['role']);
            return $user;
        } else if ($stmt->rowcount() == 0) {
            throw new Exception('No User with this id');
        }
    }

    public static function getFromMail(string $mail)
    {
        $id = self::getIdFromMail($mail);
        if ($id == -1) {
            throw new Exception('No User with this mail');
        }
        return self::getFromId($id);
    }

    //	ajoute un utilisateur a la bdd
    public static function add(string $name, string $nick, string $mail, string $pass)
    {
        $pdo = DBConnect();
        $sql = "INSERT INTO users (name, nickname, email, hash_pass, role) VALUES (:name, :nick, :mail, :hash, :role)";
        if (self::isMailUsed($mail)) {
            throw new Exception("error-email");
        } else {
            $stmt = $pdo->prepare($sql);
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $stmt->execute(array(':name' => $name, ':nick' => $nick, ':mail' => $mail, ':hash' => $hash, ':role' => 'ROLE_USER'));
            return self::getFromMail($mail);
        }
    }

    //	Gestion des roles


    //	renvoi l'id du user qui a pour role SU
    public static function getSUId()
    {
        $pdo = DBConnect();
        $sql = "SELECT id FROM users WHERE role = 'ROLE_ADMIN'";
        $answer = $pdo->query($sql);
        if ($answer->rowCount() == 0) {
            return -1;
        }else {
            $row = $answer->fetch();
            return $row['id'];
        }
        
    }

    //	verifie si un user a le role SU
    //	renvoi un booleen
    public function isSU()
    {
        $id = self::getSUId();
        if (($id == $this->id)) {
            return true;
        }
        return false;
    }

    //Connexion d'un user


    //renvoi un booleen correspondant a la validite du couple (id, pass)
    public static function isPasswdValid(string $mail, string $pass)
    {
        if (self::isMailUsed($mail)) {
            $pdo = DBConnect();
            $id = self::getIdFromMail($mail);
            $sql = "SELECT hash_pass FROM users WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(':id' => $id));
            $row = $stmt->fetch();
            $hashed_passwd = $row["hash_pass"];
            if (password_verify($pass, $hashed_passwd)) {
                return true;
            }
        }
        return false;
    }

    //	verifie les credentials du user,
    //	si elles sont valides, met ses donnes dans $_SESSION et renvoi une string vide,
    //	sinon leve une exception
    public static function connect(string $mail, string $pass)
    {
        try {
            if (empty($mail)) {
                throw new Exception("error-empty");
            }
            if (empty($pass)) {
                throw new Exception("error-empty");
            }
            if (self::isPasswdValid($mail, $pass)) {
                $user = self::getFromMail($mail);
                session_start();
                $_SESSION['user'] = $user;
                $_SESSION['loggedIn'] = true;
                setcookie("userId", (string) $user->id, time() + 3600, '/');
            } else {
                throw new Exception("error-connect");
            }
        } catch (Exception $e) {
            self::disconnect();
            throw $e;
        }
    }

    //	verifie si les donnes necessaires sont presentes dans $_SESSION
    //	renvoi un booleen
    public static function isConnected()
    {
        if ((isset($_SESSION["user"]) && (isset($_SESSION["loggedIn"])) && $_SESSION["loggedIn"]) === true) {
            return true;
        } else if (isset($_COOKIE['userId']) && !empty($_COOKIE['userId'])) {
            $id = (int) $_COOKIE['userId'];
            $user = self::getFromId($id);
            session_start();
            $_SESSION['user'] = $user;
            $_SESSION['loggedIn'] = true;
            return true;
        }
        return false;
    }

    //	deconnecte le user
    public static function disconnect()
    {
        session_unset();
        session_destroy();
        //  pour supprimer le cookie, je le recréé vide et avec une date d'expiration passée
        setcookie("PHPSESSID", '', time() - 1, '/');
        setcookie("userId", '', time() - 1, '/');
    }

    // modification d'un rôle utilisateur
    public static function setrole($role, $id) {
        $pdo = DBConnect();      
        $sql = "UPDATE users SET role='$role' WHERE id=$id;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    }
}