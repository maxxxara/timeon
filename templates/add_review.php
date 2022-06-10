<?php

  include("../classes/static_methods_class.php");
  include("../classes/review_db_class.php");

  if(isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["comment"]) && isset($_POST["rate"]) && isset($_POST["pr_id"]) &&
   !empty($_POST["name"]) && !empty($_POST["surname"]) && !empty($_POST["comment"])){
     $name = str_replace(" ","",$_POST["name"]);
     $surname = str_replace(" ","",$_POST["surname"]);
     $comment = str_replace("\n\r"," ",$_POST["comment"]);
     $rate = intval($_POST["rate"]);
     $product_link = $_POST["pr_id"];
     $avatar_file_name = "default_user_avatar.jpg";
     $user_image_file_name = NULL;

     if($rate < 0){
       $rate = 1;
     }else if($rate > 4){
       $rate = 5;
     }else{
       $rate+=1;
     }

     if(mb_strlen($name)<2){
       echo json_encode(["status"=>false,"message"=>"Name too short"]);
       return;
     }else if(mb_strlen($name)>15){
        echo json_encode(["status"=>false,"message"=>"Name too long"]);
        return;
     }
     if(mb_strlen($surname)<4){
       echo json_encode(["status"=>false,"message"=>"Surname too short"]);
       return;
     }else if(mb_strlen($surname)>40){
        echo json_encode(["status"=>false,"message"=>"Surname too long"]);
        return;
     }

     if(mb_strlen($comment)<50){
       echo json_encode(["status"=>false,"message"=>"Comment too short"]);
       return;
     }else if(mb_strlen($comment)>600){
        echo json_encode(["status"=>false,"message"=>"Comment too long"]);
        return;
     }

     if(isset($_FILES["avatar"]) && !empty($_FILES["avatar"])){
       $avatar_upload = Static_methods::validate_image($_FILES["avatar"],"../user_images/avatars/");
       if($avatar_upload["status"] === true){
         $avatar_file_name = $avatar_upload["file_name"];
       }else{
         //echo json_encode($avatar_upload);
       }
     }
     if(isset($_FILES["user_image"]) && !empty($_FILES["user_image"])){
       $user_image_upload = Static_methods::validate_image($_FILES["user_image"],"../user_images/");
       if($user_image_upload["status"] === true){
         $user_image_file_name = $user_image_upload["file_name"];
       }else{
         //echo json_encode($user_image_upload);
       }
     }

     $create_review_db = new Review_db();
     $insert_data = $create_review_db->create_review([
       "product_link"=>$product_link,
       "name"=>$name,
       "surname"=>$surname,
       "comment"=>$comment,
       "rate"=>$rate,
       "avatar"=>$avatar_file_name,
       "user_image"=>$user_image_file_name

     ]);
     if ($insert_data["status"] === true){
       $insert_data["data"] = [
         "name"=>$name,
         "surname"=>$surname,
         "comment"=>$comment,
         "rate"=>$rate,
         "avatar"=>$avatar_file_name,
         "user_image"=>$user_image_file_name
       ];
     }
     echo json_encode($insert_data);

   }
?>
