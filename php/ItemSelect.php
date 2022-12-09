<?php
    if(!isset($_SESSION)){
        session_start();
    }
    require_once 'Dbconnect.php';
    class ItemSelect{
        function itemselect(){
            $cls = new Dbconnect();
            $pdo = $cls->dbConnect();
            $sql = "SELECT * FROM items LIMIT 9;";
            $itemData = $pdo->query($sql);
            // $ps = $pdo->prepare($sql);
            // $ps->bindValue(1,$mail,PDO::PARAM_STR);
            // $ps->execute();
            // $userData = $ps->fetchAll();
            return $itemData;
        }

        function itemselectBygenre($genre_code){
            $cls = new Dbconnect();
            $pdo = $cls->dbConnect();
            $sql = "SELECT * FROM items WHERE genre_code = ? LIMIT 9;";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1,$genre_code,PDO::PARAM_STR);
            $ps->execute();
            $itemData = $ps->fetchAll();
            return $itemData;
        }
    }
?>