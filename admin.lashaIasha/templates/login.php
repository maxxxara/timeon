<?php
include_once('../classes/user_database_class.php');

if($_SERVER['REQUEST_METHOD'] == "POST"){
  if (isset($_POST["username"]) && isset($_POST["password"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $login = new Users_database();
    $data = $login->user_login($username,$password);

    if($data["status"] === true){
      session_start();
      $_SESSION["id"] = $data["data"]["id"];
      $_SESSION["username"] = $data["data"]["username"];
      $_SESSION["status"] = true;
    }
    echo json_encode($data);
  }else{
    header("location: ./index.php");
  }
}else{
  header("location: ./index.php");
}
//  session_destroy();
