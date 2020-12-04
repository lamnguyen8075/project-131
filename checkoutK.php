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

    <!-- Bootstrap 4 icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

  </head>

  <body>

    <!-- Navigation -->
    <?php include 'components/navigation-bar.php';
    include('php/connect.php');
    $sessionemail = $_SESSION['email'];
    $sqllname = "SELECT * FROM users WHERE email = '$sessionemail'";
    $lname = mysqli_query($con, $sqllname);
    $usersTable = mysqli_fetch_array($lname);
    $fullName = $usersTable['firstname']. ' ' .$usersTable['lastname'];

    // Getting values from users table
    $uID = $usersTable['userID'];
    $sqlPay = "SELECT * FROM payment where userID = '$uID'";
    $pay = mysqli_query($con,$sqlPay);
    $paymentTable = mysqli_fetch_array($pay);
    // Getting values from payment table
    $expMonth = substr($paymentTable['expiration'],0,2);
    $expYear = substr($paymentTable['expiration'],2,4);
    // Tax and Price
    $taxRate = 5;
    $taxAmount = $_SESSION["total"] * ($taxRate/100);
    $_SESSION["grandTotal"] = $_SESSION["total"] + $taxAmount;


    ?>
    <!-- Page Content -->


    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="card mt-4">
            <div class="card-body">
             <h2>Checkout</h2>
             <form action="update.php">

              <div class="row">
                <div class="col-50" style="padding: 20px 60px 40px 60px">
                  <h4>Billing Address</h4>
                  <div style="padding: 20px 40px 40px 40px">
                    <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                    <input type="text" id="fname" name="firstname" placeholder="John M. Doe" value ="<?php echo $fullName;?>" disabled>
                    <label for="email"><i class="fa fa-envelope"></i> Email</label>
                    <input type="text" id="email" name="email" placeholder="john@example.com" value = "<?php echo $usersTable['email'];?>" disabled>
                    <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                    <input type="text" id="adr" name="address" placeholder="542 W. 15th Street" value = "<?php echo $usersTable['streetname'];?>" disabled>
                    <label for="city"><i class="fa fa-institution"></i> City</label>
                    <input type="text" id="city" name="city" placeholder="New York" value = "<?php echo $usersTable['city'];?>" disabled>

                    <div class="row">
                      <div class="col-lg-4">
                        <label for="state">State</label>
                        <input type="text" id="state" name="state" placeholder="NY" value = "<?php echo $usersTable['state'];?>" disabled>
                      </div>
                      <div class="col-lg-4">
                        <label for="zip">Zip</label>
                        <input type="text" id="zip" name="zip" placeholder="10001" value = "<?php echo $usersTable['zipcode'];?>" min = "10000" max = "99999" pattern="[0-9]{5}" disabled>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div style="padding: 20px 80px 40px 80px">
                    <h4>Payment Method</h4>
                    <div style="padding: 20px 40px 40px 40px">
                      <div class="card-logos">
                        <a href="https://www.freepnglogos.com/images/visa-logo-png-2026.html" title="Image from freepnglogos.com"><img src="https://www.freepnglogos.com/uploads/visa-and-mastercard-logo-26.png" width="200" alt="visa and mastercard logo" /></a>
                      </div>
                      <br>
                      <h5>Credit or debit card</h5>
                      <br>
                      <form>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="fnameCard" class="control-label">Cardholder's Name</label>
                            <input type="text" class="form-control" id="cardholder"  placeholder="First Name Last name" value="<?php echo $paymentTable['name'];?>" disabled>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="lnameCard" class="control-label">Card Number</label>
                            <input type="number" class="form-control" id="cardnumber"  placeholder="Card Number" value="<?php echo $paymentTable['cardNumber'];?>" disabled>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-4">
                            <label for="expirationM" class="control-label">Expiration</label>
                            <input type="text" class="form-control" id="expirationM" placeholder="MM" value="<?php echo $paymentTable['expiration'];?>" disabled>
                          </div>

                          <div class="form-group col-md-4">
                            <label for="securityC" class="control-label">Security Code</label>
                            <input type="number" class="form-control" id="securityCode"  placeholder="CVC" value="<?php echo $paymentTable['secure'];?>" disabled>
                          </div>
                        </div>
                      </div>
                    <input type="submit" value="Place Order" class="btn" >
                   </div>
                  </form>
              </div>
            </form>
           </div>
          </div>
        </div>
        <!-- /.card -->

        <!-- /.col-lg-12 -->
        <!-- /.col-lg-4 -->
      </div>

      <div class="col-lg-4">
        <div class="card mt-4">
          <div class="card-body">
          <h4><a href="cartK.php">Cart</a>
          <span class="price" style="color:black">
            <i class="fa fa-shopping-cart"></i>
            
          </span>
          </h4>
          <hr>
          <div class="totals">
            <div class="totals-item">
              <tr>
               <td colspan="3" align="right">Total</td>
               <td align="right">$ <?php echo number_format($_SESSION["total"], 2); ?></td>
              </tr>
            </div>
            <div class="totals-item">
              <tr>
               <td colspan="3" align="right">Tax <?php echo '(%'.$taxRate.')'; ?></td> <br>
               <td align="right">$ <?php echo number_format($taxAmount, 2); ?></td>
              </tr>
            </div>
            <div class="totals-item">
              <label>Shipping</label>
              <div class="totals-value" id="cart-shipping">
                <?php if ($_SESSION["freeShipping"] != 1){
                  echo "Free Shipping!";
                } else {
                  $_SESSION["grandTotal"] += 5;
                  echo "$5.00";
                }?></div>
            </div>
            <div class="totals-item">
              <tr>
               <td colspan="3" align="right">Grand Total</td> <br>
               <td align="right">$ <?php echo number_format($_SESSION["grandTotal"], 2); ?></td>
              </tr>
            </div>
          </div>
        </div>
      </div>
      </div>

    </div>
  </div>
    <!-- /.container -->
    <hr>


    <!-- Footer -->
    <footer class="py-2 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Organic Food Store 2020</p>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
      function handleEdit() {
        document.getElementById('address').disabled = false;
        document.getElementById('city').disabled = false;
        document.getElementById('state').disabled = false;
        document.getElementById('zip').disabled = false;
        document.getElementById('edit').hidden = true;
        document.getElementById('save').hidden = false;

        return false;
      }
    </script>
  </body>
  <script src="cart.js"></script>

</html>
