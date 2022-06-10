<?php
if (!isset($_GET["id"]) and empty($_GET["id"])) {
  header("location: home.php");
  die("ასეთი პროდუქტი ვერ მოიძებნა");
}
include("./classes/static_methods_class.php");
$product_link = $_GET["id"];
include("./classes/product_db_class.php");
$product_db = new Product_db();
$product = $product_db->load_product($product_link);
if ($product === NULL) {
  header("location: home.php");
  die("ასეთი პროდუქტი ვერ მოიძებნა");
}
$product_images = $product_db->load_product_images($product["id"]);
$reviews = $product_db->load_reviews($product["id"]);
$review_images = $product_db->load_review_images($product["id"]);

$rates_shablon_array = [0, 0, 0, 0, 0];
$rates = $product_db->load_rates($product["id"]);
$total_rate_stars = 0;
if ($rates !== NULL) {
  foreach ($rates as $data) {
    $rates_shablon_array[4 - (intval($data[0]) - 1)] = intval($data[1]);
    $total_rate_stars += intval($data[0]) * intval($data[1]);
  }
}

$total_rates = array_sum($rates_shablon_array);
$avg_rate = 0;
if ($total_rate_stars != 0) {
  $avg_rate = $total_rate_stars / $total_rates;
}

$other_products = $product_db->load_other_products($product_link);


$randomProducts = $product_db->loadRandProducts($product_link);



$delivery_time = Static_methods::return_cur_date_in_geo();

?>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
  <!--<meta name="viewport" content="height=device-height, width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">-->
  <meta name="viewport" content="target-densitydpi=device-dpi, initial-scale=1.0, user-scalable=no" />


  <meta property="og:url" content="https://buytech.ge/?id=<?php echo htmlspecialchars($product_link); ?>">
  <meta property="og:site_name" content="Buytech.ge">
  <meta property="og:title" content="<?php echo htmlspecialchars($product["title"]); ?>" />
  <meta property="og:type" content="website">
  <meta property="og:image:width" content="800" />
  <meta property="og:image:height" content="420" />
  <meta property="og:image" content="./images/<?php echo htmlspecialchars($product_images[0][0]); ?>" />
  <meta property="og:description" content="<?php echo htmlspecialchars($product["features"]); ?>" />
  <!-- Meta Pixel Code -->
  <script>
      !function(f,b,e,v,n,t,s)
      {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
      n.callMethod.apply(n,arguments):n.queue.push(arguments)};
      if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
      n.queue=[];t=b.createElement(e);t.async=!0;
      t.src=v;s=b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t,s)}(window, document,'script',
      'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '718090402642418');
      fbq('track', 'PageView');
  </script>
  <noscript><img height="1" width="1" style="display:none"
      src="https://www.facebook.com/tr?id=718090402642418&ev=PageView&noscript=1"
  /></noscript>
<!-- End Meta Pixel Codeსს -->

  <title>BuyTech | ონლაინ მაღაზია</title>
  <link rel="icon" type="image/x-icon" href="./icons/favicon.ico">
  <link rel="stylesheet" href="./css/index.css">
  <link rel="stylesheet" href="./css/components.css">
  <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
</head>

<body>
    <!-- Yandex.Metrika counter -->
  <script type="text/javascript" >
       (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
       m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
       (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
    
       ym(88152978, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true,
            ecommerce:"dataLayer"
       });
  </script>
  <noscript><div><img src="https://mc.yandex.ru/watch/88152978" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
  <header>
    <div class="header">
      <div class="left-side-head">
         <a href="/">
             
         
        <img id="market" src="./icons/logo.png" class="marketplace" alt="">
        </a>
        <div class="search-container">
          <input id="desktop_search_input" type="text" value="" placeholder="მოძებნეთ სასურველი ნივთი, ან პროდუქტი" autocomplete="off">
          <img src="./icons/search.png" alt="">
        </div>
      </div>
      <div class="info">
        <a href="/deliver.php">მიწოდება</a>
        <a href="/contact.php">კონტაქტი</a>
        <a href="tel:032 2 605 605" class="phone"><img src="./icons/phone.png">032 2 605 605</a>
      </div>
    </div>
    <div class="mobile-header">
      <div class="left">
        <a href="/">
          <img id="show_main_mobile" src="./icons/logo.png" alt="">
        </a>
      </div>
      <div class="right">
        <div class="mobile-search-container">
          <input id="mobile_search_input" type="text" value="" placeholder="მოძებნეთ სასურველი ნივთი, ან პროდუქტი" autocomplete="off">
          <img src="./icons/search.png" alt="">
        </div>
        <img id="mobile_search" src="./icons/mobile_search_button.png" alt="">
        <a href="tel:032 2 605 605"><img src="./icons/mobile.png" alt=""></a>
      </div>
    </div>
  </header>
  <div class="main">

    <div class="data-container">
      <div class="image-data">

        <!-- <div class="price__banner">
          სალიკვიდაციო ფასი <p class="sale-price"><?php echo $product["sale_price"]; ?>₾</p>
          <p class="price"><?php echo $product["price"]; ?>₾</p>
        </div> -->

        <div class="timeout__banner mob">
          აქცია დასრულდება: <span class="time"></span>
        </div>

        <img id="main_image" class="main-image" src="./images/<?php echo htmlspecialchars($product_images[0][0]); ?>" alt="">
        <div class="slider">
          <div id="left_slider_button" class="slider-button left">
            <img src="./icons/arrow.png" alt="">
          </div>
          <div id="images" class="images">
            <?php foreach ($product_images as $key => $image) { ?>
              <?php if ($key === 0) { ?>
                <img src="./images/<?php echo htmlspecialchars($image[0]); ?>" class="active" alt="">
              <?php } else { ?>
                <img src="./images/<?php echo htmlspecialchars($image[0]); ?>" alt="">
              <?php } ?>
            <?php } ?>
          </div>
          <div id="right_slider_button" class="slider-button">
            <img src="./icons/arrow.png" alt="">
          </div>
        </div>


        <div class="container__order showScroll">
          <div class="countdown">
            <p class="text">მარაგში დარჩენილია:<span class="quantity2"> <?= $product['stock'] ?></span>ცალი</p>
          </div>
          <form action="">
            <input type="text" class="preson-input" name="fname" placeholder="შეიყვანეთ სახელი და გვარი" id="">
            <input type="text" maxlength="12" class="preson-input phone" name="phone" placeholder="შეიყვანეთ მობილურის ნომერი" id="">
            <div class="privacy-checkbox">
              <div id="privacy_checkbox" class="checkbox">
                <input type="checkbox" name="" value="" checked="">
                <img src="./icons/checked.png" alt="">
              </div>
              <p>ვეთანხმები<a href="/privacy-policy.php" target="_blank"> წესებსა და პირობებს</a></p>
            </div>
            <button id="make_order2" type="submit" name="button">შეკვეთა</button>

            <small class="small__text">*ოპერატორი შეძენიდან რამდენიმე წუთში დაგიკავშირდებათ და გაგაცნობთ შეკვეთის დეტალებს</small>
          </form>
        </div>

      </div>
      <div class="main-data">
        <div class="product-data">
          <div class="text">
            <div class="timeout__banner pc">
              აქცია დასრულდება: <span class="time">23:59:11</span>
            </div>
            <p class="name"><?php echo htmlspecialchars($product["title"]); ?></p>
            <div class="guarantee">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <rect width="24" height="24" fill="url(#pattern0)" />
                <defs>
                  <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                    <use xlink:href="#image0_4_37" transform="scale(0.0416667)" />
                  </pattern>
                  <image id="image0_4_37" width="24" height="24" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAADVElEQVRIidWVT2gcdRTHP29mJ3F3mwS8FLRUEEHUZPJnJ+iihyAETzUpiHhQ2iDtoV4yMSr10hC0YLTZpCpIldBiKYUepBBEFGzxsFWyk3R3W3sy0NLSf3pIpY3J7vyeh93UJdnJ+ufkOw1vPu/7/b33+M3A/z2kEdARjOxG9aBAKKrvqtAM8r5CKLC/4GWO/WuD7vm3HwpN6TIQi0DKDro98Kau/yODVG5vYlUSO8XgITKM8o2KzAh6AFQVa1zgddAXUJ1Si1yT3vsq8I7ca2iQyu11SiR/ArrvQyKv5VOTx2u5zmDkVVX9sia14HD36cA7UqrlrA09s+W5qvgN4JAqg+vFAfKpyeOqDAp8oHAd6A418ex6boOBavl29TGJY08UezOn1zPt877n5keTxd7MaXXsSYEtAAbza0ODgvfgz8AC0KKrxgNw86PJ9nnfA+iaG+6zDGe1FM6ms35cV8spoAU4X63d3KAzd+cwlREtaxgG6awf11I4axnOurnhUSMyCyQRWTyXbluRplgALANd1doGIxLdBWDUGrjwzPTNc+m2FUQWgSTIh0BSRWaKPa17kDFT6PzollFroLZ2cwO4AmCJ+dwN/B3ImCn2tO5RkZmKyF/iAG7g77DEfFFbu6mBpQwBl4BHUE6ks358zQSVXbXi6awfRzkBbAcu2cbsXq8XeZPdnH8D2CoxtuW7MtfqMZ3n/Ye1zFXgVsHLbK3HRH0CAB4AoCyfuDnfA37Esd8wyyWxY9bHCinKBFW2OUok0kDhe4Gdig5WUy9RLjdZjqDKi1XmUQCBb6N06o7oqcB/zFYuAI6q7rdVzxjL+g5oqyJLljH9xrb6Ud4DlkPMExe96cZLBrDRQ0CzKseKvVMTptm5DJgapFQqW78UUpmDICeBhK0y8bc6aJ97s98Ss9bykiKHUd0mwhDwNZXdPA98JrCksI/KTVa1TF+xZ/qHSIO+M2Ox31qW8gJP1jnMH6HQIahjqeQBpw6z8Pji1d5TL58KIzuoDTfn7wM+BVAYL3qZAwDunD+B8BaAigwVU5NHozTq7mAtHO4eBW4DV8Sx7884TKyMA9eAm7/faT25mUbDcOdGxjrm/IGNef+VjtzIO/9JHCq/z6h36awfb1T/J8CDXEtaSH3iAAAAAElFTkSuQmCC" />
                </defs>
              </svg>

              <div class="text">
                <p>გარანტია <?php echo $product["guarantee"]; ?> </p>
              </div>
            </div>
          </div>
          <!-- <div class="rate">
            <div class="stars">
              <?php for ($i = 1; $i <= 5; $i++) { ?>
                <?php if ($i <= round($avg_rate)) { ?>
                  <img src="./icons/filled_star.png" alt="">
                <?php } else { ?>
                  <img src="./icons/empty_star.png" alt="">
                <?php } ?>
              <?php } ?>
            </div>
            <p>(<?php echo $total_rates; ?> შეფასება)</p>
          </div> -->
        </div>
        <div class="data">
          <div class="">
            <p class="sale-price"><?php echo $product["sale_price"]; ?>₾</p>
            <p class="price"><?php echo $product["price"]; ?>₾</p>
          </div>
        </div>


        <div class="container__order" id="form_area">
          <div class="countdown">
            <p class="text">მარაგში დარჩენილია: <span class="quantity"> <?= $product['stock'] ?></span> ცალი</p>
          </div>
          <form action="">
            <input type="text" class="preson-input" name="fname" placeholder="შეიყვანეთ სახელი და გვარი" id="">
            <input type="text" maxlength="12" class="preson-input phone" name="phone" placeholder="შეიყვანეთ მობილურის ნომერი" id="">
            <div class="privacy-checkbox">
              <div id="privacy_checkbox_2" class="checkbox">
                <input type="checkbox" name="" value="" checked="">
                <img src="./icons/checked.png" alt="">
              </div>
              <p>ვეთანხმები<a href="/privacy-policy.php" target="_blank"> წესებსა და პირობებს</a></p>
            </div>
            <button id="make_order" type="submit" name="button">შეკვეთა</button>

            <small class="small__text">*ოპერატორი შეძენიდან რამდენიმე წუთში დაგიკავშირდებათ და გაგაცნობთ შეკვეთის დეტალებს</small>
          </form>
        </div>


        <h3 class="specification__title">მახასიათებლები</h3>
        <div class="container__specification">
          <?= $product['features'] ?>
        </div>

        <div class="rewievs">

          <h3 class="review__title">შეფასებები</h3>
          <div class="stars">
            <?php for ($i = 1; $i <= 5; $i++) { ?>
              <?php if ($i <= round($avg_rate)) { ?>
                <!-- <img src="./icons/filled_star.png" alt=""> -->
              <?php } else { ?>
                <!-- <img src="./icons/empty_star.png" alt=""> -->
              <?php } ?>
            <?php } ?>
            <img src="./icons/filled_star.png" alt="">
            <img src="./icons/filled_star.png" alt="">
            <img src="./icons/filled_star.png" alt="">
            <img src="./icons/filled_star.png" alt="">
            <img src="./icons/filled_star.png" alt="">
          </div>

          <span class="total_count"> <?php echo count($reviews); ?> შეფასება</span>


          <div class="comments">
            <?php if ($reviews !== NULL) { ?>
              <?php foreach ($reviews as $review) { ?>
                <div class="comment-block">
                  <div class="user-data">
                    <img src="./user_images/avatars/<?php echo htmlspecialchars($review[4]); ?>" class="user-avatar" alt="">
                    <div class="name-rate">
                      <p><?php echo htmlspecialchars($review[1] . " " . $review[2]); ?></p>

                      <img src="./icons/filled_star.png" alt="">
                      <img src="./icons/filled_star.png" alt="">
                      <img src="./icons/filled_star.png" alt="">
                      <img src="./icons/filled_star.png" alt="">
                      <img src="./icons/filled_star.png" alt="">
                    </div>
                  </div>
                  <p class="comment"><?php echo htmlspecialchars($review[3]); ?></p>
                </div>
              <?php } ?>
            <?php } ?>
          </div>

          <div class="add_comment">
            <a href="#!" id="make_review">
              შეფასების დაწერა
            </a>

          </div>
        </div>



      </div>

    </div>
  </div>

  </div>



  <div class="section-2">
    <p class="we-offer">ჩვენ გთავაზობთ</p>
    <div class="other-products">

      <?php if ($randomProducts !== NULL) { ?>
        <?php foreach ($randomProducts as $key => $data) { ?>
          <?php 
            if( $key < 4):
          ?>
           <a href="?id=<?= $data['product_link'] ?>" style="text-decoration: none;">
          <div class="product" data-title="<?php echo htmlspecialchars($data['title']); ?>">
           
              <img src="./images/<?php echo htmlspecialchars($data['image']); ?>" alt="">
              <p class="product-title"><?php echo htmlspecialchars($data['title']); ?></p>
              <div class="about-price">
                <p class="sale-price"><?php echo $data['sale_price']; ?>₾</p>
                <p class="price"><?php echo $data['price']; ?>₾</p>

              </div>

              <div class="guarantee">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                  <rect width="24" height="24" fill="url(#pattern0)"></rect>
                  <defs>
                    <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                      <use xlink:href="#image0_4_37" transform="scale(0.0416667)"></use>
                    </pattern>
                    <image id="image0_4_37" width="24" height="24" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAADVElEQVRIidWVT2gcdRTHP29mJ3F3mwS8FLRUEEHUZPJnJ+iihyAETzUpiHhQ2iDtoV4yMSr10hC0YLTZpCpIldBiKYUepBBEFGzxsFWyk3R3W3sy0NLSf3pIpY3J7vyeh93UJdnJ+ufkOw1vPu/7/b33+M3A/z2kEdARjOxG9aBAKKrvqtAM8r5CKLC/4GWO/WuD7vm3HwpN6TIQi0DKDro98Kau/yODVG5vYlUSO8XgITKM8o2KzAh6AFQVa1zgddAXUJ1Si1yT3vsq8I7ca2iQyu11SiR/ArrvQyKv5VOTx2u5zmDkVVX9sia14HD36cA7UqrlrA09s+W5qvgN4JAqg+vFAfKpyeOqDAp8oHAd6A418ex6boOBavl29TGJY08UezOn1zPt877n5keTxd7MaXXsSYEtAAbza0ODgvfgz8AC0KKrxgNw86PJ9nnfA+iaG+6zDGe1FM6ms35cV8spoAU4X63d3KAzd+cwlREtaxgG6awf11I4axnOurnhUSMyCyQRWTyXbluRplgALANd1doGIxLdBWDUGrjwzPTNc+m2FUQWgSTIh0BSRWaKPa17kDFT6PzollFroLZ2cwO4AmCJ+dwN/B3ImCn2tO5RkZmKyF/iAG7g77DEfFFbu6mBpQwBl4BHUE6ks358zQSVXbXi6awfRzkBbAcu2cbsXq8XeZPdnH8D2CoxtuW7MtfqMZ3n/Ye1zFXgVsHLbK3HRH0CAB4AoCyfuDnfA37Esd8wyyWxY9bHCinKBFW2OUok0kDhe4Gdig5WUy9RLjdZjqDKi1XmUQCBb6N06o7oqcB/zFYuAI6q7rdVzxjL+g5oqyJLljH9xrb6Ud4DlkPMExe96cZLBrDRQ0CzKseKvVMTptm5DJgapFQqW78UUpmDICeBhK0y8bc6aJ97s98Ss9bykiKHUd0mwhDwNZXdPA98JrCksI/KTVa1TF+xZ/qHSIO+M2Ox31qW8gJP1jnMH6HQIahjqeQBpw6z8Pji1d5TL58KIzuoDTfn7wM+BVAYL3qZAwDunD+B8BaAigwVU5NHozTq7mAtHO4eBW4DV8Sx7884TKyMA9eAm7/faT25mUbDcOdGxjrm/IGNef+VjtzIO/9JHCq/z6h36awfb1T/J8CDXEtaSH3iAAAAAElFTkSuQmCC"></image>
                  </defs>
                </svg>

                <div class="text">
                  <p>გარანტია <?php echo $product["guarantee"]; ?></p>
                </div>
              </div>

           

          </div>
           </a>
           <?php endif?>
        <?php } ?>
      <?php } ?>
    </div>
  </div>
  <div id="about" class="main-about-us">
    <div class="container-about">
      <p>ჩვენ შესახებ</p>
      <pre>გამარჯობაოჯფისნოიფნს</pre>
      <pre></pre>
    </div>
  </div>
  <div id="contact" class="main-contact">
    <div class="container">
      <p>კონტაქტი</p>
      <div class="for-image">
        <div class="data-container">
          <div class="data-block">
            <img src="./icons/contact_clock.png" alt="">
            <div>
              <p>სამუშაო საათები</p>
              <p>ორშაბათი-პარასკევი (10:00 - 18:00)</p>
              <p>შაბათი (10:00 - 17:00)</p>
            </div>
          </div class="data-block">
          <div class="data-block">
            <img src="./icons/contact_phone.png" alt="">
            <div>
              <p>საკონტაქტო ნომერი</p>
              <p>+ (322) 555 555 5555</p>
            </div>
          </div>
          <div class="data-block">
            <img src="./icons/contact_location.png" alt="">
            <div>
              <p>მისამართი</p>
              <p>ვმუშაობთ მხოლოდ დისტანციურად</p>
            </div>
          </div>
          <div class="data-block">
            <img src="./icons/contact_mail.png" alt="">
            <div>
              <p>საკონტაქტო ელფოსტა</p>
              <p>info@buytech.ge</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php include 'footer.php'?>



  <!-- Pop up components-->
  <!--Buy component-->
  <!-- <div class="main-buy-now">
    <div class="main-buy-container">
      <div class="buy-now">
        <div class="head-component">
          <p>შეკვეთის გაფორმება</p>
          <img id="close_buy_now" src="./icons/x_image_for_review.png" alt="">
        </div>
        <p>ოპერატორი შეძენიდან რამდენიმე წუთში დაგიკავშირდებათ და გაგაცნობთ შეკვეთის დეტალებს</p>
        <form>
          <input type="text" placeholder="თქვენი სახელი/გვარი" class="preson-input" value="">
          <input type="text" pattern="[0-9]*" inputmode="numeric" maxlength="12" placeholder="თქვენი მობილურის ნომერი" class="preson-input phone" value="">
          <div class="privacy-checkbox">
            <div id="privacy_checkbox" class="checkbox">
              <input type="checkbox" name="" value="" checked>
              <img src="./icons/checked.png" alt="">
            </div>
            <p>ვეთანხმები<a href="#privacy-policy" target="_blank"> წესებსა და პირობებს</a></p>
          </div>
          <button id="make_order2" type="submit" name="button">შეკვეთა</button>
        </form>
      </div>
    </div>
  </div> -->
  <div class="main-order-received">
    <div class="order-received-container">
      <div class="order-received">
        <div class="head-component">
          <img src="./icons/order-success.png" alt="">
          <img id="close_order_received" src="./icons/x_image_for_review.png" alt="">
        </div>
        <p>თქვენი შეკვეთა მიღებულია</p>
        <p>ოპერატორი უახლოესი 30 წუთის განმავლობაში დაგიკავშირდებათ და გაგაცნობთ შეკვეთის დეტალებს</p>
        <p>გთხოვთ ყურადღებით იყავით მობილურთან.</p>
        <p style="color: #2133EA;">ჩვენი სამუშაო საათები: ორშაბათი - კვირა (10:00 - 19:00)</p>
      </div>
    </div>
  </div>
  <!--End Buy component-->
  <!-- Features -->
  <div class="main-feature">
    <div class="main-features-container">
      <div class="show-about">
        <div class="head-component">
          <p>მახასიათებლები</p>
          <img id="close_features" src="./icons/x_image_for_review.png" alt="">
        </div>
        <pre><?php echo htmlspecialchars($product["features"]); ?></pre>
      </div>
    </div>
  </div>
  <!-- End Features -->

  <!-- Review -->
  <div class="main-create-review" style="display: none;">
    <div class="main-container">
      <div class="create-review">
        <div class="head-component">
          <p>შეფასების დაწერა</p>
          <img id="close_review" src="./icons/x_image_for_review.png" alt="">
        </div>
        <div class="rate-component">
          <div class="text">
            <div id="review_stars" class="star-components" style="display: none;">
              <img src="./icons/full_filled_review_star.png" alt="">
              <img src="./icons/review_empty_star.png" alt="">
              <img src="./icons/review_empty_star.png" alt="">
              <img src="./icons/review_empty_star.png" alt="">
              <img src="./icons/review_empty_star.png" alt="">
            </div>
            <!-- <p>შეაფასეთ პროდუქტი</p> -->

          </div>
          <!-- <p>(5 ვარკსვლავი უმაღლესი შეფასება, 1 ვარსკვლავი დაბალი შეფასება)</p> -->
        </div>
        <form id="review_form">
          <div id="about_person" class="about-person">
            <input type="text" placeholder="თქვენი სახელი" value="">
            <input type="text" placeholder="თქვენი გვარი" value="">
          </div>
          <textarea id="comment" type="text" placeholder="კომენტარი" class="comment-input" value=""></textarea>
          <div class="upload">
            <div id="profile_file_upload" class="upload-file-component">
              <img src="./icons/upload_file.png" alt="">
              <p>პროფილის სურათი</p>
              <input type="file" id="profile_file_input" accept="image/jpeg, image/png" value="">
            </div>
            <!-- <div id="file_upload" class="upload-file-component">
              <img src="./icons/upload_file.png" alt="">
              <p>სურათის ატვირთვა</p>
              <input type="file" id="file_input" accept="image/jpeg, image/png" value="">
            </div> -->
          </div>
          <button id="add_review" type="submit" name="button">შეფასების დაწერა</button>
        </form>
      </div>
    </div>
  </div>

  <div class="main-review-received">
    <div class="review-received-container">
      <div class="review-received">
        <div class="head-component">
          <img src="./icons/order-success.png" alt="">
          <img id="close_review_received" src="./icons/x_image_for_review.png" alt="">
        </div>
        <p>მადლობა შეფასებისთვის</p>
        <p>მადლობა, რომ სარგებლობთ ჩვენი სერვისით 😍</p>
      </div>
    </div>
  </div>
  <!-- End Review -->
  <!-- Search result -->
  <div class="main-search">
    <div class="search-container">
      <div class="searched-data">

        <!--<div class="searched-product">
            <img src="./images/test-image.png" alt="">
            <div class="product-data">
              <p>(1600W) ბალახის სათიბი (ბენზინზე) LUX Garden</p>
              <div class="price-data">
                <p>300.00₾</p>
                <p>600.00₾</p>
                <p>-50%</p>
              </div>
            </div>
          </div>-->

      </div>
    </div>
  </div>
  <!-- End search result -->
  <!-- End pop up components-->

  <div class="bottom__mobile" style="display: none">

    <div class="data">
      <p class="sale-price"><?php echo $product["sale_price"]; ?>₾</p>
      <p class="price"><?php echo $product["price"]; ?>₾</p>
    </div>
    <div class="buyBtn">
      <a href="#form_area">
        შეკვეთა
      </a>
    </div>
  </div>


</body>


<script>
  (function() {
    $(document).ready(function() {
      countDown();
    });

    function countDown() {

      var currentdate = new Date();
      var start = currentdate.getFullYear() + '-' + String(currentdate.getMonth() + 1).padStart(2, '0') + '-' + currentdate.getDate() + ' ' + currentdate.getHours() + ":" + currentdate.getMinutes() + ":" + currentdate.getSeconds()
      var end = "<?= $product["end_date"] ?>";
     
      var startDate = new Date(start.replace(/-/g, "/"));
      var endDate = new Date(end.replace(/-/g, "/"));
      
 
      
  
     
      var diff = endDate.getTime() - startDate.getTime();
      var hours = Math.floor(diff / 1000 / 60 / 60);
      diff -= hours * (1000 * 60 * 60);
      var minutes = Math.floor(diff / 1000 / 60);
      diff -= minutes * (1000 * 60);
      var seconds = Math.floor(diff / 1000);

      if (hours < 0)
        hours = hours + 24;

      $('.time').text((hours <= 9 ? "0" : "") + hours + ":" + (minutes <= 9 ? "0" : "") + minutes + ":" + (seconds <= 9 ? "0" : "") + seconds);

      setTimeout(countDown, 1000);

    }
  })();
</script>



<script type="text/javascript">
  //add value from php
//   const end_time = new Date("<?php echo $product["end_date"]; ?>".replace(/ /g, "T")).getTime();
  const comment_quantity = ["<?php echo $total_rates; ?>"];
  const _info = {
    "mobile": false
  };
  //5,4,3,2,1
  const review_data = JSON.parse(<?php echo '"' . json_encode($rates_shablon_array) . '"'; ?>);
  const pr_id = "<?php echo $product_link; ?>";
</script>
<script src="./scripts/mobile.js" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="./scripts/main.js" type="text/javascript"></script>

</html>