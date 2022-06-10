<?php


if(!isset($_GET["id"]) || empty($_GET["id"])){
  header("location: ./index.php");
  exit();
}


include("./classes/products_db_class.php");

$id = $_GET["id"];
$product_db = new Product_db();
$result = $product_db->load_product($id);

if($result["status"] === false){
  echo $result["message"];
  header('Refresh: 2; URL=index.php');
  exit();
}


$data = $result["data"];
$product_images = $product_db->load_product_images($id);
if($product_images["status"] == true){
  $images = $product_images["data"];
}else{
  echo $product_images["message"];
  $images = [];
}




?>

<?php include("./templates/up_part.php"); ?>

          <div class="home_main">
            <h3>პროდუქტის რედაქტირება</h3>
            <div class="add-product-container">
              <form class="" action="./templates/add_product.php" method="post" enctype='multipart/form-data'>
                <div class="">
                  <input type="checkbox" name="free_delivery" value=""  <?php echo ($data["free_delivery"] == "1") ? "checked" : ''; ?>>
                  <label for="in_stock">(უფასო მიწოდება)</label>
                </div>
                  <input type="hidden" name="edit" value="<?php echo $id; ?>">
                  <input class="title" type="text" name="title" value="<?php echo htmlspecialchars($data["title"]); ?>" placeholder="პროდუქტის დასახელება">
                  <div class="price-in-stock">
                    <input type="text" name="price" value="<?php echo htmlspecialchars($data["price"]); ?>" placeholder="ფასი">
                    <input type="text" name="sale_price" value="<?php echo htmlspecialchars($data["sale_price"]); ?>" placeholder="გასაყიდი ფასი">
                    <input type="checkbox" name="in_stock" value="" <?php echo ($data["in_stock"] == "1") ? "checked" : ''; ?>>
                    <label for="in_stock">(მარაგშია,მარაგი იწურება)</label>
                  </div>
                  <div class="second">
                    <input type="datetime-local" name="end_date" value="<?php echo str_replace(" ","T", $data["end_date"]); ?>">
                    <input type="text" name="product_link" value="<?php echo htmlspecialchars($data["product_link"]); ?>" placeholder="ლინკი">
                    <input type="file" name="images[]" value="" accept="image/jpeg, image/png" multiple="multiple">
                  </div>
                  <textarea name="features" id="features" placeholder="მახასიათებლები"><?php echo htmlspecialchars($data["features"]); ?></textarea>
                  <div class="third">
                    <div class="product-data">
                      <div>
                        <input type="text" name="left_0" value="<?php echo htmlspecialchars($data["left_0"]); ?>" placeholder="მოდელი">
                        <input type="text" name="right_0" value="<?php echo htmlspecialchars($data["right_0"]); ?>" placeholder="P12Q812">
                      </div>
                      <div>
                        <input type="text" name="left_1" value="<?php echo htmlspecialchars($data["left_1"]); ?>" placeholder="მწარმოებელი">
                        <input type="text" name="right_1" value="<?php echo htmlspecialchars($data["right_1"]); ?>" placeholder="სამსუნგი">
                      </div>
                      <div>
                        <input type="text" name="left_2" value="<?php echo htmlspecialchars($data["left_2"]); ?>" placeholder="ქვეყანა">
                        <input type="text" name="right_2" value="<?php echo htmlspecialchars($data["right_2"]); ?>" placeholder="გერმანია">
                      </div>
                      <div>
                        <input type="text" name="stock" value="<?php echo htmlspecialchars($data["stock"]); ?>" placeholder="რაოდენობა">
                      </div>
                    </div>
                    <div class="video-container">
                      <input type="text" name="guarantee" value="<?php echo htmlspecialchars($data["guarantee"]); ?>" placeholder="გარანტია">
                      <input type="file" name="video" value="" accept="video/mp4">
                      <label for="video">(ვიდეოს ატვირთვა)</label>
                    </div>
                  </div>
                  <div class="data-container">
                    <div class="images-data">

                      <?php foreach($images as $image){ ?>
                        <div class="each-image">
                          <img id="image_delete" src="./images/delete.png" class="delete" alt="">
                          <img src="../images/<?php echo htmlspecialchars($image[1]); ?>" alt="">
                          <input type="hidden" id="image_id" value="<?php echo $image[0]; ?>">
                        </div>
                      <?php } ?>
                    </div>
                    <div class="video-container">
                      <?php if($data["video"] != NULL){ ?>
                        <img id="video_delete" src="./images/delete.png" class="delete" alt="">
                        <video controls>
                          <source src="../videos/<?php echo htmlspecialchars($data["video"]); ?>" type="video/mp4">
                        </video>
                        <input type="hidden" id="image_id" value="<?php echo $id; ?>">
                      <?php } ?>
                    </div>
                  </div>
                  <button id="submit" type="submit">რედაქტირება</button>
              </form>
            </div>
          </div>
<script>
  const current_product_link = "<?php echo $data["product_link"]; ?>";
  let size_of_images = <?php echo sizeof($images); ?>;

  CKEDITOR.replace( 'features' );
</script>
<script src="./scripts/edit_product.js"></script>
<?php include("./templates/down_part.php"); ?>
