<?php
session_start();


// Ensure total is initialized if not already set
if (!isset($_SESSION['total'])) {
  $_SESSION['total'] = 0;
}

//check if the user click on the add to cart button
if (isset($_POST['add_to_cart'])) {
  //if user has already added a product to cart
  if (isset($_SESSION['cart'])) {
    $products_array_ids = array_column($_SESSION['cart'], "product_id"); //[2,3,4,10,15]

    //if product has already been added to cart or not
    if (!in_array($_POST['product_id'], $products_array_ids)) {

      $product_id = $_POST['product_id'];

      $product_array = array(
        'product_id' => $_POST['product_id'],
        'product_name' => $_POST['product_name'],
        'product_price' => $_POST['product_price'],
        'product_image_url' => $_POST['product_image_url'],
        'product_quantity' => $_POST['product_quantity']
      );

      $_SESSION['cart'][$product_id] = $product_array;

      //product has already been added  
    } else {
      echo '<script>alert("Product was already added to cart")</script>';
    }



    //if this is the first product
  } else {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image_url = $_POST['product_image_url'];
    $product_quantity = $_POST['product_quantity'];

    $product_array = array(
      'product_id' => $product_id,
      'product_name' => $product_name,
      'product_price' => $product_price,
      'product_image_url' => $product_image_url,
      'product_quantity' => $product_quantity
    );

    $_SESSION['cart'][$product_id] = $product_array;
    //[2=>[]]
  }

  calculateTotalCart();

  //remove product
} else if (isset($_POST['remove_product'])) {
  $product_id = $_POST['product_id_to_remove'];
  unset($_SESSION['cart'][$product_id]);

  calculateTotalCart();
} else {
  header('location:index.php');
}


function calculateTotalCart()
{
  $total = 0;

  foreach ($_SESSION['cart'] as $key => $value) {
    $product = $_SESSION['cart'][$key];
    $price = $product['product_price'];
    $quantity = $product['product_quantity'];
    $total = $total + ($price * $quantity);  // Correct calculation

  }

  $_SESSION['total'] = $total;
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
        <li id="lg-bag"><a class="active" href="cart.php"><i class="fa-solid fa-bag-shopping"></i></a></li>
        <li id="account"><a href="account.php"><i class="fa-solid fa-user"></i></a></li>
        <a href="#" id="close"><i class="fa fa-times"></i></a>
      </ul>
    </div>

    <div id="mobile">
      <a href="cart.php"><i class="fa fa-bag-shopping"></i></a>
      <i id="bar" class="fa fa-outdent"></i>

    </div>
  </section>

  <section id="page-header" class="about-header">

    <h2>#let's talk</h2>

    <p>LEAVE A MESSAGE, We love to hear from you!</p>

  </section>

  <section id="cart" class="section-p1">
    <table width="100%">
      <thead>
        <tr>
          <td>Remove</td>
          <td>Image</td>
          <td>Product</td>
          <td>Price</td>
          <td>Quantity</td>
          <td>Subtotal</td>
        </tr>
      </thead>

      <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
        <tbody>
          <tr>
            <td>
              <!-- Remove Product Button -->
              <form method="POST" action="cart.php">
                <input type="hidden" name="product_id_to_remove" value="<?php echo $value['product_id']; ?>" />
                <input type="submit" name="remove_product" class="remove-btn" value="Remove" />
              </form>
            </td>
            <td><img src="<?php echo $value['product_image_url']; ?>"></td>
            <td><?php echo $value['product_name']; ?></td>
            <td>$<?php echo $value['product_price']; ?></td>
            <td><?php echo $value['product_quantity']; ?></td>
            <td class="subtotal">$<?php echo $value['product_price'] * $value['product_quantity']; ?></td> <!-- Updated subtotal calculation -->
          </tr>
        </tbody>
      <?php } ?>
    </table>
  </section>


  <section id="cart-add" class="section-p1">
    <div id="coupon">
      <h3>Apply Coupon</h3>
      <div>
        <input type="text" placeholder="Enter Your Coupon">
        <button class="normal">Apply</button>
      </div>
    </div>

    <div id="subtotal">
      <h3>Cart Totals</h3>
      <table>
        <tr>
          <td>Cart Subtotal</td>
          <td>$ <?php echo $_SESSION['total']; ?></td>
        </tr>
        <tr>
          <td>Shipping</td>
          <td>Free</td>
        </tr>
        <tr>
          <td><strong>Total</strong></td>
          <td><strong>$ <?php echo $_SESSION['total']; ?></strong></td>
        </tr>
      </table>
      <div class="checkout-container">
        <form method="POST" action="checkout.php ">
          <input type="submit" class="checkout_btn" value="Checkout" name="checkout">
        </form>
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