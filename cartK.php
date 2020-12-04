<?php
if(isset($_GET["action"]))
{
 if($_GET["action"] == "delete")
 {
  $cookie_data = stripslashes($_COOKIE['shopping_cart']);
  $cart_data = json_decode($cookie_data, true);
  foreach($cart_data as $keys => $values)
  {
   if($cart_data[$keys]['item_id'] == $_GET["id"])
   {
    unset($cart_data[$keys]);
    $item_data = json_encode($cart_data);
    setcookie("shopping_cart", $item_data, time() + (86400 * 30));
    header("location:cartK.php?remove=1");
   }
  }
 }
 if($_GET["action"] == "clear")
 {
  setcookie("shopping_cart", "", time() - 3600);
  header("location:index.php?clearall=1");
 }
}

if(isset($_GET["success"]))
{
 $message = '
 <div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    Item Added into Cart
 </div>
 ';
}

if(isset($_GET["remove"]))
{
 $message = '
 <div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  Item removed from Cart
 </div>
 ';
}
if(isset($_GET["clearall"]))
{
 $message = '
 <div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  Your Shopping Cart has been clear...
 </div>
 ';
}
  ?>

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
    <!-- Page Content -->


    <div class="container">

      <div class="row">
        <div class="col-lg-12">
          <div class="card mt-4">
            <div class="card-body">
              <div class="shopping-cart">
                <h2>Shopping Cart</h2>
                <table class="table table-bordered">
    <tr>
     <th width="40%">Item Name</th>
     <th width="10%">Quantity</th>
     <th width="20%">Price</th>
     <th width="15%">Total</th>
     <th width="5%">Action</th>
    </tr>
   <?php
   if(isset($_COOKIE["shopping_cart"]))
   {
    $_SESSION["total"] = 0;
    $_SESSION["weight"] = 0;
    $_SESSION["freeShipping"] = 0;
    // 1 for yes 0 for no

    $cookie_data = stripslashes($_COOKIE['shopping_cart']);
    $cart_data = json_decode($cookie_data, true);
    foreach($cart_data as $keys => $values)
    {
   ?>
    <tr>
     <td><?php echo $values["item_name"]; ?></td>
     <td><?php echo $values["item_quantity"]; ?></td>
     <td>$ <?php echo $values["item_price"]; ?></td>
     <td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
     <td><a href="cartK.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
    </tr>
   <?php
    include('php/connect.php');
       $_SESSION["total"] =  $_SESSION["total"] + ($values["item_quantity"] * $values["item_price"]);
       //gets the weight of items from the productdetail database
       $sqlDetail= "SELECT * FROM productdetail";
       $item = mysqli_query($con, $sqlDetail);
       $itemTable = mysqli_fetch_array($item);

      $_SESSION["weight"] =  $_SESSION["weight"] + ($values["item_quantity"] * $itemTable["weight"]);
      if ($_SESSION["weight"] > 20){
        $_SESSION["freeShipping"] = 0;
      }else{
        $_SESSION["freeShipping"] = 1;
      }

    }
   ?>
    <tr>
     <td colspan="3" align="right">Total</td>
     <td align="right">$ <?php echo number_format($_SESSION["total"], 2); ?></td>

     <td colspan="3" align="right">Weight</td>
     <td align="right"> <?php echo number_format($_SESSION["weight"], 2); ?>lbs</td>

     <td colspan="3"></td>
     <td align="right"> <?php if($_SESSION["freeShipping"] == 0){
                              echo "Free Shipping!";}
                              else
                              {echo "add ";
                              $moreWeight = 20-$_SESSION["weight"];
                              echo $moreWeight;
                              echo "lbs for free shipping";
                              } ?></td>
     <td></td>
    </tr>
   <?php
   }
   else
   {
    echo '
    <tr>
     <td colspan="5" align="center">No Item in Cart</td>
    </tr>
    ';
   }
   ?>
   </table>





                    <div class="cart-controls">
                      <?php
                      // 0 = disabled, 1 = none, 2 = active
                      if (session_status() == 2){
                        if(isset($_SESSION['loggedin']) == true){
                          if($_SESSION['ispayment'] == true){
                            echo '<a href="checkoutK.php" class="checkout">Begin Checkout</a>';
                          }
                          else{
                            echo '<a href="account.php" class="checkout">ADD Payment first</a>';
                          }
                        }
                        else {
                          echo '<a href="login.php" class="checkout">LOGIN First</a>';
                        }
                      
                    } else {
                      echo "please log in before ordering.";
                    }
                      ?>
                      <a href="homepage.php" class="back-to-browsing nav-link">Back to Browsing</a>

                    </div>
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
    <footer class="py-2 bg-dark">
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
