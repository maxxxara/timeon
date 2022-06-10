<?php
  include_once('../classes/static_methods_class.php');
  Static_methods::validate();
  include("../classes/products_db_class.php");


  if(isset($_POST["product_link"]) && !empty($_POST["product_link"]) && isset($_POST["checking"])){
    $product_db = new Product_db();
    $product_link = $_POST["product_link"];
    $result = $product_db->check_if_exist($product_link);
    echo json_encode($result);
    exit();
  }else if(
    (isset($_POST["title"]) && isset($_POST["price"]) && isset($_POST["sale_price"]) &&
    isset($_POST["end_date"]) && isset($_POST["product_link"]) && isset($_FILES["images"]) && isset($_POST["features"]) &&
    isset($_POST["left_0"]) && isset($_POST["left_1"]) && isset($_POST["left_2"]) && isset($_POST["right_0"]) &&
    isset($_POST["right_1"]) && isset($_POST["right_2"]) && isset($_POST["guarantee"])) &&

    (!empty($_POST["title"]) && !empty($_POST["price"]) && !empty($_POST["sale_price"]) &&
    !empty($_POST["end_date"]) && !empty($_POST["product_link"]) && !empty($_FILES["images"]) && !empty($_POST["features"]) &&
    !empty($_POST["left_0"]) && !empty($_POST["left_1"]) && !empty($_POST["left_2"]) && !empty($_POST["right_0"]) &&
    !empty($_POST["right_1"]) && !empty($_POST["right_2"]) && !empty($_POST["guarantee"]))
  ){
    $in_stock = 0;
    if(isset($_POST["in_stock"])){
      $in_stock = 1;
    }
    $free_delivery = 0;
    if(isset($_POST["free_delivery"])){
      $free_delivery = 1;
    }
    if(strtotime($_POST["end_date"]) == false){
      $date = new DateTime("now", new DateTimeZone('Asia/Tbilisi'));
      $date->modify('+1 day');
      $end_date = $date->format('Y-m-d H:i:s');
    }else{
      $end_date = $_POST["end_date"];
    }

    $title = $_POST["title"];
    $price = $_POST["price"];
    $sale_price = $_POST["sale_price"];
    $product_link = $_POST["product_link"];
    $features = $_POST["features"];
    $left_0 = $_POST["left_0"];
    $left_1 = $_POST["left_1"];
    $stock = $_POST["stock"];
    $left_2 = $_POST["left_2"];
    $right_0 = $_POST["right_0"];
    $right_1 = $_POST["right_1"];
    $right_2 = $_POST["right_2"];
    $guarantee = $_POST["guarantee"];

    $image_names = [];
    if(!empty($_FILES['images']['name'][0])){
      for($i=0;$i<sizeof($_FILES["images"]["name"]);$i++){
        $image_data = Static_methods::upload_file(
          [
            "name"=>$_FILES["images"]["name"][$i],
            "type"=> $_FILES["images"]["type"][$i],
            "tmp_name"=> $_FILES["images"]["tmp_name"][$i],
            "error"=> $_FILES["images"]["error"][$i],
            "size"=> $_FILES["images"]["size"][$i]
          ]
        ,"../../images/");
        if($image_data["status"] === true){
          array_push($image_names,$image_data["file_name"]);
        }
      }
    }else{
      if(!isset($_POST["edit"]) && empty($_POST["edit"])){
        echo "Images must be setted";
        header("location: ../index.php");
        exit();
      }
    }

    $video = "";
    if(!empty($_FILES["video"]["name"])){
      $video_data = Static_methods::upload_file($_FILES["video"],"../../videos/",500000000); // ~ 500mb
      if($video_data["status"] == true){
        $video = $video_data["file_name"];
      }
    }

    if(!isset($_POST["edit"]) && empty($_POST["edit"])){
        $product_db = new Product_db();
        $result = $product_db->add_product([

          "title"=>$title,
          "price"=>$price,
          "sale_price"=>$sale_price,
          "product_link"=>$product_link,
          "features"=>$features,
          "end_date"=>$end_date,
          "video"=>$video,
          "guarantee"=>$guarantee,
          "in_stock"=>$in_stock,
          "stock"=>$stock,
          "free_delivery"=>$free_delivery,
          "product_data"=>[
              "left"=>[$left_0,$left_1,$left_2],
              "right"=>[$right_0,$right_1,$right_2]
          ],
          "product_images"=>$image_names

        ]);
    }else if(isset($_POST["edit"]) && !empty($_POST["edit"])){
        $product_db = new Product_db();
        $id = $_POST["edit"];
        $result = $product_db->edit_product([
          "title"=>$title,
          "price"=>$price,
          "sale_price"=>$sale_price,
          "product_link"=>$product_link,
          "features"=>$features,
          "end_date"=>$end_date,
          "video"=>$video,
          "guarantee"=>$guarantee,
          "in_stock"=>$in_stock,
          "stock"=>$stock,
          "free_delivery"=>$free_delivery,
          "product_data"=>[
              "left"=>[$left_0,$left_1,$left_2],
              "right"=>[$right_0,$right_1,$right_2]
          ],
          "product_images"=>$image_names,
          "id"=>$id

        ]);
    }else{
      header("location: ../index.php");
      exit();
    }
    echo json_encode($result);
    header("location: ../index.php");
    exit();
  }else if(isset($_POST["delete_image"]) && !empty($_POST["delete_image"])){
    $image_id = $_POST["delete_image"];
    $product_db = new Product_db();
    $result = $product_db->delete_product_image($image_id);
    if($result["status"]){
      if($result["image_name"]){
        @unlink("../../images/".$result['image_name']);
      }
    }
    echo json_encode($result);
    exit();
  }else if(isset($_POST["delete_video"]) && !empty($_POST["delete_video"])){
    $image_id = $_POST["delete_video"];
    $product_db = new Product_db();
    $result = $product_db->delete_product_video($image_id);
    if($result["status"]){
      if($result["video_name"]){
        @unlink("../../videos/".$result['video_name']);
      }
    }

    echo json_encode($result);
    exit();
  }

?>
