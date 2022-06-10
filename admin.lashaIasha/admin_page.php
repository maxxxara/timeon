<?php

include("./templates/up_part.php");

include("./classes/products_db_class.php");

$product_db = new Product_db();
if(isset($_GET["page"])){
  if(empty($_GET["page"])){
    $page = 1;
  }else{
    try{
      $page = intval($_GET["page"]);
      if(intval($_GET["page"])<=0){
        $page = 1;
      }
    }catch(Exception $e){
      $page = 1;
    }
  }
}else{
  $page = 1;
}
$total_product_on_page = 30;
$result = $product_db->load_products(abs(($page-1)*$total_product_on_page),$total_product_on_page);

?>

          <div class="home_main">
            <h3>პროდუქტები</h3>
            <div class="product_container">
              <?php foreach($result["data"] as $data){ ?>
                <div class="product">
                  <div class="up">
                    <a href="./reviews.php?id=<?php echo $data[0]; ?>&link=<?php echo htmlspecialchars($data[1]); ?>" target="_blank"><img src="./images/review.png" alt=""></a>
                    <a href="../?id=<?php echo htmlspecialchars($data[1]);?>" target="_blank"><img src="./images/open.png" alt=""></a>
                    <a href="edit_product.php?id=<?php echo $data[0]; ?>"><img src="./images/edit.png" alt=""></a>

                    <img id="delete" src="./images/delete.png" data-id="<?php echo $data[0]; ?>" alt="">
                  </div>
                  <img src="../images/<?php echo htmlspecialchars($data[5]); ?>" alt="">
                  <p><?php echo htmlspecialchars($data[2]); ?></p>
                  <div class="prices">
                    <p><?php echo htmlspecialchars($data[3]); ?>₾</p>
                    <p><?php echo htmlspecialchars($data[4]); ?>₾</p>
                    <p>-<?php echo round((($data[4]-$data[3])/$data[4])*100); ?>%</p>
                  </div>
                </div>
              <?php } ?>
            </div>

            <div class="page_buttons">
              <?php if($page > 1){ ?>
                <a href="./admin_page.php?page=<?php echo $page-1; ?>"><img class="left" src="./images/arrow.png" alt=""></a>
              <?php } ?>
                <p><?php echo $page; ?></p>
              <?php if(sizeof($result["data"]) == $total_product_on_page){ ?>
                <a href="./admin_page.php?page=<?php echo $page+1; ?>"><img src="./images/arrow.png" alt=""></a>
              <?php } ?>
            </div>
          </div>
<script src="./scripts/admin_page.js"></script>
<?php include("./templates/down_part.php"); ?>
