<?php
    if(!isset($_SESSION)){
        session_start();
    }
    require_once 'Dbconnect.php';
    class ItemSetSelect{
        function itemsetselect($setdiscountdivision, $item_id){
            $cls = new Dbconnect();
            $pdo = $cls->dbConnect();
            $sql = "SELECT * FROM items WHERE set_discount_division = ? AND NOT item_id = ?;";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1,$setdiscountdivision,PDO::PARAM_STR);
            $ps->bindValue(2,$item_id,PDO::PARAM_STR);
            $ps->execute();
            $itemData = $ps->fetchAll();
            return $itemData;
        }
    }
?>