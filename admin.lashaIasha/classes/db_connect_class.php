<?php

class Db_connect{
   private $host = "localhost";
    private $username = "timeonge_root";
    private $password = ".Yt},oZ6uh0d";
    private $database = "timeonge_main";
    
    protected $conn;

    function __construct(){
          $conn = new mysqli($this->host, $this->username,
                  $this->password,$this->database);
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }
          $conn->set_charset("utf8mb4");
          $this->conn = $conn;
      }
    protected function escape_string($text){
      return $this->conn->real_escape_string($text);
    }

    function __destruct(){
      mysqli_close($this->conn);
    }


}




?>
