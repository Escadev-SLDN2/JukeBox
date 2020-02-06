<?php
	class Bdd {
//		modifier ici les credentials pour se connecter a la bdd
		private static $default_server 	= 'localhost';
		private static $default_user 	= 'jukebox';
		private static $default_passwd 	= 'A9Z8E1R2';
		private static $default_name 	= 'jukebox';
		
		private static $pdo;
		
//		cree le pdo si il ne l'est pas deja et renvoi sa reference
		public static function &connect(){
			
			if (!(isset(self::$pdo))){
				try{
					self::$pdo = new PDO("mysql:host=" . self::$default_server . ";dbname=" . self::$default_name, self::$default_user, self::$default_passwd);
					self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				} catch(PDOException $e){
					die("ERROR: Could not connect. " . $e->getMessage());
				}
			}
			return self::$pdo;
		}

//		detruit le pdo
		public static function disconnect(){
			self::$pdo = null;
		}
	}