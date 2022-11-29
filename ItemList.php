<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0" />
        <link rel="stylesheet" href="./css/style.css" />
        <title></title>
    </head>
    <body>
        <?php
            session_start();
            require_once 'UserInfo.php';
            $t = unserialize($_SESSION['user']);
            echo $t->username;
            echo $t->user_id;
        ?>
        <a href="Logout.php">a</a>
    </body>
</html>
