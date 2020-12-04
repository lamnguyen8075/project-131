<form action="/php/authentication.php" class="needs-validation" novalidate method = "post">
<div style="padding: 20px 50px 40px 50px">
    <h4>Payment Method</h4>
    <div style="padding: 20px 40px 40px 40px">
    <div class="card-logos">
        <a href="https://www.freepnglogos.com/images/visa-logo-png-2026.html" title="Image from freepnglogos.com"><img src="https://www.freepnglogos.com/uploads/visa-and-mastercard-logo-26.png" width="200" alt="visa and mastercard logo" /></a>
    </div>
    <br>
    <?php 
      
      include('php/connect.php');
      $email = $_SESSION['email']; 
      $sqllname1 = "SELECT userID FROM user WHERE email = '$email'";  
      $payment1 = mysqli_query($con, $sqllname);
      $result1 = mysqli_fetch_array($payment1);
      $uid = $result1['userID'];
      $sqllname2 = "SELECT * FROM payment WHERE userID = '$uid'";  
      $payment2 = mysqli_query($con, $sqllname2);
      $result2 = mysqli_fetch_array($payment2); 

  
    ?>
    <h5>Credit or debit card</h5>
    <br>
        <div class="form-row">
        <div class="form-group col-md-6">
            <label for="fnameCard" class="control-label">Cardholder's Name</label>
            <input type="text" class="form-control" value="<?php echo $result2['name']; ?>" id="cardholder" disabled placeholder="Fullname">
        </div>
        <div class="form-group col-md-6">
            <label for="lnameCard" class="control-label">Card Number</label>
            <input type="text" class="form-control" value="<?php echo $result2['cardNumber']; ?>" id="cardnumber" disabled placeholder="Card Number">
        </div>
        </div>
        <div class="form-row">
        <div class="form-group col-md-4">
            <label for="expirationM" class="control-label">Expiration</label>
            <input type="text" class="form-control" name="month" value="<?php echo $result2['expiration']; ?>" disabled placeholder="MM">
        </div>
       
        <div class="form-group col-md-4">
            <label for="securityC" class="control-label">Security Code</label>
            <input type="text" class="form-control"  value="<?php echo $result2['secure']; ?>" id="securityCode" disabled  placeholder="CVC">
        </div>
        </div>
    </div>
    <div class="form-group">
     
    </div>
    </div>
</form>