<?php
    require_once '../php/Dbconnect.php';

    $cls = new Dbconnect();
    $pdo = $cls->dbConnect();
    $sql = 'INSERT INTO users(user_name, mail_address, password, address, point) VALUES (?,?,?,?,0);';

    $ps = $pdo->prepare($sql);
    $ps->bindValue(1, $_POST['name'], PDO::PARAM_STR);
    $ps->bindValue(2, $_POST['mail'], PDO::PARAM_STR);
    $ps->bindValue(3, password_hash($_POST['password'], PASSWORD_DEFAULT), PDO::PARAM_STR);
    $ps->bindValue(4, $_POST['address'], PDO::PARAM_STR);
    $ps->execute();
?>
