<?php
    require_once 'Dbconnect.php';
    require_once 'ItemInfo.php';
    class ItemSelect{
        function itemselect(){
            $cls = new Dbconnect();
            $pdo = $cls->dbConnect();
            $sql = "SELECT * FROM items;";
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
            $sql = "SELECT * FROM items WHERE genre_code = ?;";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1,$genre_code,PDO::PARAM_STR);
            $ps->execute();
            $itemData = $ps->fetchAll();
            return $itemData;
        }
    }
?>