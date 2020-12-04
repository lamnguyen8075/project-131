
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

  <body  class="d-flex flex-column min-vh-100">

  <!-- Navigation -->
  <?php include 'components/navigation-bar.php'; ?>


      <!-- MAIN (Center website) -->
      <div class="card h-60">
      <div style="padding: 20px 20px 10px 40px ">
        <h2>Search Results For "<?php echo $_POST["search"]; ?>"</h2>
        <div style="padding: 20px 20px 10px 40px ">
          <h3>Categories</h3>
        <div class="wrapper flex-grow-1">
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
      </div>

        <!-- Grid -->
        <div class="row">
          <?php
            // create connection
            $conn = mysqli_connect("localhost", "root", "lamnguyen", "web");

            // check connection
            if (!$conn) {
              die("Connection failed: " . mysqli_connect_error());
            }

            //get searched value
            if (isset($_POST["search"]) && !empty($_POST["search"])) {
              $search = $_POST["search"];
              $search = preg_replace("#[^0-9a-z]#i","",$search);

              $productName = "";
              $price = "";
              $url = "";

              $rawResults = mysqli_query($conn, "SELECT * FROM productDetail WHERE productName LIKE '%$search%'")
              or die(mysqli_error());

              if(mysqli_num_rows($rawResults)>0) {
                while ($results = mysqli_fetch_array($rawResults)) {
                  $productName = $results['productName'];
                  $price = $results['price'];
                  $url = $results['URL_image'];
                  $category = $results['productCategory'];
                  $link = 'item.php?ID='.$results["productID"].'';

                  //if ($categoryID == 0) {
                    echo '<div class="column '.$category.'">
                        <div class="card h-60">
                          <a href="'.$link.'"><img class="card-img-top" src="'.$url.'" alt=""></a>
                          <div class="card-body">
                            <h4 class="card-title">
                              <a href="'.$link.'">'.$productName.'</a>
                            </h4>
                            <h5>$'.$price.'/lb</h5>
                          </div>
                          <div class="card-footer">
                            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                          </div>
                      </div>
                      </div>';
                //  }
                }
              }
              else {
                  echo 'No results found.';
                }
            }
            else {
              echo 'Invalid search.';
            }
            // close connection
            mysqli_close($conn);
            ?>

        <!-- END GRID -->
        </div>

      <!-- END MAIN -->
      </div>
    </div>
  </div>
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
        if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
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
