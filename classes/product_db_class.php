<?php
include("db_connect_class.php");
class Product_db extends Db_connect
{
  function __construct()
  {
    parent::__construct();
  }
  function load_product($data)
  {
    $data = $this->escape_string($data);
    $sql_command = "
        SELECT
          p.id,p.title,p.price,p.sale_price,p.end_date,p.features,p.video,p.guarantee,
          p.in_stock, p.stock,p.free_delivery,pd.left_0,pd.left_1,pd.left_2,pd.right_0,pd.right_1,pd.right_2
        FROM products as p left join product_data as pd ON p.id = pd.product_id
          WHERE p.product_link = '$data';
                    ";
    $query = $this->conn->query($sql_command);
    if ($query) {
      if ($query->num_rows > 0) {
        return $query->fetch_assoc();
      }
    }
  }
  function load_product_images($product_id)
  {
    $sql_command = "
        SELECT image FROM product_images WHERE product_id='$product_id';
                    ";
    $query = $this->conn->query($sql_command);
    if ($query) {
      if ($query->num_rows > 0) {
        $result = $query->fetch_all();
        $query->free_result();
        return $result;
      }
    }
  }
  function load_reviews($product_id)
  {
    $product_id = $this->escape_string($product_id);

    $sql_command = "
        SELECT
          id,name,surname,comment,avatar,rate
        FROM reviews
        WHERE product_id='$product_id' ORDER BY id DESC LIMIT 3;
                    ";

    $query = $this->conn->query($sql_command);
    if ($query) {
      $result = $query->fetch_all();
      $query->free_result();
      return $result;
    }
  }
  function load_review_images($product_id)
  {
    $product_id = $this->escape_string($product_id);
    $sql_command = "
        SELECT
          id,user_image
        FROM reviews
        WHERE product_id='$product_id' and user_image is not NULL ORDER BY id DESC LIMIT 16;
                    ";

    $query = $this->conn->query($sql_command);
    if ($query) {
      if ($query->num_rows > 0) {
        $result = $query->fetch_all();
        $query->free_result();
        return $result;
      }
    }
  }
  function load_rates($product_id)
  {
    $sql_command = "
        SELECT rate,count(*) FROM reviews WHERE product_id = '$product_id' GROUP BY rate;
                    ";
    $query = $this->conn->query($sql_command);
    if ($query) {
      if ($query->num_rows > 0) {
        $result = $query->fetch_all();
        $query->free_result();
        return $result;
      }
    }
  }

  function loadRandProducts($current_product)
  {
    $query = $this->conn->query("SELECT * FROM `products` where product_link != '$current_product'");


    if ($query) {
      if ($query->num_rows > 0) {
        $result = $query->fetch_all(MYSQLI_ASSOC);

        $products = [];
        foreach ($result as $key => $product) {
          $id = $product['id'];
          $img_query = $this->conn->query("SELECT * FROM `product_images` where product_id = '$id' ");
          $image = $img_query->fetch_all(MYSQLI_ASSOC);
          // print_r( $image );
          $products[$key]['id'] =  $product['id'];
          $products[$key]['title'] =  $product['title'];
          $products[$key]['product_link'] =  $product['product_link'];
          $products[$key]['sale_price'] =  $product['sale_price'];
          $products[$key]['price'] =  $product['price'];
          $products[$key]['guarantee'] =  $product['guarantee'];
          $products[$key]['image'] =  isset($image[0]) ? $image[0]['image'] : '';
        }

        $query->free_result();
        return $products;
      }
    }
  }
  function load_other_products($current_product, $quantity = 16)
  {

    $current_product = $this->escape_string($current_product);
    $quantity = $this->escape_string($quantity);
    $sql_command = "
        SELECT p.product_link,p.title,p.sale_price,p.price,pi.image FROM products as p LEFT JOIN
         product_images AS pi ON  pi.product_id=p.id
        WHERE pi.id IN (SELECT MIN(id) FROM `product_images` as sub_p GROUP BY sub_p.product_id)
         and p.product_link != '$current_product' ORDER BY RAND() DESC LIMIT $quantity;
                  ";
    $query = $this->conn->query($sql_command);

    if ($query) {
      if ($query->num_rows > 0) {
        $result = $query->fetch_all();
        $query->free_result();
        return $result;
      }
    }
  }
  function load_weekly_promotion_product($current_product, $quantity = 16)
  {
    $current_product = $this->escape_string($current_product);
    $quantity = $this->escape_string($quantity);
    $sql_command = "
        SELECT p.product_link,p.title,p.sale_price,p.price,pi.image FROM products as p LEFT JOIN
         product_images AS pi ON  pi.product_id=p.id
        WHERE pi.id IN (SELECT MIN(id) FROM `product_images` as sub_p GROUP BY sub_p.product_id)
         and p.product_link != '$current_product' ORDER BY p.end_date DESC LIMIT $quantity;
                  ";
    $query = $this->conn->query($sql_command);
    if ($query) {
      if ($query->num_rows > 0) {
        $result = $query->fetch_all();
        $query->free_result();
        return $result;
      }
    }
  }
  function search_product($product_link, $text)
  {
    $product_link = $this->escape_string($product_link);
    $text = $this->escape_string($text);
    $sql_command = "
        SELECT p.product_link,p.title,p.sale_price,p.price,pi.image FROM products as p LEFT JOIN
         product_images AS pi ON  pi.product_id=p.id
        WHERE
        pi.id IN (SELECT MIN(id) FROM `product_images` as sub_p GROUP BY sub_p.product_id)
         and p.product_link != '$product_link' and title like '%$text%'
         ORDER BY p.id DESC LIMIT 3;
                    ";
    $query = $this->conn->query($sql_command);
    if ($query) {
      if ($query->num_rows > 0) {
        $result = $query->fetch_all();
        $query->free_result();
        return ["status" => true, "message" => "Products found", "data" => $result];
      }
      return ["status" => false, "message" => "Product not found"];
    }
    return ["status" => false, "message" => "Something went wrong"];
  }
}
//$nw = new Product_db();
//var_dump( $nw->load_product("Furniture-sofa"));
