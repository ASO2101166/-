<?php
    class SessionCheck{
        function sessioncheck(){
            if(isset($_SESSION['user']) == true){
                return true;
            }else{
                return false;
            }
        }
    }
?>
