<?php
    if(!isset($_SESSION)){
        session_start();
    }
    require_once 'SessionCheck.php';
    require_once 'UserSelect.php';

    $ClsSessionCheck = new SessionCheck();
    $ClsUserSelect = new UserSelect();
    if($ClsSessionCheck->usersessioncheck() == true){
        header('Location: ../ItemList.php',true, 307);
        exit();
    }else{
        if($ClsUserSelect->userselectbymailpass($_POST['mail'], $_POST['password'])){
            header('Location: ../ItemList.php',true, 307);
            exit();
        }else{
            header('Location: ../Login.php?error',true, 307);
            exit();
        }
    }
?>
