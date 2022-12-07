<?php
    if(!isset($_SESSION)){
        session_start();
    }
    require_once 'SessionCheck.php';
    require_once 'UserSelect.php';

    $ClsSessionCheck = new SessionCheck();
    $ClsUserSelect = new UserSelect();
    if($ClsSessionCheck->sessioncheck() == true){
        header('Location: ../ItemList.html');
        exit();
    }else{
        if($ClsUserSelect->userselect($_POST['mail'], $_POST['password'])){
            header('Location: ../ItemList.html');
            exit();
        }else{
            header('Location: ../Login.html?error');
            exit();
        }
    }
?>
