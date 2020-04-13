<?php
    class usernameController {

        public function __construct() {
            //checkSession();
            sessionStart ();
            $this->database = new db();  
        }

        function __destruct() {
            $this->database->close();
        }

        public function select() {
            postAccess();

            $username = checkField($this->database->conn(), $_POST['username']);
            $sql = "SELECT id_user FROM pradepois_profile WHERE username='$username'";
            $return = $this->database->query($sql);

            if(isset($return[0]['id_user'])){
                if($return[0]['id_user'] === getId()) $return = 'EMPTY';
            }

            returnValue('result', $return);
        }
    }