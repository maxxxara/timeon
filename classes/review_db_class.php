<?php
include("db_connect_class.php");
class Review_db extends Db_connect{
  function __construct(){
    parent::__construct();
  }
  function create_review($data){
    $name = $this->escape_string($data["name"]);
    $surname = $this->escape_string($data["surname"]);
    $product_link = $this->escape_string($data["product_link"]);
    $comment = $this->escape_string($data["comment"]);
    $rate = $this->escape_string($data["rate"]);
    $user_image = $data["user_image"];
    $user_image = $this->escape_string($data["user_image"]);

    $avatar = $this->escape_string($data["avatar"]);

    $pr_id_sql = "SELECT id from products WHERE product_link='$product_link'";
    if($query = $this->conn->query($pr_id_sql)){
      if($query->num_rows >0){
        $result = $query->fetch_assoc();
        $product_id = $result["id"];
        //Insert data
        $sql_command = "
            INSERT INTO reviews (name,surname,comment,avatar,user_image,rate,product_id)
            VALUES ('$name','$surname','$comment','$avatar',
            CASE
              WHEN '$user_image' = '' THEN NULL
              ELSE '$user_image'
            END,
            '$rate','$product_id');
            ";
        if($this->conn->query($sql_command)){
          return ["status"=>true,"message"=>"successfully inserted"];
        }else{
          return ["status"=>false,"message"=>"Something went wrong during data insertion"];
        }
        //End insert data

      }
      return ["status"=>false,"message"=>"Product not found"];
    }
    return ["status"=>false,"message"=>"Something went wrong during data insertion"];

  }
  function load_all_review($data){
    $last_id = $this->escape_string($data["last_id"]);
    $product_link = $this->escape_string($data["product_link"]);
    $pr_id_sql = "SELECT id from products WHERE product_link='$product_link'";
    if($query = $this->conn->query($pr_id_sql)){
      if($query->num_rows >0){
        $result = $query->fetch_assoc();
        $product_id = $result["id"];
        $sql_command = "
            SELECT
              id,name,surname,comment,avatar,rate
            FROM reviews
            WHERE product_id='$product_id' AND id<'$last_id'
             ORDER BY id DESC LIMIT 2000;
                        ";
        $query = $this->conn->query($sql_command);
        if($query){
          if($query->num_rows>0){
            $result = $query->fetch_all();
            $query->free_result();
            return ["status"=>true,"data"=>$result];
          }
          return ["status"=>false,"message"=>"There is no any record"];
        }
        return ["status"=>false,"message"=>"Something went wrong during data insertion"];

      }
      return ["status"=>false,"message"=>"Product not found"];
    }
    return ["status"=>false,"message"=>"Something went wrong during data insertion"];
  }
  function load_more_user_images($data){
    $last_id = $this->escape_string($data["last_id"]);
    $product_link = $this->escape_string($data["product_link"]);

    $pr_id_sql = "SELECT id from products WHERE product_link='$product_link'";
    if($query = $this->conn->query($pr_id_sql)){
      if($query->num_rows >0){
        $result = $query->fetch_assoc();
        $product_id = $result["id"];
        $sql_command = "
            SELECT
              id,user_image
            FROM reviews
            WHERE product_id='$product_id' and id<'$last_id' and user_image is not NULL
             ORDER BY id DESC LIMIT 16;
                        ";
        $query = $this->conn->query($sql_command);
        if($query){
          if($query->num_rows>0){
            $result = $query->fetch_all();
            $query->free_result();
            return ["status"=>true,"data"=>$result];
          }
          return ["status"=>false,"message"=>"There is no any record"];
        }
        return ["status"=>false,"message"=>"Something went wrong during data insertion"];

      }
      return ["status"=>false,"message"=>"Product not found"];
    }
    return ["status"=>false,"message"=>"Something went wrong during data insertion"];
  }
}

?>
