<?php
    if(!isset($_SESSION)){
        session_start();
    }
    require_once 'Dbconnect.php';
    require_once 'UserInfo.php';
    class CartSelect{

        function cartselectbyuserid($user_id){
            $cls = new Dbconnect();
            $pdo = $cls->dbConnect();
            $sql = "SELECT * FROM carts AS c LEFT OUTER JOIN items AS i 
                             ON c.item_id = i.item_id 
                    WHERE c.user_id = ? AND registration_status = true";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1,$user_id,PDO::PARAM_STR);
            $ps->execute();
            $cartData = $ps->fetchAll();

            return $cartData;
        }

        function getUserItemId(){
            $cls = new Dbconnect();
            $pdo = $cls->dbConnect();
            $sql = "SELECT * FROM carts;";
            $iddata = $pdo->query($sql);
            return $iddata;
        }

        function getQuantity($cart_id){
            $cls = new Dbconnect();
            $pdo = $cls->dbConnect();
            $sql = "SELECT quantity FROM carts WHERE cart_id = ?;";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1,$cart_id,PDO::PARAM_STR);
            $ps->execute();
            $quantity = $ps->fetchAll();
            return $quantity;
        }
    }
?>

