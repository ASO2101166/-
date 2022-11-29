<?php
    session_start();
    require_once 'SessionCheck.php';
    require_once 'UserSelect.php';

    $ClsSessionCheck = new SessionCheck();
    $ClsUserSelect = new UserSelect();
    if($ClsSessionCheck->sessioncheck() == true){
        header('Location: ItemList.php');
    }else{
        if($ClsUserSelect->userselect($_POST['mail'], $_POST['password'])){
            header('Location: ItemList.php');
        }else{
            echo '違います';
        }
    }
?>
