<?php
include('connection.php');

// Prepare the SQL query
$stmt = $conn->prepare("SELECT * FROM products LIMIT 8");
$stmt->execute();

// Store the result
$featured_products = $stmt->get_result();
?>
