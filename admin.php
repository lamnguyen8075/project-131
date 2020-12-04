
<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
  border: 1px solid black;
}
</style>
</head>
<body>
<h1>ADMINISTRATIVE TOOLS</h1>
<input type="submit" onclick="window.location.href='homepage.php'" value="HOME PAGE" />
<h3>PRODUCTS</h3>
<h5>Insert item: </h5>
<form action="/php/authentication.php" class="needs-validation" novalidate method = "post">

    <input type="text" name="cid" placeholder="Category ID">
    <input type="text" name="pn" placeholder="Product Name">
    <input type="text" name="price" placeholder="Price">
    <input type="text" name="quan" placeholder="Quantity">
    <input type="text" name="url" placeholder="URL Image">
    <input type="text" name="weight" placeholder="Weight">
    <input type="text" name="category" placeholder="CategoryName">
    <input type="submit" name="admin_insert" VALUE="INSERT">
</form> 
<h5>Update item: </h5>
<form action="/php/authentication.php" class="needs-validation" novalidate method = "post">
    <input type="text" name="pid_update" placeholder="Product ID">
    <input type="text" name="cid" placeholder="Category ID">
    <input type="text" name="pn" placeholder="Product Name">
    <input type="text" name="price" placeholder="Price">
    <input type="text" name="quantity" placeholder="Quantity">
    <input type="text" name="url" placeholder="URL Image">
    <input type="text" name="weight" placeholder="Weight">
    <input type="text" name="category" placeholder="CategoryName">
    <input type="submit" name="admin_update" value="UPDATE">
</form> 
<h5>Delete item: </h5>
<h7>Please enter the product id of the item you want to delete </h7>
<form action="/php/authentication.php" class="needs-validation" novalidate method = "post">
    <input type="text" name="pid_delete" placeholder="Product ID">
    <input type="submit" name="admin_delete" placeholder="DELETE">
</form> 
<h5>List items </h5>

    
        <tr>
            <form action="/php/authentication.php" class="needs-validation" novalidate method = "post" >
                <input type="text" style="width:50px" name="pid" value="PID" disabled>
                <input type="text" name="pn" value="product Name" disabled>
                <input type="text" style="width:50px" name="price"  value="price" disabled>
                <input type="text" name="quatity" style="width:60px" value="quantity" disabled>
                <input type="text" name="date" value="Date" disabled>
                <input type="text" name="url"  value="URL" disabled>
                <input type="text" name="weight" style="width:50px" value="Weight" disabled>
                <input type="text" name="weight"  value="Product Category" disabled>
                <br>
            </form> 
        </tr>
            <?php 
            include('php/connect.php');
            $sql = "SELECT * FROM productdetail";
            $result = mysqli_query($con, $sql);  

            while ($all_products = mysqli_fetch_array($result, MYSQLI_ASSOC)) :
        ?>
        
        <tr>    
            <form action="/php/authentication.php" class="needs-validation" novalidate method = "post">
                <input type="text" style="width:50px" name="pid_update" value="<?php echo $all_products['productID']; ?>" disabled>
                <input type="text" name="pn" value="<?php echo $all_products['productName']; ?>">
                <input type="text" name="price" style="width:50px" value="<?php echo $all_products['price']; ?>">
                <input type="text" name="quatity" style="width:60px" value="<?php echo $all_products['quantity']; ?>">
                <input type="text" name="date" value="<?php echo $all_products['inventoryDate']; ?>" disabled>
                <input type="text" name="url" value="<?php echo $all_products['URL_image']; ?>">
                <input type="text" name="weight" style="width:50px" value="<?php echo $all_products['weight']; ?>">
                <input type="text" name="category" value="<?php echo $all_products['productCategory']; ?>">
                <input type="submit" name="admin_update" value="UPDATE">
                <br>

                
            </form> 
        </tr>
    <?php endwhile; ?>

</body>
</html>
