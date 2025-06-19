<?php
session_start();
include('../config.php');

// Set user or staff details
if (isset($_SESSION['customer_id'])) {
    $id = $_SESSION['customer_id'];
    $role = 'User';
    $query = "SELECT customer_name AS name, customer_email AS email, customer_phone AS phone FROM customer WHERE customer_id = $id";
    $dashboardUrl = "../dashboard - user/index.php";
    $assetBase = "../dashboard - user/assets";
} elseif (isset($_SESSION['staff_id'])) {
    $id = $_SESSION['staff_id'];
    $role = 'Staff';
    $query = "SELECT staff_name AS name, staff_email AS email, staff_phone AS phone FROM staff WHERE staff_id = $id";
    $dashboardUrl = "../dashboard - staff/index.php";
    $assetBase = "../dashboard - staff/assets";
} else {
    header("Location: ../Login/login.php");
    exit;
}

// Execute query
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My Profile | Serumpun Niaga</title>
  <link rel="stylesheet" href="<?php echo $assetBase; ?>/css/bootstrap.min.css" />
  <link rel="stylesheet" href="<?php echo $assetBase; ?>/css/main.css" />
  <style>
    .profile-card {
      max-width: 500px;
      margin: auto;
    }
    .profile-img {
      width: 100px;
      height: 100px;
      object-fit: cover;
    }
  </style>
</head>

<body>
  <div class="container mt-5">
    <div class="card p-4 shadow profile-card">
      <div class="text-center mb-4">
        <img src="<?php echo $assetBase; ?>/images/profile/profile-image.png" alt="Profile Image" class="rounded-circle profile-img">
      </div>
      <h3 class="text-center mb-3"><?php echo htmlspecialchars($role); ?> Profile</h3>
      <form>
        <div class="mb-3">
          <label for="name" class="form-label">Full Name</label>
          <input type="text" class="form-control" id="name" value="<?php echo htmlspecialchars($user['name']); ?>" readonly>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email Address</label>
          <input type="email" class="form-control" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
        </div>
        <?php if (!empty($user['phone'])): ?>
        <div class="mb-3">
          <label for="phone" class="form-label">Phone Number</label>
          <input type="text" class="form-control" id="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" readonly>
        </div>
        <?php endif; ?>
        <a href="<?php echo $dashboardUrl; ?>" class="btn btn-secondary w-100">Back to Dashboard</a>
      </form>
    </div>
  </div>
</body>
</html>
