<?php
  include("../classes/product_db_class.php");
  if(isset($_POST["pr_id"]) && isset($_POST["text"]) && !empty($_POST["pr_id"]) && !empty($_POST["text"])){

    $product_link = $_POST["pr_id"];
    $text = $_POST["text"];
    $product_db = new Product_db();
    $result = $product_db->search_product($product_link,$text);
    echo json_encode($result);
  }
?>
