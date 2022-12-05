<?php
    require_once 'Dbconnect.php';
    require_once 'UserInfo.php';
    class UserSelect{
        function userselect($mail, $pass){
            $cls = new Dbconnect();
            $pdo = $cls->dbConnect();
            $sql = "SELECT * FROM users WHERE mail_address = ?;";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1,$mail,PDO::PARAM_STR);
            $ps->execute();
            $userData = $ps->fetchAll();
            foreach($userData as $row){  
                if(password_verify($pass, $row['password']) == true){
                    $_SESSION['user'] = serialize(new UserInfo($row['user_name'], $row['user_id'], $row['point']));
                    return true;
                }else{
                    return false;
                }
            }
        }
    }
?>
