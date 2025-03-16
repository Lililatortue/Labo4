<?php
    include "..\DBConnection\dbConnnection.php";
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $db = DBConnection::getInstance();
        $stmt = $db->getConnection() -> prepare("UPDATE utilisateur SET nom = :nom WHERE email= :email");
        $bool = $stmt -> execute(["email" => $_POST['email'],
                                  "nom"   => $_POST['nom']]);
    if($bool){
    echo "utilisateur changer avec succes.";
    } else {
        echo "erreur";
    }
}
?>

<form method="POST">
    <input type="text" name="nom" placeholder="nom">
    <input type="text" name="email" placeholder="email">
    <input type="submit" value="Submit">
</form>