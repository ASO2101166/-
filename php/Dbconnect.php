<?php
    if(!isset($_SESSION)){
        session_start();
    }
    class Dbconnect{
        public function dbConnect(){
            $pdo = new PDO('mysql:host=localhost;dbname=ecsite;charset=utf8','webuser','abccsd2');
            return $pdo;
        }
    }
?>