<?php
    if(!isset($_SESSION)){
        session_start();
    }
    class UserInfo{
        public $username;
        public $user_id;
        public $point;
        function __construct($username, $user_id, $point){
            $this->username = $username;
            $this->user_id = $user_id;
            $this->point = $point;
        }
    }
?>
