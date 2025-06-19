<?php
// DB connection
$conn = new mysqli("localhost", "root", "Safwan1234.", "serumpun_db");

// Check for DB error
if ($conn->connect_error) {
    http_response_code(500);
    die("Database connection failed: " . $conn->connect_error);
}

// Get and sanitize POST data
$service_name     = $_POST['service_name'] ?? '';
$service_category = $_POST['service_category'] ?? '';
$service_price    = $_POST['service_price'] ?? '';

// Validate inputs
if (empty($service_name) || empty($service_category) || $service_price === '') {
    http_response_code(400);
    echo "Missing required fields.";
    exit;
}

// Prepare and insert
$stmt = $conn->prepare("INSERT INTO services (service_name, service_category, service_price) VALUES (?, ?, ?)");
$stmt->bind_param("ssd", $service_name, $service_category, $service_price);

if ($stmt->execute()) {
    http_response_code(200);
    echo "Service added successfully.";
} else {
    http_response_code(500);
    echo "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
