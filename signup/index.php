<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Serumpun Niaga | Create Account</title>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <link
      href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap"
      rel="stylesheet"
    />

    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />

    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body class="img" style="background-image: url(images/bg.jpg)">
    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6 text-center mb-5">
            <h2 class="heading-section">Create Your Serumpun Account</h2>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-7 col-lg-5">
            <div class="login-wrap">
              <h3 class="text-center mb-4">Create Your Account</h3>
              <?php
              session_start();
              if (isset($_SESSION['error'])) {
                echo '<div style="color: red; margin-bottom: 10px; text-align:center;">' . $_SESSION['error'] . '</div>';
                unset($_SESSION['error']);
              }
              ?>

              <form action="register.php" method="post" class="signup-form">
                <div class="form-group mb-3">
                  <label class="label" for="name">Full Name</label>
                  <input
                    type="text"
                    name="customer_name"
                    class="form-control"
                    placeholder="John Doe"
                    required
                  />
                  <span class="icon fa fa-user-o"></span>
                </div>
                <div class="form-group mb-3">
                  <label class="label" for="email">Email Address</label>
                  <input
                    type="text"
                    name="customer_email"
                    class="form-control"
                    placeholder="johndoe@gmail.com"
                    required
                  />
                  <span class="icon fa fa-paper-plane-o"></span>
                </div>
                <div class="form-group mb-3">
                  <label class="label" for="phone">Phone Number</label>
                  <input
                  type="text"
                  name="customer_phone"
                  class="form-control"
                  placeholder="e.g. 01112345678"
                  required
                  />
                  <span class="icon fa fa-phone"></span>
                </div>
                <div class="form-group mb-3">
                  <label class="label" for="password">Password</label>
                  <input
                    id="password"
                    name="customer_password"
                    type="password"
                    class="form-control"
                    placeholder="Password"
                    required
                  />
                  <span
                    toggle="#password"
                    class="fa fa-fw fa-eye field-icon toggle-password"
                  ></span>
                  <span class="icon fa fa-lock"></span>
                </div>
                <div class="form-group mb-3">
                  <label class="label" for="password">Re-enter Password</label>
                  <input
                    id="password-confirm"
                    type="password"
                    class="form-control"
                    placeholder="Password"
                    required
                  />
                  <span
                    toggle="#password-confirm"
                    class="fa fa-fw fa-eye field-icon toggle-password"
                  ></span>
                  <span class="icon fa fa-lock"></span>
                </div>
                <!-- Start of Serumpun Niaga: Role Selection -->
                <!-- Dropdown for user or staff registration -->
                <div class="form-group">
                  <label for="role" class="form-label">Register as:</label>
                  <select name="customer_user_type" id="role" class="form-select" required>
                    <option value="customer">Regular User</option>
                    <option value="staff">Staff</option>
                  </select>
                </div>
                <!-- End of Serumpun Niaga: Role Selection -->
                <div class="form-group">
                  <button
                    type="submit"
                    class="form-control btn btn-primary submit px-3"
                  >
                    Sign Up
                  </button>
                </div>
              </form>
              <p>
                I'm already a member!
                <a data-toggle="#" href="../Login/index.html">Sign In</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>
