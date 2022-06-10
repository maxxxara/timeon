<?php
include("db_connect_class.php");
class Product_db extends Db_connect{
  function __construct(){
    parent::__construct();
  }

  function load_products($start,$total_product_on_page){
    $start = $this->conn->escape_string($start);
    $total_product_on_page = $this->conn->escape_string($total_product_on_page);
    $sql_command = "
      SELECT p.id,p.product_link,p.title,p.sale_price,p.price,pi.image FROM products as p LEFT JOIN
         product_images AS pi ON  pi.product_id=p.id
        WHERE
        pi.id IN (SELECT MIN(id) FROM `product_images` as sub_p GROUP BY sub_p.product_id) or pi.image IS NULL
         ORDER BY p.id DESC LIMIT $start,$total_product_on_page;
    ";

    if($query = $this->conn->query($sql_command)){
      if($query->num_rows>0){
        $result = $query->fetch_all();
        $query->free_result();
        return ["status"=>true,"data"=>$result];
      }
      return ["status"=>true,"data"=>[]];
    }
    return ["status"=>false,"data"=>[],"message"=>"Something went wrong"];
  }

  function load_product($product_id){
    $product_id = $this->escape_string($product_id);
    $sql_command = "
        SELECT
          p.id,p.title,p.price,p.sale_price,p.end_date,p.features,
          p.guarantee,p.video,p.product_link,p.in_stock,p.stock,p.free_delivery,pd.left_0,pd.left_1,pd.left_2,
          right_0,right_1,right_2
        FROM products p LEFT JOIN product_data pd ON p.id=pd.product_id
          WHERE p.id='$product_id';
            ";
    if($query = $this->conn->query($sql_command)){
      if($query->num_rows>0){
        $result = $query->fetch_assoc();
        return ["status"=>true,"data"=>$result];
      }
      return ["status"=>false,"message"=>"Product not found"];
    }
    return ["status"=>false,"message"=>"Something went wrong"];
  }
  function load_product_images($product_id){
    $product_id = $this->escape_string($product_id);
    $sql_command = "SELECT id,image FROM product_images WHERE product_id='$product_id';";
    if($query = $this->conn->query($sql_command)){
      $result = $query->fetch_all();
      $query->free_result();
      return ["status"=>true,"data"=>$result];
    }
    return ["status"=>false,"message"=>"Something went wrong"];
  }
  function delete_product_image($image_id){
    $image_id = $this->escape_string($image_id);
    $sql_command = "SELECT image FROM product_images WHERE id='$image_id';";
    if($query = $this->conn->query($sql_command)){
      if($query->num_rows>0){
        $result = $query->fetch_assoc();
        $sql_command = "DELETE FROM product_images WHERE id='$image_id';";
        if($this->conn->query($sql_command)){
          return ["status"=>true,"message"=>"Image successfully deleted","image_name"=>$result["image"]];
        }
        return ["status"=>false,"message"=>"Error during removing image from database"];
      }
      return ["status"=>true,"message"=>"There is no any image to delete","image_name"=>false];
    }
    return ["status"=>false,"message"=>"Something went wrong"];
  }
  function delete_product_video($product_id){
    $product_id = $this->escape_string($product_id);
    $sql_command = "SELECT video FROM products WHERE id='$product_id';";
    if($query = $this->conn->query($sql_command)){
      if($query->num_rows>0){
        $result = $query->fetch_assoc();
        $sql_command = "UPDATE products set video=NULL WHERE id='$product_id';";
        if($this->conn->query($sql_command)){
          return ["status"=>true,"message"=>"Video successfully deleted","video_name"=>$result["video"]];
        }
        return ["status"=>false,"message"=>"Error during removing video from database"];
      }
      return ["status"=>true,"message"=>"There is no any video to delete","video_name"=>false];
    }
    return ["status"=>false,"message"=>"Something went wrong"];
  }
  function check_if_exist($product_link){
    $product_link = $this->conn->escape_string($product_link);
    $sql_command = "SELECT * FROM products where product_link='$product_link'";
    if($query = $this->conn->query($sql_command)){
      if($query->num_rows == 0){
        return ["status"=>true];
      }
      return ["status"=>false,"message"=>"Link already exists"];
    }
    return ["status"=>false,"message"=>"Something went wrong"];
  }

  function add_product_images($images,$product_id){
    $product_id = $this->conn->escape_string($product_id);
    if(sizeof($images)>0){
      $sql_values = [];
      foreach ($images as $image) {
        $image_name = $this->escape_string($image);
        $image_value = "('$image_name','$product_id')";
        array_push($sql_values,$image_value);
      }
      $values = implode(",",$sql_values);
      $sql_command_2 = "
            INSERT INTO product_images (image,product_id)
                VALUES $values
                ";
      if($this->conn->query($sql_command_2)){
        return "Product images successfully inserted";
      }
      return "Product images is not inserted";
    }
    return "Product images is empty";
  }
  function add_product_data($product_data,$product_id){
    $left_0 = $this->conn->escape_string($product_data["left"][0]);
    $left_1 = $this->conn->escape_string($product_data["left"][1]);
    $left_2 = $this->conn->escape_string($product_data["left"][2]);
    $right_0 = $this->conn->escape_string($product_data["right"][0]);
    $right_1 = $this->conn->escape_string($product_data["right"][1]);
    $right_2 = $this->conn->escape_string($product_data["right"][2]);
    $product_id = $this->conn->escape_string($product_id);
    $sql_command_1 = "
            INSERT INTO product_data (left_0,left_1,left_2,right_0,right_1,right_2,product_id)
              VALUES ('$left_0','$left_1','$left_2','$right_0','$right_1','$right_2','$product_id')
            ";
    if($this->conn->query($sql_command_1)){
      return "Product data successfully inserted";
    }
    return "Product data is not inserted";
  }
  function edit_product_data($product_data,$product_id){
    $left_0 = $this->conn->escape_string($product_data["left"][0]);
    $left_1 = $this->conn->escape_string($product_data["left"][1]);
    $left_2 = $this->conn->escape_string($product_data["left"][2]);
    $right_0 = $this->conn->escape_string($product_data["right"][0]);
    $right_1 = $this->conn->escape_string($product_data["right"][1]);
    $right_2 = $this->conn->escape_string($product_data["right"][2]);
    $product_id = $this->conn->escape_string($product_id);

    $sql_command_1 = "
        UPDATE product_data SET left_0='$left_0', left_1='$left_1', left_2='$left_2',
          right_0='$right_0',right_1='$right_1',right_2='$right_2' WHERE product_id='$product_id';
                    ";
    if($this->conn->query($sql_command_1)){
      return "Product data successfully upadted";
    }
    return "Product data is not upadted";
  }
  function add_product($data){
    $title = $this->conn->escape_string($data["title"]);
    $price = $this->conn->escape_string($data["price"]);
    $sale_price = $this->conn->escape_string($data["sale_price"]);
    $product_link = $this->conn->escape_string($data["product_link"]);
    $features = $this->conn->escape_string($data["features"]);
    $end_date = $this->conn->escape_string($data["end_date"]);
    $video = $this->conn->escape_string($data["video"]);
    $guarantee = $this->conn->escape_string($data["guarantee"]);
    $in_stock = $this->conn->escape_string($data["in_stock"]);
    $stock = $this->conn->escape_string($data["stock"]);
    $free_delivery = $this->conn->escape_string($data["free_delivery"]);

    $sql_command = "
          INSERT INTO products (title,price,sale_price,end_date,features,guarantee,video,product_link,in_stock,stock,free_delivery)
              VALUES ('$title','$price','$sale_price','$end_date','$features','$guarantee',
              CASE
                WHEN '$video' = '' THEN NULL
                ELSE '$video'
              END,
              '$product_link','$in_stock','$stock','$free_delivery');
                    ";

    if($query = $this->conn->query($sql_command)){

      $sql_command_0= "SELECT id FROM products WHERE product_link='$product_link';";
      if($query = $this->conn->query($sql_command_0)){
        $result = $query->fetch_assoc();
        $id = $result["id"];
        $product_images_insert_message = $this->add_product_images($data["product_images"],$id);
        $product_data_insert_message = $this->add_product_data($data["product_data"],$id);
      }
      return [
              "status"=>true,
              "message"=>"Product successfully inserted",
              "product_data_message"=>$product_data_insert_message,
              "product_images_message"=>$product_images_insert_message
            ];
    }
    return ["status"=>false,"message"=>"Product is not inserted"];
  }
  function edit_product($data){
    $title = $this->conn->escape_string($data["title"]);
    $price = $this->conn->escape_string($data["price"]);
    $sale_price = $this->conn->escape_string($data["sale_price"]);
    $product_link = $this->conn->escape_string($data["product_link"]);
    $features = $this->conn->escape_string($data["features"]);
    $end_date = $this->conn->escape_string($data["end_date"]);
    $video = $this->conn->escape_string($data["video"]);
    $guarantee = $this->conn->escape_string($data["guarantee"]);
    $in_stock = $this->conn->escape_string($data["in_stock"]);
    $stock = $this->conn->escape_string($data["stock"]);
    $free_delivery = $this->conn->escape_string($data["free_delivery"]);
    $id = $this->conn->escape_string($data["id"]);

    $sql_command = "
        UPDATE products SET title='$title', price='$price', sale_price='$sale_price', end_date='$end_date',
          features='$features',guarantee='$guarantee',video=CASE
                                                              WHEN '$video' = '' THEN video
                                                              ELSE '$video'
                                                            END,
          product_link='$product_link', in_stock='$in_stock',stock='$stock', free_delivery='$free_delivery' WHERE id='$id';
                  ";
    if($this->conn->query($sql_command)){
      $product_images_insert_message = $this->add_product_images($data["product_images"],$id);
      $product_data_insert_message = $this->edit_product_data($data["product_data"],$id);

      return [
              "status"=>true,
              "message"=>"Product successfully upadted",
              "product_data_message"=>$product_data_insert_message,
              "product_images_message"=>$product_images_insert_message
            ];
    }
    return ["status"=>false,"message"=>"Product is not updated"];
  }

  function delete_product($product_id){
    $product_id = $this->conn->escape_string($product_id);
    $sql_command = "
          DELETE FROM products WHERE id='$product_id';
          DELETE FROM product_data WHERE product_id='$product_id';
          DELETE FROM product_images WHERE product_id='$product_id';
          DELETE FROM reviews WHERE product_id='$product_id';
                  ";
    if($this->conn->multi_query($sql_command)){
      return ["status"=>true,"message"=>"Product successfully deleted"];
    }
    return ["status"=>false,"message"=>"Something went wrong".$this->conn->error];
  }
}

?>
