<?php
// Database connection
$conn = new mysqli("localhost", "root", "Safwan1234.", "serumpun_db");

// Check connection
if ($conn->connect_error) {
    http_response_code(500);
    die("Connection failed: " . $conn->connect_error);
}

// Collect and validate inputs
$id = $_POST['service_id'] ?? '';
$name = $_POST['service_name'] ?? '';
$category = $_POST['service_category'] ?? '';
$price = $_POST['service_price'] ?? '';

if (empty($id) || empty($name) || empty($category) || !is_numeric($price)) {
    http_response_code(400);
    echo "Invalid input. Please check all fields.";
    exit();
}

// Use prepared statement for safety
$stmt = $conn->prepare("UPDATE services SET service_name = ?, service_category = ?, service_price = ? WHERE service_id = ?");
$stmt->bind_param("ssdi", $name, $category, $price, $id);

if ($stmt->execute()) {
    echo "Service updated successfully.";
} else {
    http_response_code(500);
    echo "Failed to update service.";
}

$stmt->close();
$conn->close();
?>
