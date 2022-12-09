<?php
    if(!isset($_SESSION)){
        session_start();
    }
    $_SESSION = array();
    header('Location: ../Login.php', true, 307);
    exit();
?>
