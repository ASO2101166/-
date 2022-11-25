<?php
    $pdo = new PDO('mysql:host=localhost;dbname=webdb;charset=utf8','webuser','abccsd2');
    $sql=  "SELECT * FROM user_mst WHERE user_mail = ?";
    $ps= $pdo->prepare($sql);
    $ps->bindValue(1,$_POST['mail'],PDO::PARAM_STR);
    $ps->execute();
    $userData = $ps->fetchAll();
    foreach($userData as $userData){  
        if(password_verify($_POST['pass'], $userData['user_password'])  ==  true){
            echo 'ログイン成功！ようこそ'.$userData['user_name'].'さん！';
        }else{
            echo 'パスワードが一致しません';
        }
    }
    if(count($userData) == 0){
        echo 'アカウントが存在しません';
    }
?>
