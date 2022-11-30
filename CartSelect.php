<?php
    require_once 'Dbconnect.php';
    require_once 'UserInfo.php';
    class CartSelect{
        function cartselect(){
            $user = unserialize($_SESSION['user']);
            $cls = new Dbconnect();
            $pdo = $cls->dbConnect();
            $sql = "SELECT * FROM carts AS c INNER JOIN items AS i
                    INNER JOIN users AS u WHERE u.user_id = ?;";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1,$user->user_id,PDO::PARAM_STR);
            $ps->execute();
            $cartData = $ps->fetchAll();

            return $cartData;
        }
    }
?>

