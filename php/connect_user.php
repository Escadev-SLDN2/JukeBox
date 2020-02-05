<?php
	require_once "users.php";
	session_start();

//	verifie les credentials du user,
//	si elles sont valides, met ses donnes dans $_SESSION et renvoi une string vide,
//	sinon leve une exception
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
			$id = User::getUserIdFromMail($mail);
			if (User::isPasswdValid($id, $pass)){
				$user = User::getUserFromId($id);
				$_SESSION['user'] = $user;
				$_SESSION['loggedIn'] = true;
			}else{
				throw new Exception("Invalid Password");
			}
			
		}catch(Exception $e){
			$_SESSION['loggedIn'] = false;
			$_SESSION['user'] = null;
			return ($e->getMessage());
		}
	}

//	verifie si les donnes necessaires sont presentes dans $_SESSION
//	renvoi un booleen
	function isUserConnected(){
		if( (isset($_SESSION["user"]) && (isset($_SESSION["loggedIn"])) && $_SESSION["loggedIn"]) === true){
			return true;
		}
		return false;
	}

//	deconnecte le user
	function disconnectUser(){
		$_SESSION['loggedIn'] = false;
		$_SESSION['user'] = null;
	}
