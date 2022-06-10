<?php
include("db_connect_class.php");
class Order_db extends Db_connect{
  function __construct(){
    parent::__construct();
  }
  function load_orders($start,$total_orders_per_page){
    $start = $this->conn->escape_string($start);
    $total_orders_per_page = $this->conn->escape_string($total_orders_per_page);
    $sql_command = "
          SELECT po.id,po.name_surname,po.phone_number,po.order_date,po.ip,po.called,p.product_link,p.title
            FROM product_orders as po LEFT JOIN products as p ON
            po.product_id=p.id ORDER BY po.id DESC LIMIT $start,$total_orders_per_page;
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
  function delete_order($order_id){
    $order_id = $this->conn->escape_string($order_id);
    $sql_command = "
        DELETE FROM product_orders WHERE id='$order_id';
              ";
    if($this->conn->query($sql_command)){
      return ["status"=>true,"message"=>"Order successfully deleted"];
    }
    return ["status"=>false,"message"=>"Something went wrong"];
  }
  function check_order($order_id,$data){
    $order_id = $this->conn->escape_string($order_id);
    $data = $this->conn->escape_string($data);
  
    $sql_command = "
        UPDATE product_orders SET called='$data' WHERE id='$order_id';
              ";
    if($this->conn->query($sql_command)){
      return ["status"=>true,"message"=>"Order successfully upadted"];
    }
    return ["status"=>false,"message"=>"Something went wrong"];
  }
}
