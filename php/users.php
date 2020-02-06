<?php 
	declare(strict_types=1);
	ini_set('session.auto_start', '1');
	require_once "connect_bdd.php";

	class User {
		public $id;
		public $name;
		public $nick;
		public $mail;
		public $role;

//		contructeur d'user
		function __construct(int $_id, string $_name, string $_nick, string $_mail, $_role){
			$this->id = $_id;
			$this->name = $_name;
			$this->nick = $_nick;
			$this->mail = $_mail;
			$this->role = $_role;
		}

//		Ajout/suppression/modification d'un user 	

//		supprime un utilisateur de la bdd
		function delete(){
			$pdo =& Bdd::connect();
			$sql = "DELETE FROM users WHERE id = :id";
			if($stmt = $pdo->prepare($sql)){
				$stmt->bindParam(":id", $this->id, PDO::PARAM_STR);
				if(!($stmt->execute())){
					throw new Exception("Something went wrong. Please try again later.");
				}
			}
		}

//		ne modifie que le role d'un user
		function changeRole(string $role){
			$this->modify( "", "", "", "", $role);
		}	

//		modifie la ligne d'un utilisateur dans la bdd
//		ne modifie que les champs necessaires
		function modify(string $name="", string $nick="", string $mail="", string $pass="", string $role=""){
			$pdo =& Bdd::connect();
			$sql = "UPDATE users SET ";
			$nb = 0;

	//		dans chaque cas on ajoute a la requete les valeurs a modifier si elles ont ete passe en paramettres
	//		si il y a aumoins un element avant, on rajoute une virgule et un espace pour respecter la synthaxe
			if(!empty($name)){
				$sql .="name = :name";
				$nb = $nb+1;
			}
			if(!empty($nick)){
				if($nb >= 1){
					$sql .=", ";
				}
				$sql .="nickname = :nick";
				$nb = $nb+1;
			}
			if(!empty($mail)){
				if($nb >= 1){
					$sql .=", ";
				}
				$sql .="email = :mail";
				$nb = $nb+1;
			}
			if(!empty($pass)){
				if($nb >= 1){
					$sql .=", ";
				}
				$sql .="hash_pass = :hash";
				$nb = $nb+1;
			}
			if(!empty($role)){
				if($nb >= 1){
					$sql .=", ";
				}
				$sql .="role = :role";
				$nb = $nb+1;
			}

			$sql .=" WHERE id=:id";


			if($stmt = $pdo->prepare($sql)){
	//			lie les paramettres de la requette avec les variables correspondantes si elles ont ete passe en paramettres
				$stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
				if(!empty($name)){$stmt->bindParam(":name", $name, PDO::PARAM_STR);}
				if(!empty($nick)){$stmt->bindParam(":nick", $nick, PDO::PARAM_STR);}
				if(!empty($mail)){$stmt->bindParam(":mail", $mail, PDO::PARAM_STR);}
				if(!empty($pass)){
					$stmt->bindParam(":hash", $hash, PDO::PARAM_STR);
					$hash = password_hash($pass, PASSWORD_DEFAULT);
				}
				if(!empty($role)){$stmt->bindParam(":role", $role, PDO::PARAM_STR);}


				if($stmt->execute()){
					
					if(!empty($name)){$this->name=$name;}
					if(!empty($nick)){$this->nick=$nick;}
					if(!empty($mail)){$this->mail=$mail;}
					if(!empty($role)){$this->role=$role;}
				}else{
					throw new Exception('Stmt->execute() error');
				}
			}else{
				throw new Exception('$pdo->prepare($sql) error');	
			}
		}

//		ajoute un utilisateur a la bdd
		static function add(string $name, string $nick, string $mail, string $pass){
			$pdo =& Bdd::connect();
			$sql = "INSERT INTO users (name, nickname, email, hash_pass) VALUES (:name, :nick, :mail, :hash)";

	//		s'execute seulement si le pdo accepte la synthaxe de la requete et si le mail n'est pas deja present dans la bdd
			$idFromMail=self::getIdFromMail($mail);
			if(($idFromMail==-1)and($stmt = $pdo->prepare($sql))){

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
					return self::getFromId(self::getIdFromMail($mail));
				}else{
					throw new Exception("Something went wrong. Please try again later.");
				}
			}else if($idFromMail>=0){
				throw new Exception("Mail already used");
			}
		}

//		renvoi l'id de l'utilisateur a qui appartient le mail
		static function getIdFromMail(string $mail){
			$pdo =& Bdd::connect();
			$sql = "SELECT id FROM users WHERE email=:mail";
			$id = -1;
			if($stmt = $pdo->prepare($sql)){
				$stmt->bindParam(":mail", $mail, PDO::PARAM_STR);
				if($stmt->execute()){
					$rowcount = $stmt->rowcount();
					if($rowcount == 1){				
						foreach($stmt as $row){
							$id = (int)$row['id'];
						}
					}else if($rowcount > 0){
						throw new Exception("Multiple User with this email (shouldn't be happening)");
					}
					return $id;
				}else{
					throw new Exception('Stmt->execute() error');
				}
			}
		}

//		renvoi les donnes de l'user identifie par l'id
		static function getFromId(int $id){
			$pdo  =& Bdd::connect();
			$sql  = "SELECT name, nickname, email, role FROM users WHERE id = :id";
			if($stmt = $pdo->prepare($sql)){
				$stmt->bindParam(":id", $id, PDO::PARAM_STR);
				if($stmt->execute()){
					$rowcount = $stmt->rowcount();
					if($rowcount == 1){				
						if($row = $stmt->fetch()){
							$user = new User((int)$id, $row['name'], $row['nickname'], $row['email'], $row['role']);
						}
					}else if($rowcount == 0){
						throw new Exception('No User with this id');
					}
					return $user;
				}else{
					throw new Exception('$stmt->execute() error');
				}
			}
		}

//		Gestion des roles	

//		renvoi l'id du user qui a pour role SU	
		static function getSUId(){
			$pdo =& Bdd::connect();
			$sql = "SELECT id FROM users WHERE role = 'SU'";
			if($stmt = $pdo->query($sql)){
					if($stmt->rowCount() == 1){
						if($row = $stmt->fetch()){
							return $row['id'];
						}else{
							throw new Exception('$stmt->fetch() error');
						}
					}else if ($stmt->rowCount() > 1){
						throw new Exception('Multiples SU exists');
					}else if ($stmt->rowCount() == 0){
						return -1;	
					}
			}else{
				throw new Exception('$pdo->query($sql) error');
			}
		}

//		verifie si un user a le role SU
//		renvoi un booleen 
		static function isSUSet(){
			$id = self::getSUId();
			if ($id == -1){
				return false;
			}
			return true;
		}	

//		Connexion d'un user	

//		renvoi un booleen correspondant a la validite du couple (id, pass)
		static function isPasswdValid(int $id, string $pass){
			$pdo =& Bdd::connect();
			$sql = "SELECT hash_pass FROM users WHERE id = :id";
			if($stmt = $pdo->prepare($sql)){
				$stmt->bindParam(":id", $id, PDO::PARAM_INT);
				if($stmt->execute()){
					if($stmt->rowCount() == 1){
						if($row = $stmt->fetch()){
							$hashed_passwd = $row["hash_pass"];
							if(password_verify($pass, $hashed_passwd)){
								return true;
							}
						}
					}
				}
			}
			return false;
		}

//		verifie les credentials du user,
//		si elles sont valides, met ses donnes dans $_SESSION et renvoi une string vide,
//		sinon leve une exception
		static function connect(string $mail, string $pass){
			$id = -1;
			$user = array();
			try{
				if(empty($mail)){
					throw new Exception("Please enter your email.");
				} 

				if(empty($pass)){
					throw new Exception("Please enter your password.");
				}
				$id = self::getIdFromMail($mail);
				if (self::isPasswdValid($id, $pass)){
					$user = self::getFromId($id);
					$_SESSION['user'] = $user;
					$_SESSION['loggedIn'] = true;
				}else{
					throw new Exception("Invalid Password");
				}

			}catch(Exception $e){
				$_SESSION['loggedIn'] = false;
				$_SESSION['user'] = null;
				throw $e;
			}
		}
		
//		verifie si les donnes necessaires sont presentes dans $_SESSION
//		renvoi un booleen
		static function isConnected(){
			if( (isset($_SESSION["user"]) && (isset($_SESSION["loggedIn"])) && $_SESSION["loggedIn"]) === true){
				return true;
			}
			return false;
		}

//		deconnecte le user
		static function disconnect(){
			$_SESSION['loggedIn'] = false;
			$_SESSION['user'] = null;
		}

	}