<?php
    $conn = mysqli_connect('localhost:3308','root','1234','demodb') or die("Connection failed");

    $productID = $_GET['id'];

    $query = "delete from product where productID = $productID";

    $result = mysqli_query($conn,$query) or die("Unsuccessful!");

    header("Location: http://localhost:8080/phpwork/core/Product%20Grid/product-grid.php"); 
    mysqli_close($conn);
?>
