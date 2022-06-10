<?php
include("db_connect_class.php");
class Order_db extends Db_connect{
  function __construct(){
    parent::__construct();
  }
  function create_order($data){
    $product_link = $this->escape_string($data["product_link"]);
    $ip_address = $this->escape_string($data["ip_address"]);
    $phone = $this->escape_string($data["phone"]);
    $name_surname = $this->escape_string($data["name_surname"]);

    $date = new DateTime("now", new DateTimeZone('Asia/Tbilisi'));
    $current_date = $date->format('Y-m-d H:i:s');

    $pr_id_sql = "SELECT id,TIMESTAMPDIFF(SECOND,'$current_date', end_date) as dif from products WHERE product_link='$product_link'";
    //differance will be +-0.01-1.5sec .....
    if($query = $this->conn->query($pr_id_sql)){
      if($query->num_rows >0){
        $result = $query->fetch_assoc();
        $product_id = $result["id"];
        if($result["dif"]>=0){
          //Insert data
          $sql_command = "
              INSERT INTO product_orders (name_surname,phone_number,ip,order_date,product_id) VALUES
                    ('$name_surname','$phone','$ip_address','$current_date','$product_id');
              ";
          if($this->conn->query($sql_command)){
            return ["status"=>true,"message"=>"successfully inserted"];
          }
          return ["status"=>false,"message"=>"Something went wrong during data insertion"];
          //End insert data

        }
        return ["status"=>false,"message"=>"Sale period expired"];
      }
      return ["status"=>false,"message"=>"Product not found"];
    }
    return ["status"=>false,"message"=>"Something went wrong during data insertion"];
  }

}

?>
