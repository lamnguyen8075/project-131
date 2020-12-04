<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Cart page">
    <meta name="author" content="Hoai An Nguyen">

    <title>Organic Food Store - Account</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
      <?php include 'components/navigation-bar.php'; ?>
      <?php

        include('php/connect.php');

        $email = $_SESSION['email'];
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $name = mysqli_query($con, $sql);
        $aq = mysqli_fetch_array($name);

        $userID = $aq['userID'];
        $sqllname = "SELECT * FROM orderstatus WHERE userID = '$userID' ORDER BY orderID DESC";
        $lname = mysqli_query($con, $sqllname);
        $result = mysqli_fetch_array($lname);
      ?>
    <hr>

    <!-- Page Content -->


    <div class="container">

      <div class="row">
        <div class="col-lg-12">
          <div class="card mt-4">
            <div class="card-body">
              <div style="padding: 20px 80px 40px 80px">
                <h2>Order #<?php echo $result['orderID']; ?> was successufully placed.</h2>
                <p>Confirmation email will be sent to <?php echo $aq['email']; ?></p>
                <a href="homepage.php" class="back-to-browsing nav-link">Back to Browsing</a>
              </div>
            </div>
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col-lg-12 -->

        <div class="col-lg-4">

        </div>
        <!-- /.col-lg-4 -->
      </div>

    </div>
    <!-- /.container -->
    <hr>
    <!-- Footer -->
    <footer class="footer py-2 bg-dark" >
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Organic Food Store 2020</p>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>
  <script src="cart.js"></script>

</html>
