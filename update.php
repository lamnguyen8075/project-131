<?php
session_start();
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
   include('php/connect.php');

   
   if(isset($_COOKIE["shopping_cart"]))
   {
   
    $_SESSION["weight"] = 0;
    $_SESSION["freeShipping"] = 0;
    // 1 for yes 0 for no

    $cookie_data = stripslashes($_COOKIE['shopping_cart']);
    $cart_data = json_decode($cookie_data, true);
    foreach($cart_data as $keys => $values)
    {
   ?>
 
   <?php





   $order_item = $values["item_name"];
    $orderSelect = "SELECT * FROM productdetail WHERE productName = '$order_item'";
    $result = mysqli_query($con, $orderSelect); 
    $item = mysqli_fetch_array($result);

    $order_total = 0;
    
    $order_quantity = $item['quantity'] - $values["item_quantity"];
    $order_id = $_SESSION['uid'];
   
    

     
    $orderUpdate = "UPDATE productdetail
        SET quantity='$order_quantity'
        WHERE productName='$order_item'";
        mysqli_query($con, $orderUpdate);  




    $orderInsert = "INSERT INTO orderstatus (userID,price)
            VALUES ('$order_id','$order_total')";
        mysqli_query($con, $orderUpdate);  
    }
    echo "ORDER TOTAL: ".$order_total;
    $order_total = $_SESSION['total'];
    $order_id = $_SESSION['uid'];

    echo "ORDER TOTAL: ".$order_total;
    echo "ORDER id: ".$order_id;
    $orderInsert = "INSERT INTO orderstatus (userID,price) VALUES ('$order_id','$order_total')";
    mysqli_query($con, $orderInsert); 

    echo "  <script>
    window.location.href='/orderConfirmation.php';
    
        </script>";
   ?>
    
   <?php
   }

   ?>
   </table>





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
  


  </body>
  <script src="cart.js"></script>

</html>
