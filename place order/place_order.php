<?php
session_start();
if (!isset($_SESSION['customer_id'])) {
    die("Access denied. Please log in.");
}

$conn = new mysqli("localhost", "root", "Safwan1234.", "serumpun_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function clean($data, $conn) {
    return mysqli_real_escape_string($conn, trim($data));
}

$customer_id = $_SESSION['customer_id'];
$orderDate = date("Y-m-d H:i:s");

// Retrieve form inputs
$paperSize   = intval($_POST['paper_size']);
$printType   = intval($_POST['print_type']);
$binding     = intval($_POST['binding']);
$numCopies   = intval($_POST['file']);
$message     = clean($_POST['message'], $conn);

// Insert into printing_details
$printing_sql = "INSERT INTO printing_details (print_type_id, number_of_copies, paper_size_id, binding_id, additional_message)
                 VALUES ('$printType', '$numCopies', '$paperSize', '$binding', '$message')";
if (!$conn->query($printing_sql)) {
    die("Error inserting printing details: " . $conn->error);
}
$printing_id = $conn->insert_id;

// File upload
$uploaded_files = $_FILES['uploadFile'];
$file_ids = [];
$upload_dir = "file_uploads/";
if (!is_dir($upload_dir)) mkdir($upload_dir);

for ($i = 0; $i < count($uploaded_files['name']); $i++) {
    $original_name = basename($uploaded_files['name'][$i]);
    $tmp_name = $uploaded_files['tmp_name'][$i];
    $new_name = uniqid("file_", true) . ".pdf";
    $target_path = $upload_dir . $new_name;

    if (move_uploaded_file($tmp_name, $target_path)) {
        $size = filesize($target_path);
        $file_sql = "INSERT INTO file (file_name, file_original_name, file_size, printing_id)
                     VALUES ('$new_name', '$original_name', '$size', '$printing_id')";
        if ($conn->query($file_sql)) {
            $file_ids[] = $conn->insert_id;
        } else {
            echo "Error inserting file info: " . $conn->error;
        }
    } else {
        echo "Failed to upload $original_name<br>";
    }
}

// Create orders
foreach ($file_ids as $file_id) {
    $order_sql = "INSERT INTO orders (customer_id, printing_id, file_id, order_status, order_date)
                  VALUES ('$customer_id', '$printing_id', '$file_id', 'Pending', '$orderDate')";
    if (!$conn->query($order_sql)) {
        echo "Error inserting order: " . $conn->error;
    }
}

echo "<script>alert('Order submitted successfully!'); window.location.href='../dashboard - user/index.php';</script>";
$conn->close();
?>
