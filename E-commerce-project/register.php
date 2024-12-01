<?php
// Start the session (to handle redirects or user-related actions later)
session_start();

// Include the database connection file
include('server/connection.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect and sanitize the form data
    $user_name = mysqli_real_escape_string($conn, $_POST['name']);
    $user_email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    // Validate the input
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit;
    }

    // Hash the password before storing it
    $user_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user data into the users table
    $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_password) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $user_name, $user_email, $user_password); // 'sss' for 3 strings

    // Execute the statement and check if it was successful
    if ($stmt->execute()) {
        // Redirect to the login page after successful registration
        header("Location: login.php");
        exit;
    } else {
        echo "Error registering user: " . $stmt->error;
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E Commerce - Register</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://kit.fontawesome.com/7718a9f8e6.js" crossorigin="anonymous"></script>
</head>

<body>
  <section class="my-5 py-5 section-p1">
    <div class="container text-center nt-3 pt-5">
      <h2 class="form-weight-bold" id="login">Register</h2> <!-- Fixed unclosed h2 tag -->
    </div>

    <div class="mx-auto container">
      <!-- Form to register a new user -->
      <form id="register-form" action="register.php" method="POST">
        <div class="form-group">
          <label for="register-name">Name</label><br>
          <input type="text" class="form-control" id="register-name" name="name" placeholder="Name" required>
        </div>
        <div class="form-group">
          <label for="register-email">Email</label><br>
          <input type="text" class="form-control" id="register-email" name="email" placeholder="Email" required>
        </div>

        <div class="form-group">
          <label for="register-password">Password</label><br>
          <input type="password" class="form-control" id="register-password" name="password" placeholder="Password" required>
        </div>

        <div class="form-group">
          <label for="register-confirm-password">Confirm Password</label><br>
          <input type="password" class="form-control" id="register-confirm-password" name="confirm-password" placeholder="Confirm Password" required>
        </div>

        <div class="form-group">
          <input type="submit" class="btn" id="register-btn" value="Register">
        </div>

        <div class="form-group">
          <a href="login.php" class="btn" id="register-url">Do you have an account? Login</a>
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
