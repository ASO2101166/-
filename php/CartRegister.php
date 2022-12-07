<?php
    if(!isset($_SESSION)){
        session_start();
    }
    require_once 'Dbconnect.php';
    class CartRegister{
        function cartregister($cart_id){
            $cls = new Dbconnect();
            $pdo = $cls->dbConnect();
            $sql = "UPDATE carts SET registration_status = true WHERE cart_id = ?";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1,$cart_id,PDO::PARAM_INT);
            $ps->execute();
        }
    }
?>