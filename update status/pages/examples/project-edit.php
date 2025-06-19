<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Manage Services | Serumpun Niaga</title>
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css" />
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
  <style>
    .content-wrapper {
      min-height: 100vh;
      padding: 20px;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../../../dashboard - staff/index.php" class="nav-link">Dashboard</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../../../profile/index.php" class="nav-link">Profile</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
      <img src="../../dist/img/AdminLTELogo.png" alt="Serumpun Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Serumpun Niaga</span>
    </a>
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Staff</a>
        </div>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
          <li class="nav-item">
            <a href="../../../dashboard - staff/index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tools"></i>
              <p>Manage Services</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Printing Services</h1>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <!-- Services table and modal will be inserted here -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Service List</h3>
            <button class="btn btn-primary float-right" onclick="openAddModal()">Add Service</button>
          </div>
          <div class="card-body">
            <table class="table table-bordered" id="services-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Service Name</th>
                  <th>Category</th>
                  <th>Price (RM)</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <!-- PHP loop to insert rows dynamically -->
                 <?php
                 $conn = new mysqli("localhost", "root", "Safwan1234.", "serumpun_db");
                 if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
                 $result = $conn->query("SELECT * FROM services");
                 $i = 1;
                 
                 if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                    <td>{$i}</td>
                    <td>{$row['service_name']}</td>
                    <td>{$row['service_category']}</td>
                    <td>{$row['service_price']}</td>
                    <td>
                      <button class='btn btn-sm btn-info edit-btn' data-id='{$row['service_id']}'>Edit</button>
                      <button class='btn btn-sm btn-danger delete-btn' data-id='{$row['service_id']}'>Delete</button>
                    </td>
                    </tr>";
                    $i++;
                  }
                } else {
                  echo "<tr><td colspan='5' class='text-center'>No services found.</td></tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- Modal containers will be added here -->
<!-- Add Service Modal -->
<div class="modal fade" id="addServiceModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form id="addForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add New Service</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="service_name">Service Name</label>
            <input type="text" class="form-control" name="service_name" required>
          </div>
          <div class="form-group">
            <label for="service_category">Category</label>
            <select class="form-control" name="service_category" required>
              <option value="Print Type">Print Type</option>
              <option value="Paper Size">Paper Size</option>
              <option value="Binding">Binding</option>
              <option value="Laminate">Laminate</option>
            </select>
          </div>
          <div class="form-group">
            <label for="service_price">Price (RM)</label>
            <input type="number" class="form-control" name="service_price" step="0.01" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Add</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Edit Service Modal -->
<div class="modal fade" id="editServiceModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form id="editForm">
      <input type="hidden" name="service_id" id="edit_service_id">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Service</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="edit_service_name">Service Name</label>
            <input type="text" class="form-control" name="service_name" id="edit_service_name" required>
          </div>
          <div class="form-group">
            <label for="edit_service_category">Category</label>
            <select class="form-control" name="service_category" id="edit_service_category" required>
              <option value="Print Type">Print Type</option>
              <option value="Paper Size">Paper Size</option>
              <option value="Binding">Binding</option>
              <option value="Laminate">Laminate</option>
            </select>
          </div>
          <div class="form-group">
            <label for="edit_service_price">Price (RM)</label>
            <input type="number" class="form-control" name="service_price" id="edit_service_price" step="0.01" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Update</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <strong>Copyright &copy; 2025 <a href="#">Serumpun Niaga</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>
</div>

<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
<script>
  // JS logic for modals and AJAX will go here
  function openAddModal() {
  $('#addForm')[0].reset();
  $('#addServiceModal').modal('show');
}

$('#addForm').submit(function (e) {
  e.preventDefault();
  $.ajax({
    url: 'add_service.php',
    type: 'POST',
    data: $(this).serialize(),
    success: function () {
      $('#addServiceModal').modal('hide');
      location.reload();
    },
    error: function (xhr) {
      alert("Error: " + xhr.responseText);
    }
  });
});
</script>
<script>
  // OPEN Edit Modal
  $(document).on('click', '.edit-btn', function () {
    const id = $(this).data('id');
    $.post('get_service.php', { id: id }, function (res) {
      const data = JSON.parse(res);
      $('#edit_service_id').val(data.service_id);
      $('#edit_service_name').val(data.service_name);
      $('#edit_service_category').val(data.service_category);
      $('#edit_service_price').val(data.service_price);
      $('#editServiceModal').modal('show');
    });
  });

  // SUBMIT Edit Form
  $('#editForm').submit(function (e) {
    e.preventDefault();
    $.ajax({
      url: 'update_service.php',
      type: 'POST',
      data: $(this).serialize(),
      success: function () {
        $('#editServiceModal').modal('hide');
        location.reload();
      }
    });
  });

  // DELETE service
  $(document).on('click', '.delete-btn', function () {
    if (!confirm('Are you sure you want to delete this service?')) return;

    const id = $(this).data('id');
    $.post('delete_service.php', { id: id }, function () {
      location.reload();
    });
  });
</script>

</body>
</html>