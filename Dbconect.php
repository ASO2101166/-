<?php
    class Dbconect{
        public function dbConnect(){
            $pdo = new PDO('mysql:host=localhost;dbname=ecsite;charset=utf8','webuser','abccsd2');
            return $pdo;
        }
    }
?>
