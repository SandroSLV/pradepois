<?php
   function viewPage($page){
       include 'views/header.php';
       include 'views/'.$page.'_view.php';
       include 'views/footer.php';
   };

   function setUniqueId($type = 's', $id){
        $now = date('Ymdhis');
        $uniqueId = $type.dechex($now).dechex($id);
        return $uniqueId;
   }

    function getUniqueId($uniqueId){
        $id = hexdec(substr($uniqueId, 13));
        return $id;
    }

    function msgReturn($type, $message){
        return array('type' => $type, 'message' => $message);
    }

    function returnValue($type, $message){
        $msg = array('type' => $type, 'message' => $message);
        $json = json_encode($msg , JSON_PRETTY_PRINT);
        header('Content-Type: application/json');
        echo $json;
        exit;
    }
    
    function checkSession(){
        if (!isset($_SESSION)){
            sessionStart ();
        }

        if (!isset($_SESSION['token'])) {
            session_destroy();
            header("Location: ".path::ROOT."login"); 
        } 
    }

    function createToken($id, $type, $provider) {
        $date = date("Y-m-d");

        $header = [
            'alg' => 'HS256',
            'typ' => 'JWT'
        ];

        $header = json_encode($header);
        $header = base64_encode($header);
         
        $payload = [
            'id' => $id,
            'type' => $type,
            'provider' => $provider,
            'create_at' => $date
        ];

        $payload = json_encode($payload);
        $payload = base64_encode($payload);
         
        $signature = hash_hmac('sha256',"$header.$payload",'91ee575f07b4acd6f52df027b90135b283fca23e',true);
        $signature = base64_encode($signature);
         
        return "$header.$payload.$signature";
    }

    function validateToken($token) {
        $token = trim($token);
        $token = str_replace(" ", "+", $token);

        $part = explode(".",$token);
        $header = $part[0];
        $payload = $part[1];
        $signature = $part[2];

        $valid = hash_hmac('sha256',"$header.$payload",'91ee575f07b4acd6f52df027b90135b283fca23e',true);
        $valid = base64_encode($valid);

        if($signature === $valid){
            return true;
        }else{
            return false;
        }
    }

    function getId(){
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : 'n.n.n';
        if(!validateToken($token)) {
           return false;
        }
        $payload = getPayload($_SESSION['token']);
        return $payload->id;
    }

    function getPayload($token) {
        $part = explode(".",$token);
        $payload = $part[1];
        $payload = base64_decode($payload);
        $payload = json_decode($payload);
        return $payload;
    }

    function sessionStart (){
        session_name(sha1('3785e2651d4bdb20edf05e786d72bf7b6b4aa3ac'.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']));
        session_start();
    }

    function postAccess(){
        if(empty($_POST)){
            pageUnauthorized();
        }
    }

    function pageNotFound(){
        http_response_code(404);
        returnValue('error', 'Pagina nao encontrada.');
        exit;
    }

    function pageUnauthorized(){
        http_response_code(401);
        returnValue('error', 'Acesso negado.');
        exit;
    }

    function checkField($conn, $field){
        return mysqli_real_escape_string($conn,$field);
    }

    function checkProfile(){
        $payload = getPayload($_SESSION['token']);
        if($payload->type==='profile'){
            header("Location: profile/add"); 
        }
        
    }

    function decimalReal($number){
        $number = number_format($number, 2, ',', '.');
        return $number;
    }

    function realDecimal($number){
        $number = str_replace(".", "",$number);
        $number = str_replace(",", ".",$number);
        $number = number_format($number, 2, '.', '');
        return $number;
    }