<?php
    if(!isset($_SESSION)){
        session_start();
    }
    require_once 'Dbconnect.php';
    class GenreSelect{
        function genreselectlevel1(){
            $cls = new Dbconnect();
            $pdo = $cls->dbConnect();
            $sql = "SELECT * FROM genres WHERE genre_level = 2;";
            $genreData = $pdo->query($sql);
            return $genreData;
        }

        function genreselectlevel2($parent_genre_code){
            $cls = new Dbconnect();
            $pdo = $cls->dbConnect();
            $sql = "SELECT * FROM genres WHERE parent_genre_code = ?;";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1,$parent_genre_code,PDO::PARAM_STR);
            $ps->execute();
            $genreData = $ps->fetchAll();
            return $genreData;
        }
    }
?>