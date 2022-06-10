<?php
  include_once('../classes/static_methods_class.php');
  Static_methods::validate();
  include("../classes/reviews_db_class.php");
  if(isset($_POST["review_id"]) && !empty($_POST["review_id"])){
      $product_db = new Review_db();
      $review_id = $_POST["review_id"];
      $result = $product_db->delete_review($review_id);
      echo json_encode($result);
  }
?>
