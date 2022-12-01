<?php
    require_once 'Dbconnect.php';
    class GenreSelect{
        function genreselectlevel1(){
            $cls = new Dbconnect();
            $pdo = $cls->dbConnect();
            $sql = "SELECT * FROM genres WHERE genre_level = 1;";
            $genreData = $pdo->query($sql);
            return $genreData;
        }
        // function genreselect(){
        //     $cls = new Dbconnect();
        //     $pdo = $cls->dbConnect();
        //     $sql = "SELECT * FROM genres AS P INNER JOIN genres AS C
        //             WHERE ;";
        //     $ps = $pdo->prepare($sql);
        //     $ps->bindValue(1,$mail,PDO::PARAM_STR);
        //     $ps->execute();
        //     $genreData = $ps->fetchAll();
        //     return $genreData;
        // }
    }
?>