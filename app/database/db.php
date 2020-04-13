<?php
include "../../inc/dbinfo.inc";

class db {
    private $conn;
    public $rows;
    public $status;

    public function __construct() {
        $this->status = $this->connect();
    }

    public function conn(){
        return $this->conn;
    }

    public function connect() {
        try {
            $this->conn = mysqli_connect(
                DB_SERVER,
                DB_USERNAME,
                DB_PASSWORD,
                DB_DATABASE);
            if($this->conn) {
                mysqli_set_charset($this->conn,'utf8');
                return 'CONNECTED';
            } else {
                $this->close();
                return 'ERROR';
            }
        }
        catch (Exception $e){
            $this->close();
            return 'ERROR';
        }
    }
    
    public function close(){
        $this->conn->close();
    }

    public function query($sql){
        if($this->status!=='ERROR'){

            $result = $this->conn->query($sql);

            if (!$result) {
                return 'ERROR';
                exit;
            }

            if(isset($result->num_rows)){
                $rows = array();

                while($r = mysqli_fetch_assoc($result)) {
                    $rows[] = $r;
                }
                $this->rows = $result->num_rows;
                if ($this->rows > 0) {
                    return $rows;
                } else {
                    return 'EMPTY';
                }

            } else {
                if ($result === TRUE) {
                    return 'SUCCESS';
                } else {
                    if($this->conn->errno=='1062') 
                        return 'DUPLICATE';
                    else
                        return $this->conn->error;
                }
            }
            mysqli_free_result($result);
            $this->close();
        } else {
            return $this->status;
        }
    }

    public function lastid() {
        return $this->conn->insert_id;
    }
}
?>