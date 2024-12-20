<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E Commerce</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://kit.fontawesome.com/7718a9f8e6.js" crossorigin="anonymous"></script>
</head>

<body>
  <section id="header">
    <a href="#"><img src="img/bs.png" class="logo"></a>

    <div>
      <ul id="navbar">
        <li><a class="active" href="index.php">Home</a></li>
        <li><a href="shop.php">Shop</a></li>
        <li><a href="blog.html">Blog</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="contact.html">Contact</a></li>
        <li id="lg-bag"><a href="cart.php"><i class="fa-solid fa-bag-shopping"></i></a></li>
        <li id="account"><a href="account.php"><i class="fa-solid fa-user"></i></a></li>
        <a href="#" id="close"><i class="fa fa-times"></i></a>
      </ul>
    </div>

    <div id="mobile">
      <a href="cart.php"><i class="fa fa-bag-shopping"></i></a>
      <i id="bar" class="fa fa-outdent"></i>

    </div>
  </section>

  <section id="hero">
    <h4>Trade-in-offer</h4>
    <h2>Super value deals</h2>
    <h1>On all products</h1>
    <p>Save more with coupons & up to 70% off!</p>
    <a href="shop.php">
      <button>Shop Now</button>
    </a>
  </section>

  <section id="feature" class="section-p1">
    <div class="fe-box">
      <img src="img/features/f1.png" alt="">
      <h6>Free Shipping </h6>
    </div>
    <div class="fe-box">
      <img src="img/features/f2.png" alt="">
      <h6>Online Order </h6>
    </div>
    <div class="fe-box">
      <img src="img/features/f3.png" alt="">
      <h6>Save Money </h6>
    </div>
    <div class="fe-box">
      <img src="img/features/f4.png" alt="">
      <h6>Promotions </h6>
    </div>
    <div class="fe-box">
      <img src="img/features/f5.png" alt="">
      <h6>Happy Sell</h6>
    </div>

    <div class="fe-box">
      <img src="img/features/f6.png" alt="">
      <h6>F24/7 Support</h6>
    </div>

  </section>

  <section id="product1" class="section-p1">
    <h2>Featured Sneakers</h2>
    <p>Summer Collection New Modern Designs</p>
    <div class="pro-container">
      <!-- Include the PHP file that fetches the featured products -->
      <?php include('server/get_featured_products.php'); ?>

      <?php while ($row = $featured_products->fetch_assoc()) { ?>
        <div class="pro">
          <img src="<?php echo $row['product_image_url']; ?>" alt="">
          <div class="des">
            <span class="p-brand"><?php echo $row['product_brand']; ?></span>
            <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
            <div class="star">
              <?php
              $full_stars = floor($row['product_rating']);
              $half_star = ($row['product_rating'] - $full_stars) >= 0.5;
              for ($i = 0; $i < $full_stars; $i++) echo '<i class="fa fa-star"></i>';
              if ($half_star) echo '<i class="fa fa-star-half-alt"></i>';
              ?>
            </div>
            <h4 class="p-price">$<?php echo number_format($row['product_price'], 2); ?></h4>
          </div>
          <a href="sproduct.php?product_id=<?php echo $row['product_id']; ?>"><i class="fa fa-shopping-cart cart"></i></a>
        </div>
      <?php } ?>
    </div>
  </section>


  <section id="banner" class="section-m1">
    <h4>Repair Services</h4>
    <h2>Up to <span>70% Off</span> - All T-Shirts & Accessories</h2>
    <button class="normal">Explore More</button>

  </section>

  <section id="product1" class="section-p1">
    <h2>More Sneakers</h2>
    <p>Discover the Latest Trends</p>
    <div class="pro-container">
      <!-- Include the PHP file that fetches products with IDs 9 to 16 -->
      <?php
      include('server/get_featured_products.php'); // Assuming this file fetches the correct range
      $query = "SELECT * FROM products WHERE product_id BETWEEN 9 AND 16";
      $result = $conn->query($query);

      while ($row = $result->fetch_assoc()) { ?>
        <div class="pro">
          <img src="<?php echo $row['product_image_url']; ?>" alt="">
          <div class="des">
            <span class="p-brand"><?php echo $row['product_brand']; ?></span>
            <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
            <div class="star">
              <?php
              $full_stars = floor($row['product_rating']);
              $half_star = ($row['product_rating'] - $full_stars) >= 0.5;
              for ($i = 0; $i < $full_stars; $i++) echo '<i class="fa fa-star"></i>';
              if ($half_star) echo '<i class="fa fa-star-half-alt"></i>';
              ?>
            </div>
            <h4 class="p-price">$<?php echo number_format($row['product_price'], 2); ?></h4>
          </div>
          <a href="sproduct.php?product_id=<?php echo $row['product_id']; ?>"><i class="fa fa-shopping-cart cart"></i></a>
        </div>
      <?php } ?>
    </div>
  </section>


  <section id="sm-banner" class="section-p1">
    <div class="banner-box">
      <h4>Exclusive Offers</h4>
      <h2>Buy 2 Get 1 Free</h2>
      <span>Discover the latest sneaker trends at BS</span>
      <button class="white">Shop Now</button>
    </div>

    <div class="banner-box banner-box2">
      <h4>New Arrivals</h4>
      <h2>Spring/Summer Collection</h2>
      <span>Grab the hottest sneakers of the season at BS</span>
      <button class="white">Explore Collection</button>
    </div>
  </section>

  <section id="banner3">
    <div class="banner-box">
      <h2>SEASONAL SALE</h2>
      <h3>Winter Collection - 50% Off</h3>
    </div>

    <div class="banner-box banner-box2">
      <h2>NEW FOOTWEAR COLLECTION</h2>
      <h3>Spring / Summer 2022 Sneakers</h3>
    </div>

    <div class="banner-box banner-box3">
      <h2>SNEAKER STYLES</h2>
      <h3>Check Out the Latest Designs</h3>
    </div>
  </section>

  <section id="newsletter" class="section-p1 section-m1">
    <div class="newstext">
      <h4>Sign Up For Newsletter</h4>
      <p>Get E-mail updates about our latest shop <span>special offers.</span>
      </p>
    </div>
    <div class="form">
      <input type="text" placeholder="Your email address">
      <button class="normal">Sign Up</button>
    </div>
    </div>
  </section>

  <footer class="section-p1">
    <div class="col">
      <img class="logo" src="img/bs.png" alt="">
      <h4>Contact</h4>
      <p><strong>Address:</strong> 5, Jalan Universiti, Bandar Sunway, 47500 Petaling Jaya, Selangor</p>

      <p><strong>Phone:</strong> (+60)125993700 </p>

      <p><strong>Hours:</strong> 10:00 - 18:00, Mon-Sat</p>

      <div class="follow">
        <h4>Follow us</h4>
        <div class="icon">
          <i class="fab fa-facebook-f"></i>
          <i class="fab fa-twitter"></i>
          <i class="fab fa-instagram"></i>
          <i class="fab fa-pinterest"></i>
          <i class="fab fa-youtube"></i>
        </div>
      </div>
    </div>

    <div class="col">
      <h4>About</h4>
      <a href="#">About us</a>
      <a href="#">Delivery Information</a>
      <a href="#">Privacy Policy</a>
      <a href="#">Terms and Conditions</a>
      <a href="#">Contact us</a>
    </div>

    <div class="col">
      <h4>My Account</h4>
      <a href="#">Sign In</a>
      <a href="#">View Cart</a>
      <a href="#">My Wishlist</a>
      <a href="#">Track My Order</a>
      <a href="#">Help</a>
    </div>


    <div class="col install">
      <h4>Install App</h4>
      <p>From App Store and Google Play</p>
      <div class="row">
        <img src="img/pay/app.jpg" alt="">
        <img src="img/pay/play.jpg" alt="">
      </div>
      <p>Secured Payment Gateways</p>
      <img src="img/pay/pay.png" alt="">
    </div>

    <div class="copyright">
      <p>© 2022, Tech2 etc - HTML CSS Ecommerce Template</p>
    </div>
  </footer>

  <script src="script.js"></script>
</body>

</html>