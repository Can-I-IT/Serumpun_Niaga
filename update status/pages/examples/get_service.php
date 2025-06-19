<?php
// Database connection
$conn = new mysqli("localhost", "root", "Safwan1234.", "serumpun_db");

// Check DB connection
if ($conn->connect_error) {
    http_response_code(500);
    die("Database connection failed: " . $conn->connect_error);
}

// Get service ID from POST
$service_id = $_POST['id'] ?? '';

if (!is_numeric($service_id)) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid service ID."]);
    exit;
}

// Prepare query to fetch service
$stmt = $conn->prepare("SELECT * FROM services WHERE service_id = ?");
$stmt->bind_param("i", $service_id);
$stmt->execute();
$result = $stmt->get_result();

// Return as JSON
if ($result->num_rows > 0) {
    $service = $result->fetch_assoc();
    echo json_encode($service);
} else {
    http_response_code(404);
    echo json_encode(["error" => "Service not found."]);
}

$stmt->close();
$conn->close();
?>
