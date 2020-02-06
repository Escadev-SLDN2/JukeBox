<?php
	include "users.php";
	session_start();

//	change le role du user connecte dans $_SESSION et dans la bdd
	function changeConnectedUserRole(string $role){
		if (isset($_SESSION['id'])){
			changeUserRole($_SESSION['id'], $role);
			$_SESSION['role'] = $role;
		}
	}

//	verifie les credentials du user,
//	si elles sont valides, met ses donnes dans $_SESSION et renvoi une string vide,
//	sinon renvoi une string correspondant à l'erreur
	function connectUser(string $mail, string $pass){
		$id = -1;
		$user = array();
		try{
			if(empty($mail)){
				throw new Exception("Please enter your email.");
			} 

			if(empty($pass)){
				throw new Exception("Please enter your password.");
			}
			$id = getUserIdFromMail($mail);
			if (isPasswdValid($id, $pass)){
				$user = getUserFromId($id);
				$_SESSION['id']   = $user['id'];
				$_SESSION['user'] = $user['nick'];
				$_SESSION['role'] = $user['role'];
				$_SESSION['loggedIn'] = True;
				return "";
			}else{
				throw new Exception("Invalid Password");
			}
			
		}catch(Exception $e){
			$_SESSION['loggedIn'] = False;
			return ($e->getMessage());
		}
	}


//	verifie si les donnes necessaires sont presentes dans $_SESSION
//	renvoi un booleen
	function isUserConnected(){
		if( (isset($_SESSION["user"]) && (isset($_SESSION["loggedIn"])) && $_SESSION["loggedIn"]) === true){
			return True;
		}
		return False;
	}

//	deconnecte le user
	function disconnectUser(){
		$_SESSION['loggedIn'] = False;
		$_SESSION['id'] = null;
	}
