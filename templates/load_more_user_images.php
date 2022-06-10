<?php

  include("../classes/review_db_class.php");
  if(isset($_POST["pr_id"]) && isset($_POST["last_id"])
      && !empty($_POST["pr_id"])){
    $product_link = $_POST["pr_id"];
    $last_id = $_POST["last_id"];

    $review_db = new Review_db();
    $result = $review_db->load_more_user_images([
      "product_link"=>$product_link,
      "last_id"=>$last_id
    ]);
    echo json_encode($result);
    return;
    if($result["status"] === true){
      $response = [];
      foreach($result["data"] as $each){
        array_push($response,[

        ]);
      }
      echo json_encode(["status"=>true,"message"=>"Successfully loaded","data"=>$response]);
      return;
    }
    echo json_encode($result);
  }
?>
