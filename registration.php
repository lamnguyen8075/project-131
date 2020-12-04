<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Registration page">
  <meta name="author" content="Hoai An Nguyen">

  <title>Organic Food Store - Registration</title>

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
            <div style="padding: 20px 20px 10px 40px">
              <h2>Register</h2>
            </div>

            <div style="padding: 0px 80px 40px 60px">
              <div class="Mycontainer">

                <form name="user-registration" action="/php/authentication.php" class="needs-validation" method = "POST">
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="inputEmail4" class="control-label">Email</label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="bob@example.com"  required>
                      <div class="valid-feedback">Valid.</div>
                      <div class="invalid-feedback">Email is not valid.</div>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="pwd">Password:</label>
                      <input type="password" class="form-control" id="password" placeholder="******" name="password" required>
                      <div class="valid-feedback">Valid.</div>
                      <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                  </div>


                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="fname" class="control-label">First Name</label>
                      <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" required>
                      <div class="valid-feedback">Valid.</div>
                      <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="lname" class="control-label">Last Name</label>
                      <input type="text" class="form-control" id="lname"  name="lname" placeholder="Last Name" required>
                      <div class="valid-feedback">Valid.</div>
                      <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="address" class="control-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Street, apartment, studio, or floor" required>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="inputCity" class="control-label">City</label>
                      <input type="text" class="form-control" id="city" name="city" placeholder="San Jose" required>
                      <div class="valid-feedback">Valid.</div>
                      <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group col-md-4">
                      <label for="inputState" class="control-label">State</label>
                      <input type="text" class="form-control" id="state" name="state" placeholder="CA" required>
                      <div class="valid-feedback">Valid.</div>
                      <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group col-md-2">
                      <label for="inputZip" class="control-label">Zip</label>
                      <input type="text" class="form-control" id="zip" name="zip" placeholder="99999" required>
                      <div class="valid-feedback">Valid.</div>
                      <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="form-group form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="terms" required> I agree with Terms and Conditions
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Agree with Terms and Conditions</div>
                      </label>
                    </div>
                  </div>

                  <button type="submit" class="btn btn-success" name="user_registration">Register</button>
                </form>
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

  <script>
    // Disable form submissions if there are invalid fields
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Get the forms we want to add validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
    </script>

</body>

</html>
