<?php
include "..\DBConnection\dbConnnection.php";
$users=[];
$transaction=[];
$db = DBConnection::getInstance();
   
$stmt = $db->getConnection() -> prepare( "SELECT * FROM utilisateur");
$stmt -> execute();

$users=$stmt->fetchAll(PDO::FETCH_ASSOC);
if($_SERVER['REQUEST_METHOD']=="POST"){
    $db = DBConnection::getInstance();
   
        $stmt = $db->getConnection() -> prepare( "SELECT * FROM transacations where user_id=:user_id");
        $stmt -> execute(['user_id'=> $_POST['id']]);
        $transaction=$stmt->fetchAll(PDO::FETCH_ASSOC);
       
        foreach($transaction as $trans){
            echo "<br>type de transaction:".$trans['type_transaction'].
            "<br>Montant: ".$trans['montant']."<br>Date".$trans['date_transaction'];
        }
        
}



?>
<form method="POST">
<label for="user">choose user</label>
<select name="id">
<?php foreach($users as $user):?>
'<option value=<?=$user['id']?>><?=$user['nom']?></option>'
<?php endforeach ?>
<input type="submit" value="regarder transaction">
</form>