<?php
    class serviceController {

        public function __construct() {
            checkSession();
            $this->database = new db();  
        }

        function __destruct() {
            $this->database->close();
        }

        public function add() {
            $_REQUEST['content'] = Array ('id'=>'','page'=>'service/insert','service'=>'', 'description'=>'', 'value'=>'');
            viewPage('service');
        }

        public function edit($arg) {
            $id_user = getId();
            $sql = "SELECT service, description, value FROM pradepois_service WHERE id=$arg AND id_user=$id_user";
            $return = $this->database->query($sql);

            if($return==='EMPTY'){
                viewPage('401');
            } else {
                $value = decimalReal($return[0]['value']);
                $_REQUEST['content'] = Array ('id'=>$arg,'page'=>'service/update','service'=>$return[0]['service'], 'description'=>$return[0]['description'], 'value'=>$value);
                viewPage('service');
            }
        }

        public function insert(){
            postAccess();

            $id_user = getId();
            $service = checkField($this->database->conn(), $_POST['service']);
            $description = checkField($this->database->conn(), $_POST['description']);
            $value = checkField($this->database->conn(), $_POST['value']);
            $value = realDecimal($value);
            $status = status::ACTIVE;

            if(!$id_user) {
                returnValue('result','ERROR');
                exit;
            }

            $sql = "INSERT INTO pradepois_service (id_user, service, description, value, status) ".
            "VALUES ($id_user, '$service', '$description', $value, $status)";

            $return = $this->database->query($sql);
            
            if($return === 'SUCCESS') {
                returnValue('result', $return);
            } else {
                returnValue('result', 'ERROR');
            }
        }

        public function update(){
            postAccess();

            $id = checkField($this->database->conn(), $_POST['id']);
            $id_user = getId();
            $service = checkField($this->database->conn(), $_POST['service']);
            $description = checkField($this->database->conn(), $_POST['description']);
            $value = checkField($this->database->conn(), $_POST['value']);
            $value = realDecimal($value);

            if(!$id_user) {
                returnValue('result','ERROR');
                exit;
            }

            $sql = "UPDATE pradepois_service SET service='$service',description='$description',value=$value WHERE id=$id AND id_user=$id_user";
            $return = $this->database->query($sql);

            if($return === 'SUCCESS') {
                returnValue('result', $return);
            } else {
                returnValue('result', 'ERROR');
            }
        }

        public function delete(){
            postAccess();

            $id = checkField($this->database->conn(), $_POST['id']);
            $id_user = getId();

            $sql = "UPDATE pradepois_service SET status=4 WHERE id=$id AND id_user=$id_user";
            $return = $this->database->query($sql);

            if($return === 'SUCCESS') {
                returnValue('result', $return);
            } else {
                returnValue('result', 'ERROR');
            }
        }

    }