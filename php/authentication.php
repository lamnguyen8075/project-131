<?php     
    session_start(); 
    include('../php/connect.php'); 
    echo "<h1>success 1</h1>";
    // User login
    if(isset($_POST['user_login'])){

            $email = mysqli_real_escape_string($con, $_POST['email']);  
            $password = mysqli_real_escape_string($con, $_POST['password']); 
            //to prevent from mysqli injection  
            $email = stripcslashes($email);  
            $password = stripcslashes($password);  
 
          
            $sql = "SELECT * 
                    FROM users 
                    WHERE email = '$email' AND password = '$password'";
            
            $result = mysqli_query($con, $sql);  
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
            $count = mysqli_num_rows($result);  
              
            if($count == 1){  
                    echo "  <script>
                                window.location.href='../account.php';
                                alert('Login Successful!');
                            </script>";
                    $sqllname = "SELECT * FROM users WHERE email = '$email'";  
                    $isAdmin = mysqli_query($con, $sqllname);
                    $result = mysqli_fetch_array($isAdmin);
                    
                    if($email == 'admin@gmail.com')
                    //if($result['userType'] == 1)
                    {
                        $_SESSION['admin'] = 1;
                    }
                    $_SESSION['uid'] = $result['userID'];
                    $_SESSION['loggedin'] = true;
                    $_SESSION['email'] = $email; 
                    
                    
                    // Check if user already submit payment information 
                    $uid = "SELECT userID FROM users WHERE email = '$email'";
                    $payment = mysqli_query($con, $uid);
                    $result02 = mysqli_fetch_array($payment); 
                    
                    $uid = $result02['userID'];
                    $ispayment = "SELECT userID FROM payment WHERE userID = '$uid'";
                    $ispay = mysqli_query($con, $ispayment);
                    $result03 = mysqli_fetch_array($ispay); 


                    if($result03){
                        $_SESSION['ispayment'] = true;
                    }
                    else{
                        $_SESSION['ispayment'] = false;
                    }
                    echo "  <script>
                                window.location.href='../account.php';
                                alert('Login Successful!');
                            </script>";
            }  
            else{
                echo "  <script>
                    window.location.href='../login.php';
                    alert('Incorrect Username or Password!');
                </script>";
            }

            
 
    }

    // User registration
    if(isset($_POST['user_registration'])) {


        $fname = mysqli_real_escape_string($con, $_POST['fname']); 
        $lname = mysqli_real_escape_string($con, $_POST['lname']); 
        $isAdmin = '0';
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $email = mysqli_real_escape_string($con, $_POST['email']); 
        $str = mysqli_real_escape_string($con, $_POST['address']);  
        $city = mysqli_real_escape_string($con, $_POST['city']); 
        $state = mysqli_real_escape_string($con, $_POST['state']);
        $zip = mysqli_real_escape_string($con, $_POST['zip']); 

        $fname = stripcslashes($fname);
        $lname = stripcslashes($lname);
        $password = stripcslashes($password);
        $email = stripcslashes($email);
        $str = stripcslashes($str);
        $state = stripcslashes($state);
        $city = stripcslashes($city);
        $zip = stripcslashes($zip);

       

        $sql_checkExist = " SELECT * FROM users WHERE email = '$email' ";
       
  

        $checkExist = mysqli_query($con, $sql_checkExist);  // return value of mysqli_query
        //$count = mysqli_fetch_object($checkExist);          //convert checkExist into integer
        //$user_exist = mysqli_fetch_array($checkExist); 
        $count = mysqli_num_rows($checkExist);
        echo $count;
        if($count != 0){                                    // username is already exist
            echo "  <script>
                       window.location.href='../registration.php';
                        alert('Username is already exist!');
                    </script>";
        }   
        else{                                                // username is not exist then INSERT into db
            $query = "INSERT INTO users (userType,firstname, lastname, password, email, streetname, city, state, zipcode) 
            VALUES('$isAdmin','$fname', '$lname','$password', '$email', '$str', '$city', '$state', '$zip')";
            mysqli_query($con, $query);
            
             echo "  <script>
                      alert('Register successful!');
                      window.location.href='../homepage.php';
        
                    </script>";
                    // 
           }
    }

    // User payment
    if(isset($_POST['user_payment'])) {
        $fullname = mysqli_real_escape_string($con, $_POST['fullname']);  
        $cardnumber = mysqli_real_escape_string($con, $_POST['cnum']); 
        $m = mysqli_real_escape_string($con, $_POST['month']);
        $y = mysqli_real_escape_string($con, $_POST['year']); 
        $time=$m."/".$y;
        $securitycode = mysqli_real_escape_string($con, $_POST['code']);

        //grab uid from user table then insert to payment table
        $uid_payment = $_SESSION['uid'];

        //echo $id;
        
        echo $cardnumber."<br>";
        echo $fullname."<br>";
        echo $uid_payment."<br>";
        echo $securitycode."<br>";
        echo $time."<br>";
        $querypayment = "INSERT INTO payment (cardNumber,name,userID,secure,expiration) 
        VALUES('$cardnumber','$fullname', '$uid_payment','$securitycode','$time')";
        mysqli_query($con, $querypayment);


   
        
        
        $_SESSION['ispayment'] = true;
        echo "  <script> window.location.href='../account.php'; </script>";
    }
    //Administrator tools
   if(isset($_POST['admin'])) {
        $sql = "SELECT * FROM productdetail";
        $result = mysqli_query($con, $sql);  
        //$all_products = mysqli_fetch_array($result, MYSQLI_ASSOC);      
    } 

    // Admin insert item
    if(isset($_POST['admin_insert'])) {
        $catid = mysqli_real_escape_string($con, $_POST['cid']);
        $productname = mysqli_real_escape_string($con, $_POST['pn']);
        $price = mysqli_real_escape_string($con, $_POST['price']); 
        $quantity = isset($_POST['quan']);//($con, $_POST['quan']);
        $url = mysqli_real_escape_string($con, $_POST['url']);
        $weight = mysqli_real_escape_string($con, $_POST['weight']);
        $productcat = mysqli_real_escape_string($con, $_POST['category']);

        $catid = stripcslashes($catid);
        $productname = stripcslashes($productname);
        $price = stripcslashes($price);
        $quantity = stripcslashes($quantity);
        $url = stripcslashes($url);
        $weight = stripcslashes($weight);
        $productcat = stripcslashes($productcat);

        $queryAdminInsert = "INSERT INTO productdetail (categoryID,productName,price,quantity,URL_image,weight,productCategory) 
        VALUES('$catid','$productname','$price','$quantity','$url','$weight','$productcat')";
        mysqli_query($con, $queryAdminInsert); 
        echo "  <script>
            alert('Item has been INSERTED from your inventory!');
            window.location.href='../admin.php';
    }
        </script>";    
    }
    // Admin update item detail
    if(isset($_POST['admin_update'])) {
        echo "PRODUCT ID".$_POST['pid_update'];
        $productID = mysqli_real_escape_string($con, ($_POST['pid_update']));
        $catid = mysqli_real_escape_string($con, ($_POST['cid']));
        $productname = mysqli_real_escape_string($con, $_POST['pn']);
        $price = mysqli_real_escape_string($con, $_POST['price']); 
        $quantity = mysqli_real_escape_string($con, ($_POST['quantity']));
        $url = mysqli_real_escape_string($con, $_POST['url']);
        $weight = mysqli_real_escape_string($con, $_POST['weight']);
        $productcat = mysqli_real_escape_string($con, $_POST['category']);

        $productID = stripcslashes($productID);
        $catid = stripcslashes($catid);
        $productname = stripcslashes($productname);
        $price = stripcslashes($price);
        $quantity = stripcslashes($quantity);
        $url = stripcslashes($url);
        $weight = stripcslashes($weight);
        $productcat = stripcslashes($productcat);
        echo "PRODUCT ID".$productID;
        echo "CAT ID".$catid;
        echo "PN".$productname;
        echo "PRICE".$price;
        echo "QUANTITY".$quantity;
        echo "URL".$url;
        echo "WEIGHT".$weight;
        echo "PRODUCT CAT".$productcat;
        $queryAdminUpdate = "UPDATE productdetail
        SET productName='$productname',categoryID='$catid',price='$price',quantity='$quantity',URL_image='$url',weight='$weight',productCategory='$productcat'
        WHERE productID = '$productID'";
        mysqli_query($con, $queryAdminUpdate);  
        echo "  <script>
            alert('Item has been UPDATED from your inventory!');
            window.location.href='../admin.php';

        </script>";  
        
    }

    if(isset($_POST['admin_delete'])) {
        $id = mysqli_real_escape_string($con, $_POST['pid_delete']);
        $id = stripcslashes($id);
    
        $queryAdminDelete = "DELETE FROM productdetail WHERE productID='$id'";
        mysqli_query($con, $queryAdminDelete);    
        echo "  <script>
            alert('Item has been DELETED from your inventory!');
            window.location.href='../admin.php';    

         </script>";
        // window.location.href='../admin.php';
    }


   
?>