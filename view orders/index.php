<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (!isset($_SESSION['customer_id'])) {
    header("Location: ../Login/login.php");
    exit;
}
include('../config.php');
$customer_id = $_SESSION['customer_id'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>View Orders</title>
    <link rel="stylesheet" href="style.css" />

    <!--CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"></link>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></link>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <?php
  $query = "SELECT orders.order_id, orders.order_status, orders.order_date, file.file_name
            FROM orders 
            JOIN file ON orders.order_id = file.file_id
            WHERE orders.customer_id = $customer_id
            ORDER BY orders.order_id DESC";
            $result = mysqli_query($conn, $query);
    ?>
  <body>
    <div style="padding: 20px;">
      <a href="../dashboard - user/index.php" class="btn btn-dark" style="background-color: #1a1a40; color: #fff; border: none;">
        ← Back to Dashboard
      </a>
    </div>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <div class="container-fluid my-5 d-sm-flex justify-content-center">
      <div class="card px-2">
        <div class="card-header bg-white">
          <div class="row justify-content-between">
            <div class="col">
              <p class="text-muted">
                Order ID
                <span class="font-weight-bold text-dark"><?php echo $row['order_id']; ?></span>
              </p>
              <p class="text-muted">
                Place On
                <span class="font-weight-bold text-dark"><?php echo date('d M Y', strtotime($row['order_date'])); ?></span>
              </p>
            </div>
            <div class="flex-col my-auto">
              <h6 class="ml-auto mr-3">
                <a href="#">View Details</a>
              </h6>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="media flex-column flex-sm-row">
            <div class="media-body">
              <h5 class="bold"><?php echo htmlspecialchars($row['file_name']); ?></h5>
              <p class="text-muted">Status: <?php echo $row['order_status']; ?></p>
              <!--
              <h4 class="mt-3 mb-4 bold">
                <span class="mt-5">&#x20B9;</span> 1,500
                <span class="small text-muted"> via (COD) </span>
              </h4>
              <p class="text-muted">
                Tracking Status on: <span class="Today">11:30pm, Today</span>
              </p>
              <button type="button" class="btn btn-outline-primary d-flex">
                Reached Hub, Delhi
              </button>
              -->
            </div>
            <img
              class="align-self-center img-fluid"
              src="file-icon-16.jpg"
              width="180 "
              height="180"
            />
          </div>
        </div>
        <!--
        <div class="row px-3">
          <div class="col">
            <ul id="progressbar">
              <li class="step0 <?php if ($row['order_status'] != 'Pending') echo 'active'; ?>" id="step1">PENDING</li>
              <li class="step0 <?php if ($row['order_status'] == 'Processing' || $row['order_status'] == 'Completed') echo 'active'; ?>" id="step2">PROCESSING</li>
              <li class="step0 <?php if ($row['order_status'] == 'Completed') echo 'active'; ?>" id="step3">COMPLETED</li>
            </ul>
          </div>
        </div>
        -->
        <!--
        <div class="card-footer bg-white px-sm-3 pt-sm-4 px-0">
          <div class="row text-center">
            <div class="col my-auto border-line"><h5>Track</h5></div>
            <div class="col my-auto border-line"><h5>Cancel</h5></div>
            <div class="col my-auto border-line"><h5>Pre-pay</h5></div>
            <div class="col my-auto mx-0 px-0">
              <img
                class="img-fluid cursor-pointer"
                src="https://img.icons8.com/ios/50/000000/menu-2.png"
                width="30"
                height="30"
              />
            </div>
          </div>
        </div>
        -->
      </div>
    </div>
    <?php } ?>
  </body>
</html>
