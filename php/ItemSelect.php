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

        function itemselectlimit(){
            $cls = new Dbconnect();
            $pdo = $cls->dbConnect();
            $sql = "
            SELECT CASE
                      WHEN Btbl.bcnt = tbl.cnt THEN true
                      ELSE false
                   END AS 'CHECK'
            FROM (SELECT COUNT(*) AS bcnt FROM items) AS Btbl,
                 (SELECT COUNT(*) AS cnt FROM (SELECT * FROM items LIMIT 9) AS lmttbl) AS tbl;
                    ";
            $itemData = $pdo->query($sql);
            return $itemData;
        }

        function itemselectlimitBygenre($genre_code){
            $cls = new Dbconnect();
            $pdo = $cls->dbConnect();
            $sql = "
            SELECT CASE
                      WHEN Btbl.bcnt = tbl.cnt THEN true
                      ELSE false
                   END AS 'CHECK'
            FROM (SELECT COUNT(*) AS bcnt FROM items WHERE genre_code = ?) AS Btbl,
                 (SELECT COUNT(*) AS cnt FROM (SELECT * FROM items WHERE genre_code = ? LIMIT 9) AS lmttbl) AS tbl;
                    ";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1,$genre_code,PDO::PARAM_STR);
            $ps->bindValue(2,$genre_code,PDO::PARAM_STR);
            $ps->execute();
            $itemData = $ps->fetchAll();
            return $itemData;
        }
    }
?>