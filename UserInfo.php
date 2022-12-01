<?php
    class UserInfo{
        public $username;
        public $user_id;
        function __construct($username, $user_id){
            $this->username = $username;
            $this->user_id = $user_id;
        }
    }
?>
