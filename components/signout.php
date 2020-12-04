<?php
        session_start(); 
        //$_SESSION['loggedin'] = false;
        //$_SESSION['email'] = null; 
        //unset($_SESSION['loggedin']);
        //unset($_SESSION['email']);
        session_destroy();
        if (isset($_COOKIE['shopping_cart'])) {
                unset($_COOKIE['shopping_cart']);
                setcookie('shopping_cart', '', time() - 3600, '/'); // empty value and old timestamp
            }
        echo "  <script> window.location.href='../homepage.php'; </script>";
?>