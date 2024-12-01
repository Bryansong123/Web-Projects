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
          <li><a  href="index.php">Home</a></li>
          <li><a class="active" href="shop.php">Shop</a></li>
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

  <section id="page-header">
    
    <h2>#stayhome</h2>
    
    <p>Save more with coupons & up to 70% off!</p>
    
  </section>

  <section id="product1" class="section-p1">
    <div class="pro-container">
        <!-- Include the PHP file that fetches products with IDs 1 to 16 -->
        <?php
        include('server/get_featured_products.php'); // Assuming this file fetches the correct range
        $query = "SELECT * FROM products WHERE product_id BETWEEN 1 AND 16";
        $result = $conn->query($query);

        while($row = $result->fetch_assoc()) { ?>
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
                <!-- Update this link to pass the product ID -->
                <a href="sproduct.php?product_id=<?php echo $row['product_id']; ?>"><i class="fa fa-shopping-cart cart"></i></a>
            </div>
        <?php } ?>
    </div>
</section>
</section>


  <section id="pagination" class="section-p1">
    <a href="#">1</a>
    <a href="#">2</a>
    <a href="#"><i class="fa fa-long-arrow-right"></i></a>
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