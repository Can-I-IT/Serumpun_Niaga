<?php
session_start();

// DB config
$servername = "localhost";
$username = "root";
$password = "Safwan1234.";
$dbname = "serumpun_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Get login input
$email = $_POST['customer_email'] ?? '';
$pass  = $_POST['password'] ?? '';

if (empty($email) || empty($pass)) {
    echo "<script>alert('Please enter both email and password.'); window.location.href='../Login/index.html';</script>";
    exit();
}

// Check in customer table
$stmt = $conn->prepare("SELECT * FROM customer WHERE customer_email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    if (password_verify($pass, $user['customer_password'])) {
        session_regenerate_id(true); // Regenerate before setting new session
        session_unset(); // Clear any old session
        $_SESSION['customer_id'] = $user['customer_id'];
        $_SESSION['customer_name'] = $user['customer_name'];
        $_SESSION['customer_email'] = $user['customer_email'];
        header("Location: ../dashboard - user/index.php");
        exit();
    } else {
        echo "<script>alert('Incorrect password.'); window.location.href='../Login/index.html';</script>";
        exit();
    }
}

// Only check staff if no customer found
$stmt = $conn->prepare("SELECT * FROM staff WHERE staff_email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $staff = $result->fetch_assoc();
    if (password_verify($pass, $staff['staff_password'])) {
        session_regenerate_id(true);
        session_unset();
        $_SESSION['staff_id'] = $staff['staff_id'];
        $_SESSION['staff_name'] = $staff['staff_name'];
        $_SESSION['staff_email'] = $staff['staff_email'];
        header("Location: ../dashboard - staff/index.php");
        exit();
    } else {
        echo "<script>alert('Incorrect password.'); window.location.href='../Login/index.html';</script>";
        exit();
    }
}

// No account found
echo "<script>alert('No account found for this email.'); window.location.href='../Login/index.html';</script>";
exit();

$conn->close();
?>
