<?php
session_start();
include('server/connection.php');

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page or prompt them to log in
    echo "<script>
            alert('You need to log in to place an order.');
            window.location.href = 'login.php'; // Redirect to login page
          </script>";
    exit;
}

// Get the user ID from the session
$user_id = $_SESSION['user_id'];  // Assuming 'user_id' is stored in session after login

if (isset($_POST['place_order'])) {
    // Step 1: Get user info from the form and store it in the orders table
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $order_cost = $_SESSION['total'];   // Assuming the total cost is stored in session
    $order_status = 'on_hold';          // Default order status (could be changed later)
    $order_date = date('Y-m-d H:i:s');  // Get current date and time

    // Insert the order into the orders table
    $stmt = $conn->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_city, user_address, order_date) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('isiisss', $order_cost, $order_status, $user_id, $phone, $city, $address, $order_date);
    
    if ($stmt->execute()) {
        $order_id = $stmt->insert_id;  // Get the ID of the newly created order
    } else {
        echo "Error placing order: " . $stmt->error;
        exit;
    }

    // Step 2: Get products from the cart (stored in session)
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        $cart_items = $_SESSION['cart'];  // Assuming cart is stored in session
        
        // Step 3: Store each product in the order_items table
        foreach ($cart_items as $item) {
            $product_id = $item['product_id'];       // Product ID from the cart
            $product_name = $item['product_name'];   // Product name from the cart
            $product_image = $item['product_image_url']; // Product image URL
            $order_date = date('Y-m-d H:i:s');       // Order date for each item

            // Insert each item into the order_items table
            $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, product_image_url, user_id, order_date) 
                                    VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('iissis', $order_id, $product_id, $product_name, $product_image, $user_id, $order_date);
            
            if (!$stmt->execute()) {
                echo "Error adding item to order: " . $stmt->error;
                exit;
            }
        }

        // Step 4: Remove everything from the cart
        unset($_SESSION['cart']);
        unset($_SESSION['total']);  // Assuming total is also stored in session

        // Step 5: Inform the user and redirect them to the home page
        echo "<script>
                alert('Your order has been placed successfully!');
                window.location.href = 'index.php'; // Redirect to the home page
              </script>";
    } else {
        echo "Your cart is empty!";
    }
} else {
    echo "No order placed!";
}
?>
