<?php

//	cree le pdo si il ne l'est pas deja et renvoi sa reference
    function DBConnect($server='localhost', $name='jukebox', $user='jukebox', $passwd='A9Z8E1R2'){
        try{
            $pdo = new PDO("mysql:host=" . $server . ";dbname=" . $name, $user, $passwd);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
            die("ERROR: Could not connect. " . $e->getMessage());
        }
        return $pdo;
    }