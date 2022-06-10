<?php
include_once('../classes/static_methods_class.php');
Static_methods::validate();
include("../classes/orders_db_class.php");
if(isset($_POST["order_id"]) and !empty($_POST["order_id"]) && isset($_POST["data"])){
  $order_id = $_POST["order_id"];
  $data = $_POST["data"];
  $value = "0";
  if($data === "1"){
    $value = "1";
  }
  $order_db = new Order_db();
  $result = $order_db->check_order($order_id,$value);
  echo json_encode($result);

}else if(isset($_POST["order_id"]) and !empty($_POST["order_id"])){
  $order_id = $_POST["order_id"];
  $order_db = new Order_db();
  $result = $order_db->delete_order($order_id);
  echo json_encode($result);
}

?>
