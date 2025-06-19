<?php
$conn = new mysqli("localhost", "root", "Safwan1234.", "serumpun_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$order_id = intval($_POST['order_id']);
$new_status = $_POST['order_status'];

if (!in_array($new_status, ['Pending', 'Confirmed', 'Completed'])) {
    echo "Invalid status.";
    exit;
}

$sql = "UPDATE orders SET order_status = ? WHERE order_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $new_status, $order_id);

if ($stmt->execute()) {
    echo "Order status updated successfully!";
} else {
    echo "Failed to update status.";
}

$conn->close();
?>
