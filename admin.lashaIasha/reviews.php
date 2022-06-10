<?php

include("./templates/up_part.php");

include("./classes/reviews_db_class.php");

$review_db = new Review_db();
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
$total_review_on_page = 100;
if(isset($_GET["id"]) && !empty($_GET["id"])){
  $product_id = $_GET["id"];
  $result = $review_db->load_reviews(abs(($page-1)*$total_review_on_page),$product_id,$total_review_on_page);
  //var_dump($result);
}else{
  $product_id=-1;
  $result = ["data"=>[]];
}
$link = '';
if(isset($_GET["link"]) && !empty($_GET["link"])){
  $link = $_GET["link"];
}

?>
          <div class="home_main">
            <h3>შეფასებები</h3>
            <div class="reviews-container">
              <a href="<?php echo "../?id=".htmlspecialchars($link); ?>" target="_blank">პროდუქტის ლინკი</a>
              <?php foreach($result["data"] as $data){ ?>
                <div class="review">
                  <div class="head">
                    <img src="../user_images/avatars/<?php echo htmlspecialchars($data[4]); ?>" alt="">
                    <div class="rate-user">
                      <div class="name-surname">
                        <p><?php echo htmlspecialchars($data[1]); ?></p>
                        <p><?php echo htmlspecialchars($data[2]); ?></p>
                      </div>
                      <div class="rate">
                        <?php for($i=1;$i<=5;$i++){ ?>
                          <?php if($i<=$data[6]){ ?>
                            <img src="../icons/filled_star.png" alt="">
                          <?php }else{ ?>
                              <img src="../icons/empty_star.png" alt="">
                          <?php } ?>
                        <?php } ?>
                      </div>
                    </div>
                    <?php if($data[5] !== NULL){ ?>
                      <a href="../user_images/<?php echo htmlspecialchars($data[5]); ?>" target="_blank">მომხმარებლის სურათი</a>
                    <?php } ?>
                  </div>
                  <p class="comment"><?php echo htmlspecialchars($data["3"]); ?></p>
                  <p id="delete">წაშლა</p>
                  <input type="hidden" name="" value="<?php echo $data[0]; ?>">
                </div>
              <?php } ?>




            </div>
            <div class="page_buttons">
              <?php if($page > 1){ ?>
                <a href="./reviews.php?id=<?php echo $product_id; ?>&link=<?php echo htmlspecialchars($link); ?>&page=<?php echo $page-1; ?>"><img class="left" src="./images/arrow.png" alt=""></a>
              <?php } ?>
                <p><?php echo $page; ?></p>
              <?php if(sizeof($result["data"]) == $total_review_on_page){ ?>
                <a href="./reviews.php?id=<?php echo $product_id; ?>&link=<?php echo htmlspecialchars($link); ?>&page=<?php echo $page+1; ?>"><img src="./images/arrow.png" alt=""></a>
              <?php } ?>
            </div>
          </div>
<script src="./scripts/review.js"></script>
<?php include("./templates/down_part.php"); ?>
