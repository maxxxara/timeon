<?php
include("db_connect_class.php");
class Review_db extends Db_connect{
  function __construct(){
    parent::__construct();
  }

  function load_reviews($start,$product_id,$total_review_on_page){
    $start = $this->conn->escape_string($start);
    $product_id = $this->conn->escape_string($product_id);
    $total_review_on_page = $this->conn->escape_string($total_review_on_page);
    $sql_command = "
      SELECT id,name,surname,comment,avatar,user_image,rate
       FROM reviews
      WHERE product_id='$product_id' ORDER BY id DESC LIMIT $start,$total_review_on_page;
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
  function delete_review($review_id){
    $review_id = $this->conn->escape_string($review_id);
    $sql_command = "DELETE FROM reviews WHERE id='$review_id'";
    if($this->conn->query($sql_command)){
      return ["status"=>true,"message"=>"Successfully deleted"];
    }
    return ["status"=>false,"message"=>"Something went wrong"];
  }
}

?>
