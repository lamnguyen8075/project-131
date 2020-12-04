<?php
include('php/connect.php');
session_start();
$order_total = $_SESSION['total'];
$order_id = $_SESSION['uid'];
echo "ORDER TOTAL: ".$order_total;
echo "ORDER id: ".$order_id;
$orderInsert = "INSERT INTO orderstatus (userID,price) VALUES ('$order_id','$order_total')";
mysqli_query($con, $orderInsert); 
?>