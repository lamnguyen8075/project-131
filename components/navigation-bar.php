  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
          <img src="../pic/grapelogo.jpg" alt="OFS Store logo" style="width:5%; padding: 3px 5px 3px 3px;">
        <a class="navbar-brand" href="../homepage.php">Organic Food Store</a>

        <!-- Search -->

        <form class="form-inline" action="../search.php" method="post">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" name="search">
          <button class="btn btn-success" type="submit">Search</button>
        </form>

        <!-- Navigaton tabs -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="../homepage.php">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link active" data-toggle="dropdown" href="../account.php">Account</a>
              <div class="dropdown-menu">
                
              <?php
                    session_start();   
                    
                    if(!isset($_SESSION['loggedin'])){
                      include 'isLoggedin.php';
                    }
                    else{
                      include 'loggedin.php';
                      if(isset($_SESSION['admin'])){
                        include 'admin-nav.php';
                      }
                      
                    }
                    
                ?>

              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../contact.php">Contacts</a>
            </li>
            <li class="nav-item">
        

              <a class="nav-link" href="../cartK.php">Shopping Cart</a>
            </li>
          </ul>
      </div>
    </nav>
    <hr>
