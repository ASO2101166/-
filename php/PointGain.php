<?php
    if(!isset($_SESSION)){
        session_start();
    }
    require_once 'UserInfo.php';
    require_once 'Dbconnect.php';
    class PointGain{
        static function userpointgain($point, $user_id){
            $cls = new Dbconnect();
            $pdo = $cls->dbConnect();
            $user = unserialize($_SESSION['user']);

            $sql = "UPDATE users SET point = point + ? WHERE user_id = ?";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1,$point,PDO::PARAM_INT);
            $ps->bindValue(2,$user_id,PDO::PARAM_INT);
            $ps->execute();
            $_SESSION['user'] = serialize(new UserInfo($user->username,$user->user_id, $user->point + $point));
        }
    }
?>