<?php 
	declare(strict_types=1);
	include "connectBDD.php";

	function isPasswdValid(int $id, string $pass){
		$pdo =& Bdd::connect();
		$sql = "SELECT hash_pass FROM users WHERE id = :id";
		if($stmt = $pdo->prepare($sql)){
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			if($stmt->execute()){
				if($stmt->rowCount() == 1){
					if($row = $stmt->fetch()){
						$hashed_passwd = $row["hash_pass"];
						if(password_verify($pass, $hashed_passwd)){
							return True;
						}
					}
				}
			}
		}
		return False;
	}

//	renvoir l'id de l'utilisateur à qui appartient un mail
	function getUserIdFromMail(string $mail){
		$pdo =& Bdd::connect();
		$sql = "SELECT id FROM users WHERE email=:mail";
		$id = -1;
		if($stmt = $pdo->prepare($sql)){
			$stmt->bindParam(":mail", $mail, PDO::PARAM_STR);
			if($stmt->execute()){
				$rowcount = $stmt->rowcount();
				if($rowcount == 1){				
					foreach($stmt as $row){
						$id = $row['id'];
					}
					return $id;
				}else if($rowcount == 0){
					throw new Exception('No User with this email');
				}else{
					throw new Exception("Multiple User with this email (shouldn't be happening)");
				}
			}else{
				throw new Exception('Stmt->execute() error');
			}
		}
	}

	function getUserFromId(int $id){
		$pdo =& Bdd::connect();
		$sql = "SELECT name, nickname, email FROM users WHERE id = :id";
		$user = array();
		if($stmt = $pdo->prepare($sql)){
			$stmt->bindParam(":id", $id, PDO::PARAM_STR);
			if($stmt->execute()){
				$rowcount = $stmt->rowcount();
				if($rowcount == 1){				
					foreach($stmt as $row){
						$user['name'] = $row['name'];
						$user['nick'] = $row['nickname'];
						$user['mail'] = $row['email'];
					}
				}else if($rowcount == 0){
					throw new Exception('No User with this id');
				}
				return $user;
			}else{
				echo "Something went wrong. Please try again later.";
			}
		}
	}

//	suppression d'un utilisateur de la bdd
	function delUser(int $id){
		$pdo =& Bdd::connect();
		$sql = "DELETE FROM users WHERE id = :id";
		if($stmt = $pdo->prepare($sql)){
			$stmt->bindParam(":id", $id, PDO::PARAM_STR);
			if($stmt->execute()){
				echo "Done";
			}else{
				throw new Exception("Something went wrong. Please try again later.");
			}
		}
	}

// ajout d'un utilisateur a la bdd
	function addUser(string $name, string $nick, string $mail, string $pass){
		$pdo =& Bdd::connect();
		$sql = "INSERT INTO users (name, nickname, email, hash_pass) VALUES (:name, :nick, :mail, :hash)";
		
//		s'execute seulement si le pdo accepte la synthaxe de la requete
		if($stmt = $pdo->prepare($sql)){

//			lie les paramettres de la requette avec les variables correspondantes
			$stmt->bindParam(':name', $name, PDO::PARAM_STR);
			$stmt->bindParam(':nick', $nick, PDO::PARAM_STR);
			$stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
			$stmt->bindParam(':hash', $hash, PDO::PARAM_STR);

//			hash le mdp de l'utilisateur avant de l'entrer dans la bdd
			$hash = password_hash($pass, PASSWORD_DEFAULT);

//			ecrit done si la bdd accepte la requete
//			ecrit un message d'erreur generique en cas de renvois d'erreur de la part de la bdd
			if($stmt->execute()){
				echo "Done";
			}else{
				throw new Exception("Something went wrong. Please try again later.");
			}
		}
	}

//	modifie la ligne d'un utilisateur dans la bdd
//	ne modifie que les champs necessaires
	function modUser(int $id, string $name="", string $nick="", string $mail="", string $pass=""){
		$pdo =& Bdd::connect();
		$sql = "UPDATE users SET ";
		$nb = 0;

//		dans chaque cas on ajoute a la requete les valeurs a modifier si elles ont ete passe en paramettres
//		si il y a aumoins un element avant, on rajoute une virgule et un espace pour respecter la synthaxe
		if(strlen($name) != 0){
			$sql .="name = :name";
			$nb = $nb+1;
		}
		if(strlen($nick) != 0){
			if($nb >= 1){
				$sql .=", ";
			}
			$sql .="nickname = :nick";
			$nb = $nb+1;
		}
		if(strlen($mail) != 0){
			if($nb >= 1){
				$sql .=", ";
			}
			$sql .="email = :mail";
			$nb = $nb+1;
		}
		if(strlen($pass) != 0){
			if($nb >= 1){
				$sql .=", ";
			}
			$sql .="hash_pass = :hash";
		}

		$sql .=" WHERE id=:id";


		if($stmt = $pdo->prepare($sql)){
//			lie les paramettres de la requette avec les variables correspondantes si elles ont ete passe en paramettres
			if(strlen($name) != 0){$stmt->bindParam(":name", $name, PDO::PARAM_STR);}
			if(strlen($nick) != 0){$stmt->bindParam(":nick", $nick, PDO::PARAM_STR);}
			if(strlen($mail) != 0){$stmt->bindParam(":mail", $mail, PDO::PARAM_STR);}
			if(strlen($pass) != 0){
				$stmt->bindParam(":hash", $hash, PDO::PARAM_STR);
				$hash = password_hash($pass, PASSWORD_DEFAULT);
			}
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			
			if($stmt->execute()){
				echo "Done";
			}else{
				echo "Something went wrong. Please try again later.";
			}
		}
	}