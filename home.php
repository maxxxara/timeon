<?php


  include("./classes/product_db_class.php");
  $product_db = new Product_db();

  $other_products = $product_db->load_other_products(null,32);
  $weekly_products = $product_db->load_weekly_promotion_product(null,32);

?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="facebook-domain-verification" content="0y7irmdtv8c408rvr4yivyqo9fdrb6" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <meta property="og:url" content="https://buytech.ge/">
    <meta property="og:site_name" content="Buytech.ge">
    <meta property="og:title" content="Buytech | ონლაინ მაღაზია"/>
    <meta property="og:type" content="website">
    <meta property="og:image:width" content="1640"/>
    <meta property="og:image:height" content="720"/>
    <meta property="og:image" content="./site_images/main.png" />
    <meta property="og:description" content="" />
    <meta name="facebook-domain-verification" content="vepy8dztkp20q6rqi216diz8kpvwhe" />
    <title>BuyTech | ონლაინ მაღაზია</title>
    <link rel="icon" type="image/x-icon" href="./icons/favicon.ico">
    <link rel="apple-touch-icon" href="./icons/apple-touch-icon.png">
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" href="./css/components.css">
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
  </head>
  <body>
    <header>
      <div class="header">
        <div class="left-side-head">
          <img id="market" src="./icons/logo.png" class="marketplace" alt="">
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
          <img id="show_main_mobile" src="./icons/logo.png" alt="">
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
    <div class="section-0">
      <p class="title">მიწოდება საქართველოს მასშტაბით</p>
      <div class="photos-container">
            <div id="left_slider_button" class="slider-button left-slider-button">
              <img src="./icons/arrow.png" alt="">
            </div>
            <div id="images" class="photos">
                <img src="./site_images/mobiluri.png" class="mobile" alt="">
                <img src="./site_images/dekstopi.png" class="desktop" alt="">

            </div>
            <div id="right_slider_button" class="slider-button">
              <img src="./icons/arrow.png" alt="">
            </div>
          </div>
    </div>


    <div class="section-2">
      <p class="we-offer">ჩვენ გირჩევთ</p>
      <div class="other-products" id="other_products">
        <?php if($other_products !== NULL){ ?>
          <?php foreach ($other_products as $data) { ?>
            <div class="product" data-title="<?php echo htmlspecialchars($data[0]); ?>">
              <img src="./images/<?php echo htmlspecialchars($data[4]);?>" alt="">
              <p class="product-title"><?php echo htmlspecialchars($data[1]);?></p>
              <div class="about-price">
                <p class="sale-price"><?php echo $data[2];?>₾</p>
                <p class="price"><?php echo $data[3];?>₾</p>
                <p class="percentage">-<?php echo round((($data[3]-$data[2])/$data[3])*100); ?>%</p>
              </div>
            </div>
          <?php } ?>
        <?php } ?>
      </div>
    </div>

    <div class="section-1">
    </div>

    <div class="section-2">
      <p class="we-offer">კვირის აქცია</p>
      <div class="other-products" id="weekly_promotion">
        <?php if($other_products !== NULL){ ?>
          <?php foreach ($weekly_products as $data) { ?>
            <div class="product" data-title="<?php echo htmlspecialchars($data[0]); ?>">
              <img src="./images/<?php echo htmlspecialchars($data[4]);?>" alt="">
              <p class="product-title"><?php echo htmlspecialchars($data[1]);?></p>
              <div class="about-price">
                <p class="sale-price"><?php echo $data[2];?>₾</p>
                <p class="price"><?php echo $data[3];?>₾</p>
                <p class="percentage">-<?php echo round((($data[3]-$data[2])/$data[3])*100); ?>%</p>
              </div>
            </div>
          <?php } ?>
        <?php } ?>
      </div>
    </div>
    <div class="section-1">
    </div>
    <div id="about" class="main-about-us">
      <div class="container-about">
        <p>ჩვენ შესახებ</p>
        <pre></pre>
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
    <footer>
      <div class="footer">
        <div>
          <a href="#about-us">ჩვენ შესახებ</a>
          <a href="#contact-page">კონტაქტი</a>
          <a href="#requisite">რეკვიზიტები</a>
          <a href="#deliver">მიწოდება</a>
        </div>
        <div>
          <a href="#FAQ">FAQ</a>
          <a href="#privacy-policy">კონფიდენციალურობა</a>
        </div>
        <div class="last">
          <img src="./icons/facebook_icon.png" onclick="window.open('https://www.facebook.com/Buytechge-ონლაინ-მაღაზია-101123204708452/','_blank')" alt="">
          <img src="./icons/instagram_icon.png" alt="">
        </div>
      </div>
    </footer>

    <!-- Pop up components-->
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
  </body>
<script>
  const _info = {"mobile":false};
</script>
<script src="./scripts/home_mobile.js" type="text/javascript"></script>
<script src="./scripts/home_main.js" type="text/javascript"></script>

</html>
