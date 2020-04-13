<?php
    class userpageController {

        public function __construct() {
            $this->database = new db();  
        }

        function __destruct() {
            $this->database->close();
        }

        public function show($username) {
            
            $status = status::ACTIVE;

            $sql = "SELECT * FROM pradepois_vw_services WHERE username='$username' AND status=$status";
            $return = $this->database->query($sql);

            if(isset($return[0]['id'])){
                $_REQUEST['content'] = $return;
                viewPage('userpage');
            } else {
                viewPage('404');
            }
            
        }
    }