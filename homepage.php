<?php 

//index.php

$connect = new PDO("mysql:host=localhost;dbname=web", "root", "lamnguyen");

$message = '';

if(isset($_POST["add_to_cart"]))
{
 if(isset($_COOKIE["shopping_cart"]))
 {
  $cookie_data = stripslashes($_COOKIE['shopping_cart']);

  $cart_data = json_decode($cookie_data, true);
 }
 else
 {
  $cart_data = array();
 }

 $item_id_list = array_column($cart_data, 'item_id');

 if(in_array($_POST["hidden_id"], $item_id_list))
 {
  foreach($cart_data as $keys => $values)
  {
   if($cart_data[$keys]["item_id"] == $_POST["hidden_id"])
   {
    $cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $_POST["quantity"];
   }
  }
 }
 else
 {
  $item_array = array(
   'item_id'   => $_POST["hidden_id"],
   'item_name'   => $_POST["hidden_name"],
   'item_price'  => $_POST["hidden_price"],
   'item_quantity'  => $_POST["quantity"]
  );
  $cart_data[] = $item_array;
 }

 
 $item_data = json_encode($cart_data);
 setcookie('shopping_cart', $item_data, time() + (86400 * 30));
 header("location:cartK.php?success=1");
}

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
  header("location:cartK.php?clearall=1");
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
  <meta name="description" content="">
  <meta name="author" content="">

  <title>OFS Homepage</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/shop-homepage.css" rel="stylesheet">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

</head>

<body>

    <!-- Navigation -->
    <?php include 'components/navigation-bar.php'; ?>


  <!-- MAIN (Center website) -->
  <div class="container">
    <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
          <img class="d-block img-fluid" src="pic/slide3.png" alt="First slide">
        </div>
        <div class="carousel-item">
          <img class="d-block img-fluid" src="pic/slide2.png" alt="Second slide">
        </div>
        <div class="carousel-item">
          <img class="d-block img-fluid" src="pic/slide1.png" alt="Third slide">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
  <hr>



  <h2>Products</h2>
  <div class="main">
    <div class="column menu active">
      <div id="myBtnContainer">
        <button class="btngroup" onclick="filterSelection('all')">Show all</button>
        <button class="btngroup" onclick="filterSelection('produce')">Produce</button>
        <button class="btngroup" onclick="filterSelection('dairyeggs')">Dairy & Eggs</button>
        <button class="btngroup" onclick="filterSelection('meat')">Meat</button>
        <button class="btngroup" onclick="filterSelection('snacks')">Snacks</button>
      </div>
    </div>

    <!-- Grid -->

    <div class="row">

            <?php
            $query = "SELECT * FROM productdetail";
            $statement = $connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            foreach($result as $all_products)
            {
              
              
            ?>
            
            <div class="column <?php echo $all_products["productCategory"]; ?>">
              <div class="card h-60">
                  <form method="post">
                  <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">
                  <img src="<?php echo $all_products["URL_image"]; ?>" class="img-fluid" alt="Responsive image"/><br />

                  <h4 class="text-info"><?php echo "<a href = 'item.php?ID={$all_products["productID"]  }'>{$all_products["productName"]}</a>"; ?></h4>

                  <h4 class="text-danger">$ <?php echo $all_products["price"]; ?></h4>
                  <h5 class="text-danger">QTY <?php echo $all_products["quantity"]; ?></h4>
                  <input type="text" name="quantity" value="1" class="form-control" />
                  <input type="hidden" name="hidden_name" value="<?php echo $all_products["productName"]; ?>" />
                  <input type="hidden" name="hidden_price" value="<?php echo $all_products["price"]; ?>" />
                  <input type="hidden" name="hidden_id" value="<?php echo $all_products["productID"]; ?>" />
                  <input type="<?php if ($all_products['quantity'] > 0 ) { echo "submit"; } else { echo"Out of stock"; } ?>" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="<?php if ($all_products['quantity'] > 0 ) { echo "Add to Cart"; } else { echo"Out of stock"; } ?>" />
                  
                  </div>
                  </form>
              </div>
            </div>
            <?php
              
            }
            ?>
    
      </div>



      <!-- <div class="row" style="display: inline-block">
        <div class=<?php echo $category; ?>>
          <div class="card h-60" style="display: inline-block">
            <a href="#"><img class="card-img-top" src=<?php echo $imageurl; ?> alt=""></a>
            <div class="card-body" style="display: inline-block">
              <h4 class="card-title">
                <a><?php echo $productName; ?></a>
              </h4>
              <h5><?php echo $price; ?></h5>
            </div>
            <div class="card-footer">
              <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
            </div>
          </div>
        </div>
    </div> -->



<hr>
      <!-- Footer -->
      <footer class="py-2 bg-dark">
        <div class="container">
          <p class="m-0 text-center text-white">Copyright &copy; Organic Food Store 2020</p>
        </div>
      </footer>


      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script>
        filterSelection("all")

        function filterSelection(c) {
          var x, i;
          x = document.getElementsByClassName("column");
          if (c == "all") c = "";
          for (i = 0; i < x.length; i++) {
            w3RemoveClass(x[i], "show");
            if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
            w3AddClass(x[0], "show");
          }
        }

        function w3AddClass(element, name) {
          var i, arr1, arr2;
          arr1 = element.className.split(" ");
          arr2 = name.split(" ");
          for (i = 0; i < arr2.length; i++) {
            if (arr1.indexOf(arr2[i]) == -1) {
              element.className += " " + arr2[i];
            }
          }
        }

        function w3RemoveClass(element, name) {
          var i, arr1, arr2;
          arr1 = element.className.split(" ");
          arr2 = name.split(" ");
          for (i = 0; i < arr2.length; i++) {
            while (arr1.indexOf(arr2[i]) > -1) {
              arr1.splice(arr1.indexOf(arr2[i]), 1);
            }
          }
          element.className = arr1.join(" ");
        }
      </script>
</body>

</html>