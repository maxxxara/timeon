<?php
  include_once('../classes/static_methods_class.php');
  Static_methods::validate();
  include("../classes/products_db_class.php");

  if(isset($_POST["product_id"]) && !empty($_POST["product_id"])){
    $product_id = $_POST["product_id"];
    $product_db = new Product_db();
    $result = $product_db->delete_product($product_id);
    echo json_encode($result);
  }
?>
