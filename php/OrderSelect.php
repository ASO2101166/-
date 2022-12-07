<?php
    if(!isset($_SESSION)){
        session_start();
    }
    require_once 'Dbconnect.php';
    require_once 'UserInfo.php';
    class OrderSelect{
        function orderselectbyuserid($user_id){
            $cls = new Dbconnect();
            $pdo = $cls->dbConnect();
            $sql = "SELECT * FROM orders WHERE user_id = ?";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1,$user_id,PDO::PARAM_STR);
            $ps->execute();
            $orderData = $ps->fetchAll();

            return $orderData;
        }

        function orderdetailselectbyorderid($order_id){
            $cls = new Dbconnect();
            $pdo = $cls->dbConnect();
            $sql = "SELECT * FROM orderdetails as o LEFT OUTER JOIN items as i 
                    ON o.item_id = i.item_id
                    WHERE order_id = ?;";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1,$order_id,PDO::PARAM_STR);
            $ps->execute();
            $orderdetailData = $ps->fetchAll();

            return $orderdetailData;
        }
    }
?>