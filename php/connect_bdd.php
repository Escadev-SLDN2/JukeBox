<?php
	class Bdd {
		private static $default_server 	= 'localhost';
		private static $default_user 	= 'jukebox';
		private static $default_passwd 	= 'A9Z8E1R2';
		private static $default_name 	= 'jukebox';
		
		public static function &connect(){
			static $pdo = null;
			if (!(isset($pdo))){
				try{
					echo "test<br>";
					$pdo = new PDO("mysql:host=" . self::$default_server . ";dbname=" . self::$default_name, self::$default_user, self::$default_passwd);
					$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				} catch(PDOException $e){
					die("ERROR: Could not connect. " . $e->getMessage());
				}
			}
			return $pdo;
		}
		
		public static function disconnect(&$pdo){
			$pdo = null;
		}
	}