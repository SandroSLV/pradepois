<?php

    class paymentController {
        private $database;
        
        public function __construct() {
            sessionStart ();
            $this->database = new db();  
        }

        function __destruct() {
            $this->database->close();
        }

        function show() {

            $params=['email'=>'luiz.alessandro@mirity.com', 'token'=>'75BEA2B686C14BBD9F06539E0E41A6D3'];
            $defaults = array(
                CURLOPT_URL => 'https://ws.sandbox.pagseguro.uol.com.br',
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $params,
            );
            $ch = curl_init();
            curl_setopt_array($ch, ($defaults));


        }
    }