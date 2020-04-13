<?php

    class registerController {
        private $database;
        
        public function __construct() {
            sessionStart ();
            $this->database = new db();  
        }

        function __destruct() {
            $this->database->close();
        }
    
        public function show() {
            viewPage('register');
        }

        public function insert() {
            postAccess();

            $email = checkField($this->database->conn(), $_POST['email']);
            $provider = checkField($this->database->conn(), $_POST['provider']);
            $password = checkField($this->database->conn(), $_POST['password']);
            $password = sha1($password);
            
            $status = status::ACTIVE;

            $sql = "INSERT INTO pradepois_user(email, password, provider, status) VALUES ('$email', '$password', $provider, '$status')";

            $return = $this->database->query($sql);

            $id_user = $this->database->lastid();

            if($id_user===''){
                returnValue('result','ERROR');
                exit;
            }
            
            
            $category = checkField($this->database->conn(), $_POST['category']);
            $name = checkField($this->database->conn(), $_POST['name']);
            $company = checkField($this->database->conn(), $_POST['company']);
            $username = checkField($this->database->conn(), $_POST['username']);
            $cnpj = checkField($this->database->conn(), $_POST['cnpj']);
            $phone = checkField($this->database->conn(), $_POST['phone']);
            $zipcode = checkField($this->database->conn(), $_POST['zipcode']);
            $address = checkField($this->database->conn(), $_POST['address']);
            $number = checkField($this->database->conn(), $_POST['number']);
            $complement = checkField($this->database->conn(), $_POST['complement']);
            $district = checkField($this->database->conn(), $_POST['district']);
            $state = checkField($this->database->conn(), $_POST['state']);
            $city = checkField($this->database->conn(), $_POST['city']);

            $cnpj = preg_replace("/[^0-9]/", "",$cnpj);
            $phone = preg_replace("/[^0-9]/", "",$phone);
            $zipcode = preg_replace("/[^0-9]/", "",$zipcode);

            $sql = "INSERT INTO pradepois_profile(id_user, category, company, name, cnpj, phone, username, zipcode, address, number, complement, district, state, city) ".
            "VALUES ($id_user,'$category', '$company','$name', '$cnpj', '$phone', '$username', $zipcode, '$address', '$number', '$complement', '$district', '$state', '$city')";

            $return = $this->database->query($sql);
            
            if($return !== 'SUCCESS') {
                returnValue('result', 'ERROR');
                exit;
            } 
            $_SESSION['token'] = createToken($id_user, 'login', $provider);
            returnValue('result', $return);
        }

        public function checkout() {
            $id_user = getId();

            if(!$id_user){
                $_REQUEST['content'] = Array ('id'=>'','page'=>'checkout/insert','name'=>'', 'cpf'=>'', 'zipcode'=>'', 'address'=>'', 'number'=>'','complement'=>'','district'=>'','state'=>'', 'city'=>'');
            } else {
                $sql = "SELECT name, cpf, zipcode, address, number, complement, district, state, city FROM pradepois_profile WHERE id_user=$id_user";
                $return = $this->database->query($sql);

                if($return==='EMPTY'){
                    $_REQUEST['content'] = Array ('name'=>'', 'cpf'=>'', 'zipcode'=>'', 'address'=>'', 'number'=>'','complement'=>'','district'=>'','state'=>'', 'city'=>'');
                } else {
                    $_REQUEST['content'] = $return[0];
                }
                $_REQUEST['content']['page'] = 'checkout/update';
            }

            viewPage('register_checkout');
        }
    }