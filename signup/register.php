<?php
session_start();

// DB config
$servername = "localhost";
$username   = "root";
$password   = "Safwan1234.";
$dbname     = "serumpun_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Get form data
$name  = $_POST['customer_name'] ?? '';
$email = $_POST['customer_email'] ?? '';
$pass  = $_POST['customer_password'] ?? '';
$role  = $_POST['customer_user_type'] ?? 'user'; // 'customer' or 'staff'
$phone = $_POST['customer_phone'] ?? '';

// Basic validation
if (empty($name) || empty($email) || empty($pass)) {
    die("Please fill in all required fields.");
}

// Hash password
$hashed_password = password_hash($pass, PASSWORD_DEFAULT);

if ($role === 'staff') {
    // Check for duplicate email in staff
    $stmt = $conn->prepare("SELECT * FROM staff WHERE staff_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Email already registered as staff.";
        header("Location: ../signup/index.php");
        exit();
    }

    // Insert into staff table
    $stmt = $conn->prepare("INSERT INTO staff (staff_name, staff_email, staff_password, staff_phone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $hashed_password, $phone);

    if ($stmt->execute()) {
        $_SESSION['staff_id'] = $stmt->insert_id;
        $_SESSION['staff_name'] = $name;
        $_SESSION['staff_role'] = $role;
        header("Location: ../dashboard - staff/index.php");
        exit();
    }

} else {
    // Check for duplicate email in customer
    $stmt = $conn->prepare("SELECT * FROM customer WHERE customer_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Email already registered.";
        header("Location: ../signup/index.php");
        exit();
    }

    // Insert into customer table
    $stmt = $conn->prepare("INSERT INTO customer (customer_name, customer_email, customer_password, customer_phone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $hashed_password, $phone);


    if ($stmt->execute()) {
        $_SESSION['customer_id'] = $stmt->insert_id;
        $_SESSION['customer_name'] = $name;
        $_SESSION['customer_role'] = $role;
        header("Location: ../dashboard - user/index.php");
        exit();
    }
}

// Fallback if insert fails
$_SESSION['error'] = "Failed to create account. Please try again.";
header("Location: ../signup/index.php");
$conn->close();
exit();
?>
