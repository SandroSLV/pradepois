<?php
    class dashboardController {

        public function __construct() {
            checkSession();
            checkProfile();
            $this->database = new db();  
        }

        function __destruct() {
            $this->database->close();
        }
        
        public function show() {
            $id_user = getId();
            $status = status::ACTIVE;

            $sql = "SELECT id, service, value FROM pradepois_service WHERE id_user=$id_user AND status=$status";
            $return = $this->database->query($sql);

            if(isset($return[0]['id'])){
                $_REQUEST['content'] = $return;
            } else {
                $_REQUEST['content'] = '';
            }
            
            viewPage('dashboard');
        }

    }