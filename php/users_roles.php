<?php
	include "connect_bdd.php"

	function isSUserSet(){
		$pdo =& Bdd::connect();
		$sql = "SELECT id FROM users WHERE role = 'SU'";
		if($stmt = $pdo->query($sql)){
				if($stmt->rowCount() == 1){
					return True;
				}else if ($stmt->rowCount() > 1){
					throw new Exception('Multiples SU exists');
				}
			return False;
		}else{
			throw new Exception('$pdo->query($sql) error');
		}
	}

	function getSUserId(){
		
	}