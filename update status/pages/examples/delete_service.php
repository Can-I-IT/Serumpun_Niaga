<?php
// Database connection
$conn = new mysqli("localhost", "root", "Safwan1234.", "serumpun_db");

// Check for connection error
if ($conn->connect_error) {
    http_response_code(500);
    die("Database connection failed: " . $conn->connect_error);
}

// Get service ID
$service_id = $_POST['id'] ?? '';

if (!is_numeric($service_id)) {
    http_response_code(400);
    echo "Invalid service ID.";
    exit;
}

// Prepare and execute delete query
$stmt = $conn->prepare("DELETE FROM services WHERE service_id = ?");
$stmt->bind_param("i", $service_id);

if ($stmt->execute()) {
    http_response_code(200);
    echo "Service deleted successfully.";
} else {
    http_response_code(500);
    echo "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
