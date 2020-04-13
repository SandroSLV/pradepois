<?php
    class loginController {
        private $database;

        public function __construct() {
            sessionStart ();
            $this->database = new db();
        }

        function __destruct() {
            $this->database->close();
        }
        
        public function show() {
            if (isset($_SESSION['token'])) {
                if (validateToken($_SESSION['token'])){
                    header("Location: dashboard");
                } else {
                    viewPage('401');
                }
            } else {
                viewPage('login');
            }
        }

        public function checkout() {
            if (isset($_SESSION['token'])) {
                if (validateToken($_SESSION['token'])){
                    header("Location: ".path::ROOT.$content['page']."register/checkout");
                } else {
                    viewPage('401');
                }
            } else {
                viewPage('login_checkout');
            }
        }


        public function validate(){
            postAccess();
            if(empty($_POST['email']) OR empty($_POST['password'])){
                returnValue('error', 'Todos os campos devem ser preenchidos.');
            }
            
            $email = checkField($this->database->conn(), $_POST['email']);
            $password = checkField($this->database->conn(), $_POST['password']);
            $password = sha1($_POST['password']);

            $sql = "SELECT id, provider, status FROM pradepois_user WHERE email='$email' AND password='$password';";
            $return = $this->database->query($sql);

            if(isset($return[0]['id'])){
                $id = $return[0]['id'];
                $provider = $return[0]['provider'];
                $status = $return[0]['status'];

                switch ($status) {
                    case status::ACTIVE:
                        $sql = "SELECT id FROM pradepois_profile WHERE id_user=$id;";
                        $return = $this->database->query($sql);
                        if($return==='EMPTY') {
                            $_SESSION['token'] = createToken($id, 'profile', $provider);
                            $return = 'PROFILE';
                        } else {
                            $_SESSION['token'] = createToken($id, 'login', $provider);
                        }
                        break;
                    case status::INACTIVE:
                        $return = 'INACTIVE';
                        break;
                    case status::SUSPENDED:
                        $return = 'SUSPENDED';
                        break;
                    case status::CONFIRMATION:
                        $token = createToken($id, 'email', $provider);
                        $return = 'CONFIRMATION';
                        break;
                    case status::DELETED:
                        $return = 'DELETED';
                        break;
                    default: 
                        $return = 'UNDEFINED';
                        break;
                }
            }
            returnValue('result', $return);
        }
    }