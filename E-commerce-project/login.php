<?php
// Start the session (for user management after login)
session_start();

// Include the database connection file
include('server/connection.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect and sanitize the form data
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Query the database to find the user by email
    $stmt = $conn->prepare("SELECT user_id, user_name, user_password FROM users WHERE user_email = ?");
    $stmt->bind_param('s', $email); // 's' for string (email)

    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($user_id, $user_name, $user_password);

    // Check if user exists
    if ($stmt->num_rows > 0) {
        // Fetch user data
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $user_password)) {
            // Password is correct, set session variables
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;

            // Redirect to home or dashboard after successful login
            header("Location: index.php"); // Replace with the page you want to redirect
            exit;
        } else {
            // Invalid password, set error message
            $_SESSION['error_message'] = "Incorrect password!";
            header("Location: login.php"); // Redirect back to the login page
            exit;
        }
    } else {
        // Email not found, set error message
        $_SESSION['error_message'] = "No account found with that email!";
        header("Location: login.php"); // Redirect back to the login page
        exit;
    }

    // Close the prepared statement
    $stmt->close();
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
  <section class="my-5 py-5 section-p1">
    <div class="container text-center nt-3 pt-5">
      <h2 class="form-weight-bold" id="login">Login</h2>
    </div>

    <div class="mx-auto container">
      <!-- Added action="login.php" and method="POST" -->
      <form id="login-form" action="login.php" method="POST">
        <div class="form-group">
          <label for="login-email">Email</label><br>
          <input type="text" class="form-control" id="login-email" name="email" placeholder="Email" required>
        </div>

        <div class="form-group">
          <label for="login-password">Password</label><br>
          <input type="password" class="form-control" id="login-password" name="password" placeholder="Password" required>
        </div>

        <div class="form-group">
          <input type="submit" class="btn" id="login-btn" value="Login">
        </div>

        <div class="form-group">
          <a href="register.php" class="btn" id="register-url">Don't have an account? Register</a>
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
  <script>
    // Display error message in alert if there is one set in session
    window.onload = function () {
      <?php
        if (isset($_SESSION['error_message'])) {
          // Pass the error message to JavaScript
          echo 'alert("' . $_SESSION['error_message'] . '");';
          unset($_SESSION['error_message']); // Clear the error message after displaying
        }
      ?>
    }
  </script>
</body>

</html>
