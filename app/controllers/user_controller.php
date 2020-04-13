<?php

    class userController {
        private $database;
        
        public function __construct() {
            $this->database = new db();  
        }

        function __destruct() {
            $this->database->close();
        }

        public function insert() {
            postAccess();

            $email = checkField($this->database->conn(), $_POST['email']);
            $provider = checkField($this->database->conn(), $_POST['provider']);
            $password = checkField($this->database->conn(), $_POST['password']);
            $password = sha1($password);
            
            $status = $provider === 'true' ? status::CONFIRMATION : status::ACTIVE;

            $sql = "INSERT INTO pradepois_user(email, password, provider, status) VALUES ('$email', '$password', $provider, '$status')";

            $return = $this->database->query($sql); 

            returnValue('result', $return);
        }

        public function select() {
            postAccess();

            $sql = "SELECT * FROM pradepois_user";
            $return = $this->database->query($sql);
            returnValue('result', $return);
        }

        public function update() {

        }

        public function delete() {

        }
    }
    