<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include "../users.php";
$pdo = &Bdd::connect();
$pdo->query("DELETE FROM users WHERE nickname='tt0' OR nickname='tt1' OR nickname='tt2'");

/*	Tests des ajouts
 try{$user0 = User::add("test0", "tt0", "test0@localhost", "test");} catch(Exception $e){echo($e->getMessage())."<br>\n";}
    Cree un user dans la bdd et stocke le user dans une variable.
    Si un user avec ce mail existe deja dans la bdd ou en cas d'autre d'erreur, affiche l'erreur.
 try{print_r (getUserFromId($id)); echo "<br>\n";} catch(Exception $e){echo($e->getMessage())."<br>\n";}
    Affiche l'array correspondant au user possedant l'id s'il y en a un, sinon affiche le message d'erreur.
 */
try {
    $user0 = User::add("test0", "tt0", "test0@localhost", "test");
}
catch(Exception $e) {
    echo($e->getMessage()). "<br>\n";
}
try {
    $test = User::add("test0", "tt0", "test0@localhost", "test");
}
catch(Exception $e) {
    echo($e->getMessage()). "<br>\n";
}
try {
    $user1 = User::add("test1", "tt1", "test1@localhost", "test");
}
catch(Exception $e) {
    echo($e->getMessage()). "<br>\n";
}
try {
    $user2 = User::add("test2", "tt2", "test2@localhost", "test");
}
catch(Exception $e) {
    echo($e->getMessage()). "<br>\n";
}
if(isset($user0)) {
    try {
        print_r(User::getFromId($user0->id));
        echo "<br>\n";
    }
    catch(Exception $e) {
        echo($e->getMessage()). "<br>\n";
    }
} else {
    echo "User is not set <br>\n";
}
if(isset($test)) {
    try {
        print_r(User::getFromId($test->id));
        echo "<br>\n";
    }
    catch(Exception $e) {
        echo($e->getMessage()). "<br>\n";
    }
} else {
    echo "User is not set <br>\n";
}
if(isset($user1)) {
    try {
        print_r(User::getFromId($user1->id));
        echo "<br>\n";
    }
    catch(Exception $e) {
        echo($e->getMessage()). "<br>\n";
    }
} else {
    echo "User is not set <br>\n";
}
if(isset($user2)) {
    try {
        print_r(User::getFromId($user2->id));
        echo "<br>\n";
    }
    catch(Exception $e) {
        echo($e->getMessage()). "<br>\n";
    }
} else {
    echo "User is not set <br>\n";
}

/*	Tests des suppression
 */
if(isset($user0)) {
    $user0->delete();
}

/*	Tests des modification
 */
$user1->modify("blabla", "bla", "bla@bla", "azerty");
$user2->modify("", "bla5", "", "azea");
try {
    print_r(User::getFromId($user1->id));
    echo "<br>\n";
}
catch(Exception $e) {
    echo($e->getMessage()). "<br>\n";
}
try {
    print_r(User::getFromId($user2->id));
    echo "<br>\n";
}
catch(Exception $e) {
    echo($e->getMessage()). "<br>\n";
}

/*	Tests de getUserIdFromMail()
 try{echo (User::getIdFromMail("test@test"))."<br>\n";} catch(Exception $e){echo($e->getMessage())."<br>\n";}
    Affiche l'id du user possedant ce mail s'il y en a un, sinon affiche le message d'erreur
 */
try {
    echo(User::getIdFromMail("test@test")). "<br>\n";
}
catch(Exception $e) {
    echo($e->getMessage()). "<br>\n";
}
try {
    echo(User::getIdFromMail($user1->mail)). "<br>\n";
}
catch(Exception $e) {
    echo($e->getMessage()). "<br>\n";
}

/*	Tests de isPasswdValid()
 echo (User::isPasswdValid($user1->id,"azerty") ? "true" : "false")."<br>\n";
    Permet d'afficher si le couple (id, password) est valide ou non .
 
 */
echo(User::isPasswdValid($user1->id, "azerty")? "true" : "false"). "<br>\n";
echo(User::isPasswdValid($user1->id, "test")? "true" : "false"). "<br>\n";
$user1->delete();
$user2->delete();
Bdd::disconnect();

/*	la page devrait afficher :
 
 Mail already used
 User Object ( [id] => 147 [name] => test0 [nick] => tt0 [mail] => test0@localhost [role] => )
 User is not set
 User Object ( [id] => 148 [name] => test1 [nick] => tt1 [mail] => test1@localhost [role] => )
 User Object ( [id] => 149 [name] => test2 [nick] => tt2 [mail] => test2@localhost [role] => )
 User Object ( [id] => 148 [name] => blabla [nick] => bla [mail] => bla@bla [role] => )
 User Object ( [id] => 149 [name] => test2 [nick] => bla5 [mail] => test2@localhost [role] => )
 -1
 148
 true
 false
 */

?>