<?php

    class checkoutController {
        private $database;
        
        public function __construct() {
            sessionStart ();
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

            $id_user = $this->database->lastid();

            if($id_user===''){
                returnValue('result','ERROR');
                exit;
            }

            $name = checkField($this->database->conn(), $_POST['name']);
            $cpf = checkField($this->database->conn(), $_POST['cpf']);
            $zipcode = checkField($this->database->conn(), $_POST['zipcode']);
            $address = checkField($this->database->conn(), $_POST['address']);
            $number = checkField($this->database->conn(), $_POST['number']);
            $complement = checkField($this->database->conn(), $_POST['complement']);
            $district = checkField($this->database->conn(), $_POST['district']);
            $state = checkField($this->database->conn(), $_POST['state']);
            $city = checkField($this->database->conn(), $_POST['city']);

            $cpf = preg_replace("/[^0-9]/", "",$cpf);

            $sql = "INSERT INTO pradepois_profile(id_user, name, cpf, zipcode, address, number, complement, district, state, city) ".
            "VALUES ($id_user, '$name', '$cpf', $zipcode, '$address', '$number', '$complement', '$district', '$state', '$city')";

            $return = $this->database->query($sql);
            
            if($return !== 'SUCCESS') {
                returnValue('result', 'ERROR');
                exit;
            } 
            $_SESSION['token'] = createToken($id_user, 'login', $provider);
            returnValue('result', $return);
        }
        public function update() {
            postAccess();

            $id_user = getId();

            $name = checkField($this->database->conn(), $_POST['name']);
            $cpf = checkField($this->database->conn(), $_POST['cpf']);
            $zipcode = checkField($this->database->conn(), $_POST['zipcode']);
            $address = checkField($this->database->conn(), $_POST['address']);
            $number = checkField($this->database->conn(), $_POST['number']);
            $complement = checkField($this->database->conn(), $_POST['complement']);
            $district = checkField($this->database->conn(), $_POST['district']);
            $state = checkField($this->database->conn(), $_POST['state']);
            $city = checkField($this->database->conn(), $_POST['city']);

            $cpf = preg_replace("/[^0-9]/", "",$cpf);

            $sql = "UPDATE pradepois_profile SET name='$name',cpf=$cpf,zipcode=$zipcode,address='$address',number='$number',complement='$complement',district='$district',state='$state',city='$city' WHERE id_user=$id_user";
            $return = $this->database->query($sql);

            if($return !== 'SUCCESS') {
                returnValue('result', 'ERROR');
                exit;
            } 

            returnValue('result', $return);
        }
    }