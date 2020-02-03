<?php  
    include "connect_bdd.php";
    //ajout d'une video à la BDD
    function addvideos(string $id_yt, int $user_id){
        $pdo = & Bdd :: connect();
        $sql = "INSERT INTO videos (id_yt, user_id) VALUES (:id_yt, :user_id)";

        // s'exécute seulement si le pdo accepte la synthaxe de la requete
        if($stmt = $pdo -> prepare ($sql)){

            // lie les params de la requette avec les varibles correspondantes
            $stmt ->bindParam (':id_yt', $id_yt, PDO ::PARAM_STR);
            $stmt ->bindParam (':user_id', $user_id, PDO ::PARAM_STR);

            //ecrit done si la bdd accepte la requete
            //ecrit un message d'erreur generique en cas de renvois d'erreur de la part de la bdd
			if(!($stmt->execute())){
				throw new Exception("Something went wrong. Please try again later.");
			}
        }

    }
    
    //modifier la video dans la BDD
    function modifvideos(int $id,string $id_yt, int $user_id=-1){
        $pdo = & Bdd :: connect();
        $sql = "UPDATE videos SET";
        $nb = 0;
        
        if(strlen($id_yt) != 0){

            $sql .="id_yt = :id_yt";
            $nb = $nb+1;
        }
        //ici on n'utilise pas le strlen parce que il calcule la longeur d'une chaine de cara.

        if( $user_id != -1){
            if($nb >= 1){ 
                $sql .=", ";
            }
                
            $sql .="users_id= :user_id";
            $nb = $nb+1;
        }
        
        $sql .=" WHERE id=:id";
        

        if($stmt = $pdo->prepare($sql)){
        // lie les paramettres de la requette avec les variables correspondantes si elles ont ete passe en paramettres
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            if(strlen($id_yt) != 0){$stmt->bindParam(":id_yt", $id_yt, PDO::PARAM_STR);}
            if($users_id != -1){$stmt->bindParam(":users_id", $users_id, PDO::PARAM_STR);}
            
            if(!($stmt->execute())){
            throw new Exception('Stmt->execute() error');
            }
        }else{
        throw new Exception('$pdo->prepare($sql) error'); 
        }
    }
    
    // suppression d'une video dans la bdd
    function delvideos(int $id){

        $pdo =& Bdd::connect();
        $sql = "DELETE FROM videos WHERE id = :id";

        if($stmt = $pdo->prepare($sql)){

            $stmt->bindParam(":id", $id, PDO::PARAM_STR);

            if(!($stmt->execute())){
				throw new Exception("Something went wrong. Please try again later.");
			}
        }
    }

    ?>