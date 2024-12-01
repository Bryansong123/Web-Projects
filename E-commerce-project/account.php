<?php
session_start();
include('server/connection.php');

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page if not logged in
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id']; // Get user ID from the session

// Fetch the user's account info (user_name and email)
$query = "SELECT user_name, user_email FROM users WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($user_name, $user_email);
$stmt->fetch();

// Fetch the user's orders
$order_query = "SELECT oi.product_name, oi.order_date, p.product_image_url 
                FROM order_items oi 
                JOIN orders o ON oi.order_id = o.order_id 
                JOIN products p ON oi.product_id = p.product_id
                WHERE o.user_id = ? ORDER BY o.order_date DESC";
$order_stmt = $conn->prepare($order_query);
$order_stmt->bind_param("i", $user_id);
$order_stmt->execute();
$order_stmt->store_result();
$order_stmt->bind_result($product_name, $order_date, $product_image_url);
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
  <!-- Your HTML content goes here -->
  <section id="header">
    <a href="#"><img src="img/bs.png" class="logo"></a>

    <div>
      <ul id="navbar">
          <li><a  href="index.php">Home</a></li>
          <li><a  href="shop.php">Shop</a></li>
          <li><a  href="blog.html">Blog</a></li>
          <li><a  href="about.html">About</a></li>
          <li><a  href="contact.html">Contact</a></li>
          <li id="lg-bag"><a href="cart.php"><i class="fa-solid fa-bag-shopping"></i></a></li>
          <li id="account"><a class="active" href="account.php"><i class="fa-solid fa-user"></i></a></li>
          <a href="#" id="close"><i class="fa fa-times"></i></a>
      </ul>
    </div>

    <div id="mobile">
      <a href="cart.php"><i class="fa fa-bag-shopping"></i></a>
      <i id="bar" class="fa fa-outdent"></i>
      
    </div>
  </section>
  
  <section class="my-5 py-5">
    <div class="container">
      <div class="row">
        <!-- Account Info Section -->
        <div class="col-lg-6 col-md-12 col-sm-12">
          <form id="account-form">
            <h3 class="font-weight-bold" id="login">Account Info</h3>
            <hr class="mx-auto">
            <div class="account-info">
              <p><span><?php echo htmlspecialchars($user_name); ?></span></p>
              <p><span><?php echo htmlspecialchars($user_email); ?></span></p>
              <p><a href="#" id="orders-btn">Your Orders</a></p>
              <p><a href="login.php" id="logout-btn">Logout</a></p>
            </div>
          </form>
        </div>

        <!-- Change Password Section -->
        <div class="col-lg-6 col-md-12 col-sm-12">
          <form id="account-form">
            <h3 id="login">Change Password</h3>
            <hr class="mx-auto">
            <div class="form-group">
              <label>Password</label><br>
              <input type="password" class="form-control" id="account-password" name="password" placeholder="Password">
            </div>

            <div class="form-group">
              <label>Confirm Password</label><br>
              <input type="password" class="form-control" id="account-password-confirm" name="confirmPassword" placeholder="Confirm Password">
            </div>

            <div class="form-group">
              <input type="submit" value="Change Password" class="btn" id="change-password">
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <section class="orders container my-5 py-3">
    <div class="container mt-5">
      <h3 class="font-weight-bold" id="login">Your Orders</h3>
      <hr class="mx-auto">
    </div>

    <table class="mt-5 pt-5">
      <tr>
        <th>Product</th>
        <th>Date</th>
      </tr>
      <?php while ($order_stmt->fetch()) { ?>
      <tr>
        <td>
          <div class="product-info">
            <img src="<?php echo htmlspecialchars($product_image_url); ?>" alt="Product Image" />
            <div>
              <p class="mt-3"><?php echo htmlspecialchars($product_name); ?></p>
            </div>
          </div>
        </td>

        <td>
          <span><?php echo htmlspecialchars($order_date); ?></span>
        </td>
      </tr>
      <?php } ?>
    </table>
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
