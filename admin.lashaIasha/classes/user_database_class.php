<?php
include_once('db_connect_class.php');

class Users_database extends Db_connect{
  function __construct(){
    parent::__construct();
  }
  public function user_login($username,$password){
    $username = $this->escape_string($username);
    $password = hash("sha512",$password);
    $sql_command = "SELECT id,user FROM admin WHERE user='$username' and password='$password';";
    $query = $this->conn->query($sql_command);
    if($query){
      if($query->num_rows == 1){
        $data = $query->fetch_assoc();
        return ["status"=>true,"data"=>["id"=>$data["id"],"username"=>$data["user"]]];
      }
      return ["status"=>false,"message"=>"Username or password is inorrect"];
    }
    return ["status"=>false,"message"=>"Something went wrong"];

  }
}

?>
