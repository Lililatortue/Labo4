<?php
include "..\DBConnection\dbConnnection.php";
//exercice5
if($_SERVER['REQUEST_METHOD']=="POST"){
    $db = DBConnection::getInstance();
    
        $stmt = $db->getConnection() -> prepare("DELETE FROM utilisateur WHERE email=:email");
        $bool = $stmt -> execute(["email"=>$_POST['email']]);
        if($bool){
            echo "utilisateur effacer avec succes.";
        } else {
            echo "erreur";
        } 
}
if($_SERVER['REQUEST_METHOD']=="GET"){
    $db = DBConnection::getInstance();
   
        $stmt = $db->getConnection() -> prepare( "SELECT * FROM utilisateur");
        $stmt -> execute();
        
        $users=$stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($users as &$user) {
            unset($user['salt']);
            echo $user['nom'].' <form method= "POST"><button type="submit" name ="email" value="'
            .htmlspecialchars($user['email']).
            '">supprimer </button></form>';
        }

}
?>
