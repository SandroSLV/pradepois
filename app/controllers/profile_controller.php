<?php
    class profileController {

        public function __construct() {
            checkSession();
            $this->database = new db();  
        }

        function __destruct() {
            $this->database->close();
        }
        
        public function add() {
            $_REQUEST['content'] = Array ('page'=>'profile/insert','category'=>'', 'name'=>'', 'username'=>'', 'company'=>'', 'cnpj'=>'', 'zipcode'=>'', 'address'=>'', 'number'=>'','complement'=>'','district'=>'','state'=>'', 'city'=>'');
            viewPage('profile');
        }


        public function edit() {
            $id = getId();
            $sql = "SELECT category, name, phone, username, company, cnpj, zipcode, address, number, complement, district, state, city FROM pradepois_profile WHERE id_user=$id";
            $return = $this->database->query($sql);

            if($return==='EMPTY'){
                $_REQUEST['content'] = Array ('phone'=>'', 'category'=>'', 'name'=>'', 'username'=>'', 'company'=>'', 'cnpj'=>'', 'zipcode'=>'', 'address'=>'', 'number'=>'','complement'=>'','district'=>'','state'=>'', 'city'=>'');
            } else {
                $_REQUEST['content'] = $return[0];
            }
            $_REQUEST['content']['page'] = 'profile/update';
            viewPage('profile');
        }

        public function insert(){
            postAccess();

            $id_user = getId();
            $category = checkField($this->database->conn(), $_POST['category']);
            $name = checkField($this->database->conn(), $_POST['name']);
            $username = checkField($this->database->conn(), $_POST['username']);
            $company = checkField($this->database->conn(), $_POST['company']);
            $cnpj = checkField($this->database->conn(), $_POST['cnpj']);
            $zipcode = checkField($this->database->conn(), $_POST['zipcode']);
            $address = checkField($this->database->conn(), $_POST['address']);
            $number = checkField($this->database->conn(), $_POST['number']);
            $complement = checkField($this->database->conn(), $_POST['complement']);
            $district = checkField($this->database->conn(), $_POST['district']);
            $state = checkField($this->database->conn(), $_POST['state']);
            $city = checkField($this->database->conn(), $_POST['city']);

            $cnpj = preg_replace("/[^0-9]/", "",$cnpj);

            $username = preg_replace('/\s/', '', $username);
            $username = preg_replace('/[^a-z0-9]/i', '', $username);
            $username = strtolower($username);

            if(!$id_user) {
                returnValue('result','ERROR');
                exit;
            }

            $sql = "INSERT INTO pradepois_profile(id_user, category, name, username, company, cnpj, zipcode, address, number, complement, district, state, city) ".
            "VALUES ($id_user, $category, '$name', '$username', '$company', '$cnpj', $zipcode, '$address', '$number', '$complement', '$district', '$state', '$city')";

            $return = $this->database->query($sql);
            
            if($return === 'SUCCESS') {
                $_SESSION['token'] = createToken($id_user, 'login');
                returnValue('result', $return);
            } else {
                returnValue('result', 'ERROR');
            }
        }

        public function update(){
            postAccess();

            $id_user = getId();
            $password = checkField($this->database->conn(), $_POST['password']);
            $category = checkField($this->database->conn(), $_POST['category']);
            $name = checkField($this->database->conn(), $_POST['name']);
            $phone = checkField($this->database->conn(), $_POST['phone']);
            $username = checkField($this->database->conn(), $_POST['username']);
            $company = checkField($this->database->conn(), $_POST['company']);
            $cnpj = checkField($this->database->conn(), $_POST['cnpj']);
            $zipcode = checkField($this->database->conn(), $_POST['zipcode']);
            $address = checkField($this->database->conn(), $_POST['address']);
            $number = checkField($this->database->conn(), $_POST['number']);
            $complement = checkField($this->database->conn(), $_POST['complement']);
            $district = checkField($this->database->conn(), $_POST['district']);
            $state = checkField($this->database->conn(), $_POST['state']);
            $city = checkField($this->database->conn(), $_POST['city']);

            if($password!==''){
                $password = sha1($password);
                $sql = "UPDATE pradepois_user SET password='$password' WHERE id=$id_user";
                $return = $this->database->query($sql);
                if($return !== 'SUCCESS') {
                    returnValue('result', 'ERROR 1');
                    exit;
                }
            }
            

            $username = preg_replace('/\s/', '', $username);
            $username = preg_replace('/[^a-z0-9]/i', '', $username);
            $username = strtolower($username);

            $sql = "UPDATE pradepois_profile SET category='$category',name='$name',phone='$phone',username='$username',company='$company',cnpj=$cnpj,zipcode=$zipcode,address='$address',number='$number',complement='$complement',district='$district',state='$state',city='$city' WHERE id_user=$id_user";
            $return = $this->database->query($sql);

            if($return === 'SUCCESS') {
                returnValue('result', $return);
            } else {
                returnValue('result', 'ERROR');
            }
        }
    }