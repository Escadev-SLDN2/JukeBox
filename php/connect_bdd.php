<?php
	class Bdd {
		private static $default_server 	= 'localhost';
		private static $default_user 	= 'jukebox';
		private static $default_passwd 	= 'A9Z8E1R2';
		private static $default_name 	= 'jukebox';
		private static $pdo;
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
		
		public static function disconnect(){
			self::$pdo = null;
		}
	}