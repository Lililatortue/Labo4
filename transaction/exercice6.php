<?php
include "..\DBConnection\dbConnnection.php";
$users=[];
if($_SERVER['REQUEST_METHOD']=="POST"){
    $db = DBConnection::getInstance();
        $stmt = $db->getConnection() -> prepare("INSERT INTO transacations (user_id, montant,
                                                             type_transaction, date_transaction )
                                                              VALUES (:user_id, :montant, :type_transaction, :date_transaction)");
        $bool = $stmt -> execute(["user_id"=>$_POST['id'],
                                    "montant"=>$_POST['montant'],
                                    "type_transaction"=>$_POST['type_transaction'],
                                    "date_transaction"=>$_POST['date_transaction'],
                                ]);
        if($bool){
            echo "transaction effectuer avec succes";
        } else {
            echo "erreur";
        } 
}

    $db = DBConnection::getInstance();
   
        $stmt = $db->getConnection() -> prepare( "SELECT * FROM utilisateur");
        $stmt -> execute();
        
        $users=$stmt->fetchAll(PDO::FETCH_ASSOC);


?>
<form method="POST">
<label for="user">choose user</label>
<select name="id">
<?php foreach($users as $user):?>
'<option value=<?=$user['id']?>><?=$user['nom']?></option>'
<?php endforeach ?>
</select>
<input type="number" name="montant" placeholder="montant" require>
<select name="type_transaction">
    <option value="achat">achat</option>
    <option value="vente">vente</option>
</select>
<input type="date" name="date_transaction" placeholder="date_transaction" require>
    <input type="submit" value="ajouter">
</form>