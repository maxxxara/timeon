<?php include("./templates/up_part.php");?>
          <div class="home_main">
            <h3>პროდუქტის დამატება</h3>
            <div class="add-product-container">
              <form class="" action="./templates/add_product.php" method="post" enctype='multipart/form-data'>
                <div class="">
                  <input type="checkbox" name="free_delivery" value="" checked>
                  <label for="in_stock">(უფასო მიწოდება)</label>
                </div>
                  <input class="title" type="text" name="title" value="" placeholder="პროდუქტის დასახელება">
                  <div class="price-in-stock">
                    <input type="text" name="price" value="" placeholder="ფასი">
                    <input type="text" name="sale_price" value="" placeholder="გასაყიდი ფასი">
                    <input type="checkbox" name="in_stock" value="" checked>
                    <label for="in_stock">(მარაგშია,მარაგი იწურება)</label>
                  </div>
                  <div class="second">
                    <input type="datetime-local" name="end_date" value="">
                    <input type="text" name="product_link" value="" placeholder="ლინკი">
                    <input type="file" name="images[]" value="" accept="image/jpeg, image/png" multiple="multiple">
                  </div>
                  <textarea name="features" id="features" placeholder="მახასიათებლები"></textarea>
                  <div class="third">
                    <div class="product-data">
                      <div>
                        <input type="text" name="left_0" value="" placeholder="მოდელი">
                        <input type="text" name="right_0" value="" placeholder="P12Q812">
                      </div>
                      <div>
                        <input type="text" name="left_1" value="" placeholder="მწარმოებელი">
                        <input type="text" name="right_1" value="" placeholder="სამსუნგი">
                      </div>
                      <div>
                        <input type="text" name="left_2" value="" placeholder="ქვეყანა">
                        <input type="text" name="right_2" value="" placeholder="გერმანია">
                      </div>
                      <div>
                        <input type="text" name="stock" value="" placeholder="რაოდენობა">
                      </div>
                    </div>
                    <div class="video-container">
                      <input type="text" name="guarantee" value="" placeholder="გარანტია">
                      <input type="file" name="video" value="" accept="video/mp4">
                      <label for="video">(ვიდეოს ატვირთვა)</label>

                    </div>
                  </div>
                  <button id="submit" type="submit">დამატება</button>
              </form>
            </div>
          </div>
<script src="./scripts/create_product.js"></script>
<script>
  CKEDITOR.replace( 'features' );
</script>
<?php include("./templates/down_part.php"); ?>
