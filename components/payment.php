<form action="/php/authentication.php" class="needs-validation" name="form1" novalidate method = "post">
<div style="padding: 20px 50px 40px 50px">
    <h4>Payment Method</h4>
    <div style="padding: 20px 40px 40px 40px">
    <div class="card-logos">
        <a href="https://www.freepnglogos.com/images/visa-logo-png-2026.html" title="Image from freepnglogos.com"><img src="https://www.freepnglogos.com/uploads/visa-and-mastercard-logo-26.png" width="200" alt="visa and mastercard logo" /></a>
    </div>
    <br>
    <h5>Credit or debit card</h5>
    <br>
        <div class="form-row">
        <div class="form-group col-md-6">
            <label for="fnameCard" class="control-label">Cardholder's Name</label>
            <input type="text" class="form-control" name="fullname" id="cardholder" placeholder="Fullname"  required>
        </div>
        <div class="form-group col-md-6">
            <label for="lnameCard" class="control-label">Card Number</label>
            <input type="number" class="form-control" name="cnum" id="cardnumber" minlength="16" maxlength="16" placeholder="Card Number"  required>
        </div>
        </div>
        <div class="form-row">
        <div class="form-group col-md-4">
            <label for="expirationM" class="control-label">Month</label>
            <select name="month" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="expirationY" class="control-label">Year</label>
            <select name="year">
                <?php for ($i = 2020; $i <= 2100; $i++) : ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php endfor; ?>
            </select>
            
        </div>
        <div class="form-group col-md-4">
            <label for="securityC" class="control-label">Security Code</label>
            <input type="number" class="form-control" name="code" id="securityCode" minlength="3" maxlength="3" placeholder="CVC"  required>
        </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-success" onclick="cardnumber(document.form1.cnum)" name="user_payment">Add Payment</button>
        </div>
    </div>
    </div>
</form>
