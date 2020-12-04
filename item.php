<?php
  //if (isset($_GET['ID'])) {
    // create connection
    $conn = mysqli_connect("localhost", "root", "lamnguyen", "web");
    // check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    $ID = mysqli_real_escape_string($conn, $_GET['ID']);
    //$sql = "SELECT * FROM productDetail where productCategory = 'meat'";
    $sql = "SELECT * FROM `productdetail` WHERE productID ='$ID' ";
    $result = mysqli_query($conn, $sql) or die ("Bad Query: $sql");
    $row = mysqli_fetch_array($result);

    $productName = $row['productName'];
    $price = $row['price'];
    $imageurl = $row['URL_image'];
    $weight = $row['weight'];
  //}
  ?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="item page">
  <meta name="author" content="Hoai An Nguyen">

  <title>Organic Food Store - Organic Bananas</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <?php include 'components/navigation-bar.php'; ?>
  <hr>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <div class="col-lg-8">

        <div class="card mt-4">

          <img class="card-img-top" src="<?php echo $imageurl; ?>" alt="" style="width:60%; margin-left: auto; margin-right: auto;">
          <div class="card-body">
            <h3 class="card-title"><?php  echo $productName;  ?></h3>
            <p class="card-text">Weight: <?php  echo $weight; ?> lbs.
            <br>
            <?php  echo $productName; ?>, a 100% organic food.
            <br>
            </p>
            <img class="img-fluid" src="https://drive.google.com/thumbnail?id=1l11r091LAfDqBLT6TOtNMakWGi6EKRpI" alt="" style="width:70%; margin-left: auto; margin-right: auto;">
          </div>
        </div>
        <!-- /.card -->

        <div class="card card-outline-secondary my-4">
          <div class="card-header">
            Reviews
          </div>
          <div class="card-body">
            <p>Great Value!</p>
            <small class="text-muted">Posted by Anonymous on 3/1/17</small>
            <hr>
            <p>Taste great.</p>
            <small class="text-muted">Posted by Anonymous on 3/1/17</small>
            <hr>
            <p>Seem fresh.</p>
            <small class="text-muted">Posted by Anonymous on 3/1/17</small>
            <hr>
          </div>
        </div>
        <!-- /.card -->

      </div>
      <!-- /.col-lg-9 -->

      <div class="col-lg-4">
        <div style="padding: 20px">
          <p><h4><?php echo $productName; ?></h4></p>
          <h4>$<?php echo $price; ?></h4>
          <p><span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
          4.0 stars</p>
          
          <form action="/action_page.php">
        
   
             <div class="toast mt-3">
              <div class="toast-header">
                Success!
              </div>
              <div class="toast-body">
                Item was successfully added to the cart.
              </div>
             </div>
           </form>
        </div>
      </div>
      <!-- /.col-lg-3 -->
    </div>

  </div>
  <!-- /.container -->

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
  $(document).ready(function(){
    $('#myBtn').click(function(){
      $('.toast').toast({delay: 4000});
      $('.toast').toast('show');
    });
  });
  </script>
</body>

</html>
