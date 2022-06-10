<?php

  include("../classes/review_db_class.php");
  if(isset($_POST["pr_id"]) && isset($_POST["last_id"])
      && !empty($_POST["pr_id"])){
    $product_link = $_POST["pr_id"];
    $last_id = $_POST["last_id"];

    $review_db = new Review_db();
    $result = $review_db->load_all_review([
      "product_link"=>$product_link,
      "last_id"=>$last_id
    ]);
    if($result["status"] === true){
      $response = [];
      foreach($result["data"] as $each){
        array_push($response,[
          "avatar"=>$each[4],
          "name"=>$each[1],
          "surname"=>$each[2],
          "comment"=>$each[3],
          "rate"=>$each[5]
        ]);
      }
      echo json_encode(["status"=>true,"message"=>"Successfully loaded","data"=>$response]);
      return;
    }
    echo json_encode($result);
  }
?>
