<?php
   
    class pagseguroController {

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

            $sql = "SELECT authorization_code FROM pradepois_pagseguro WHERE id_user=$id_user";
            $return = $this->database->query($sql);
            
            if($return !== 'EMPTY'){
                $_REQUEST['content'] = true;
            };

            viewPage('pagseguro');
        }

        public function authorization(){
            postAccess();

            $id_user = getId();

            $reference = setUniqueId('a', $id_user);

            $curl = curl_init();

            $xml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
            <authorizationRequest>
                <reference>'.$reference.'</reference>
                <permissions>
                    <code>CREATE_CHECKOUTS</code>
                    <code>RECEIVE_TRANSACTION_NOTIFICATIONS</code>
                    <code>SEARCH_TRANSACTIONS</code>
                    <code>MANAGE_PAYMENT_PRE_APPROVALS</code>
                    <code>DIRECT_PAYMENT</code>
                </permissions>
                <redirectURL>https://pradepois.com.br/app/pagseguro</redirectURL>
                <notificationURL>https://pradepois.com.br/app/pagseguro/notification</notificationURL>
            </authorizationRequest>';

            $xml = str_replace("\n",'',$xml);
            $xml = str_replace("\r",'',$xml);
            $xml = str_replace("\t",'',$xml);
            
            curl_setopt_array($curl, array(
              CURLOPT_URL => PS_URL."/v2/authorizations/request/?appId=".PS_APPID."&appKey=".PS_APPKEY,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS =>$xml,
              CURLOPT_HTTPHEADER => array("Content-Type: application/xml"),
            ));
            
            $response = curl_exec($curl);

            if($response == 'Unauthorized'){
                 echo 'Unauthorized';
                 exit;
             }
            
            curl_close($curl);

            $response = simplexml_load_string($response);

            if(count($response -> error) > 0){
                print_r($response -> error).'<br>';
                exit;
            }

            $code = $response->code;

            header('Location: https://sandbox.pagseguro.uol.com.br/v2/authorization/request.jhtml?code='.$code);
        }

        public function redirect(){
            viewPage('redirect');
        }

        public function notification(){
            postAccess();

            $notificationCode = preg_replace('/[^[:alnum:]-]/','',$_POST["notificationCode"]);
            $notificationType = preg_replace('/[^[:alnum:]-]/','',$_POST["notificationType"]);

            $notificationCode = str_replace("-",'',$notificationCode);
            
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => PS_URL."/v2/authorizations/notifications/".$notificationCode."?appId=".PS_APPID."&appKey=".PS_APPKEY,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET",
            ));
            
            $response = curl_exec($curl);

            // RETIRAR
            $myfile = fopen($notificationCode.".txt", "w") or die("Unable to open file!");
            fwrite($myfile, $response);
            fclose($myfile);

            
            if($response == 'Unauthorized'){
                echo 'Unauthorized';
                exit;
            }

            curl_close($curl);

            $response = simplexml_load_string($response);

            if(count($response -> error) > 0){
                print_r($response -> error).'<br>';
                exit;
            }

            $reference = $response->reference;

            $id_user = getUniqueId($reference);

	        $type = substr($reference, 0, 1);


            if($type === 'a'){
		        $authorizerEmail = $response->authorizerEmail;
                $authorizationCode = $response->code;
                $date = $response->creationDate;
                $publicKey = $response->account->publicKey;
            }

            $sql = "SELECT id_user FROM pradepois_pagseguro WHERE id_user=$id_user";
            $return = $this->database->query($sql);
            
            if($return !== 'EMPTY'){
                    $sql = "UPDATE pradepois_pagseguro SET email='$authorizerEmail',authorization_code='$authorizationCode',public_key='$publicKey',authorized_at='$date' WHERE id_user=$id_user";
                    $return = $this->database->query($sql);
            } else {
                    $sql = "INSERT INTO pradepois_pagseguro(id_user, email, authorization_code, public_key, authorized_at) VALUES ($id_user,'$authorizerEmail','$authorizationCode','$publicKey','$date')";
                    $return = $this->database->query($sql);
            }
        }
    }
