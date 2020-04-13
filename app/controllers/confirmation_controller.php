<?php

    class confirmationController {
        private $database;
        
        public function __construct() {
            $this->database = new db();  
        }

        function __destruct() {
            $this->database->close();
        }

        public function show() {
            if (isset($_GET['token'])) {

                if(!validateToken($_GET['token'])) {
                    $_REQUEST['content'] = 'Token invalido.';
                    viewPage('confirmation');
                    exit;
                }

                $payload = getPayload($_GET['token']);

                if($payload->type !=='email') { 
                    $_REQUEST['content'] = 'Token invalido.';
                    viewPage('confirmation');
                    exit;
                }

                $id = $payload->id;

                $sql = "SELECT provider, status FROM pradepois_user WHERE id=$id";
                $return = $this->database->query($sql);

                if($return ==='EMPTY') {
                    $_REQUEST['content'] = 'Usuário não existe.';
                    viewPage('confirmation');
                    exit;
                }

                if(!$return[0]['provider']) {
                    $_REQUEST['content'] = 'Token invalido.';
                    viewPage('confirmation');
                    exit;
                }

                if($return[0]['status'] !== status::CONFIRMATION) {
                    $_REQUEST['content'] = 'Usuário já foi confirmado.';
                    viewPage('confirmation');
                    exit;
                }

                $status = status::ACTIVE;

                $sql = "UPDATE pradepois_user SET status='$status' WHERE id=$id";
                $return = $this->database->query($sql);

                if($return !== 'SUCCESS'){
                    $_REQUEST['content'] = 'Erro ao confirmar seu usuário. Tente mais tarde novamente.';
                    viewPage('confirmation');
                    exit;
                }

                $_REQUEST['content'] = 'Seu usuário foi confirmado.';
                viewPage('confirmation');



            
            //header("Location: dashboard");
            } else {
                viewPage('confirmation');
            }
        }

    }