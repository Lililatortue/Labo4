<?php
include "..\DBConnection\dbConnnection.php";
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $db = DbConnection::getInstance(); 
        $salt = base64_encode(random_bytes(16));
        $iterations = 100000;
        $hash = hash_pbkdf2("sha256",$_POST['psw'],$salt,$iterations,20);

        $stmt = $db->getConnection() -> prepare("INSERT INTO utilisateur(nom, email, password, salt ) 
                                    VALUES (:nom,:email, :password, :salt)");
        $bool=$stmt -> execute([":nom" => $_POST['nom'],
                                ":email" => $_POST['email'], 
                                ":password" =>$hash,
                                ":salt" =>$salt]);
    
    if($bool){
        echo "\nutilisateur creer avec succes.";
        } else {
            echo "erreur";
        }
    }
?>
<!--pas fait de check de nom email et psw-->
<form method="POST">
    <input type="text" name="nom" placeholder="nom" require>
    <input type="text" name="email" placeholder="email" require>
    <input type="text" name="psw" placeholder="psw" require>
    <input type="submit" value="creer">
</form>