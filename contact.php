
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
  <!-- Facebook Pixel Code -->
  <script>
    ! function(f, b, e, v, n, t, s) {
      if (f.fbq) return;
      n = f.fbq = function() {
        n.callMethod ?
          n.callMethod.apply(n, arguments) : n.queue.push(arguments)
      };
      if (!f._fbq) f._fbq = n;
      n.push = n;
      n.loaded = !0;
      n.version = '2.0';
      n.queue = [];
      t = b.createElement(e);
      t.async = !0;
      t.src = v;
      s = b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
      'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '580326939697618');
    fbq('track', 'PageView');
  </script>
  <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=580326939697618&ev=PageView&noscript=1" /></noscript>
  <!-- End Facebook Pixel Code -->

  <title>BuyTech | ონლაინ მაღაზია</title>
  <link rel="icon" type="image/x-icon" href="./icons/favicon.ico">
  <link rel="stylesheet" href="./css/index.css">
  <link rel="stylesheet" href="./css/components.css">
  <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
</head>

<body>
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
        <a href="#deliver">მიწოდება</a>
        <a href="#contact-page">კონტაქტი</a>
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

   
  </div>

  </div>


 <div id="contact" class="main-contact" style="display: block;">
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
<script type="text/javascript">
  //add value from php
  const end_time = new Date("<?php echo $product["end_date"]; ?>".replace(/ /g, "T")).getTime();
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
<script>
  (function() {
    $(document).ready(function() {
      countDown();
    });

    function countDown() {

      var currentdate = new Date();
      var start = currentdate.getFullYear() + '-' + String(currentdate.getMonth() + 1).padStart(2, '0') + '-' + currentdate.getDate() + ' ' + currentdate.getHours() + ":" + currentdate.getMinutes() + ":" + currentdate.getSeconds()
      var end = "<?= $product["end_date"] ?>";

      var startDate = new Date(start);
      var endDate = new Date(end);
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
<script src="./scripts/main.js" type="text/javascript"></script>

</html>