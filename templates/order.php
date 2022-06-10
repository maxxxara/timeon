<?php

  include("../classes/order_db_class.php");
  if(isset($_POST["name_surname"]) && isset($_POST["phone"]) && isset($_POST["checkbox"]) && isset($_POST["pr_id"]) &&
      !empty($_POST["name_surname"]) && !empty($_POST["phone"]) && !empty($_POST["pr_id"])){

    $name_surname = $_POST["name_surname"];
    $phone = $_POST["phone"];
    $checkbox = $_POST["checkbox"];
    $product_link = $_POST["pr_id"];
    if(mb_strlen($name_surname)<4){
      echo json_encode(["status"=>false,"message"=>"Name Surname too short"]);
      return;
    }else if(mb_strlen($name_surname)>60){
      echo json_encode(["status"=>false,"message"=>"Name Surname too long"]);
      return;
    }
    if(mb_strlen($phone)<6 || mb_strlen($phone)>12 ||
      !preg_match("/^[0-9.-]+$/i", $phone)){
      echo json_encode(["status"=>false,"message"=>"Incorrect phone number"]);
      return;
    }
    if($checkbox != "true"){
      echo json_encode(["status"=>false,"message"=>"Incorrect checkbox"]);
      return;
    }
    $order_db = new Order_db();
    $insert_data = $order_db->create_order([
      "product_link"=>$product_link,
      "name_surname"=>$name_surname,
      "phone"=>$phone,
      "ip_address"=>$_SERVER['REMOTE_ADDR'],
    ]);

    echo json_encode($insert_data);

   }


?>
