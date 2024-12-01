<?php
session_start();

if(!empty($_SESSION['cart']) && isset($_POST['checkout'])){
  //let user in




  //send user to home page

}else{
  header('location:index.php');
}

?>




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
        <li><a href="index.php">Home</a></li>
        <li><a href="shop.php">Shop</a></li>
        <li><a href="blog.html">Blog</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="contact.html">Contact</a></li>
        <li id="lg-bag"><a href="cart.html"><i class="fa-solid fa-bag-shopping"></i></a></li>
        <li id="account"><a href="account.php"><i class="fa-solid fa-user"></i></a></li>
        <a href="#" id="close"><i class="fa fa-times"></i></a>
      </ul>
    </div>

    <div id="mobile">
      <a href="cart.php"><i class="fa fa-bag-shopping"></i></a>
      <i id="bar" class="fa fa-outdent"></i>
    </div>
  </section>


  <section class="my-5 py-5">
    <div class="container text-xenter mt-3 pt-5">
      <h3 class="font-weight-bold" id="login">Check Out</h3>
      <hr class="mx-auto">
    </div>
    <div class="mx-auto container">
      <form id="checkout-form" method="POST" action="place_order.php">


        <div class="form-group checkout-small-element">
          <label>Name</label><br>
          <input type="text" class="form-control" id="checkout-name" name="name" placeholder="Name" required>
        </div>

        <div class="form-group checkout-small-element">
          <label>Email</label><br>
          <input type="email" class="form-control" id="checkout-email" name="email" placeholder="Email" required>
        </div>

        <div class="form-group checkout-small-element">
          <label>Phone</label><br>
          <input type="tel" class="form-control" id="checkout-phone" name="phone" placeholder="Phone" required>
        </div>

        <div class="form-group checkout-small-element">
          <label>City</label><br>
          <input type="text" class="form-control" id="checkout-city" name="city" placeholder="City" required>
        </div>

        <div class="form-group checkout-large-element">
          <label>Address</label><br>
          <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Address" rows="3" required></textarea>
        </div>

        <div class="form-group checkout-btn-container">
          <p>Total amount:$<?php echo $_SESSION['total'];?></p>
          <input type="submit" class="btn" id="checkout-btn" name="place_order" value="Place Order">
        </div>
      </form>
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