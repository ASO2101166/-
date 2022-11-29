<?php
    session_start();
    require_once 'Dbconnect.php';
    class CartSelect{
        function cartselect($cart_id){
            $user = unserialize($_SESSION['user']);
            $cls = new Dbconnect();
            $pdo = $cls->dbConnect();
            $sql = "SELECT * FROM carts AS c INNER JOIN items AS i
                    INNER JOIN users AS u WHERE u.user_id = ?;";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1,$user->user_id,PDO::PARAM_STR);
            $ps->execute();
            $userData = $ps->fetchAll();
            foreach($cartData as $row){  
                
            }
            return $carts;
        }
    }
?>

