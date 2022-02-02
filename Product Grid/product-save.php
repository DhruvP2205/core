<?php 
 
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $productQunty = $_POST['productQunty'];
    $productStatus = $_POST['productStatus'];
    $createdDate = $_POST['createdDate'];
    $updatedDate = $_POST['updatedDate'];
 
    $conn = mysqli_connect('localhost:3308','root','1234','demodb') or die("Connection failed");
      
    $query = "insert into product(name,price,quantity,status,createdDate,updatedDate) values ('{$productName}','{$productPrice}','{$productQunty}','{$productStatus}','{$createdDate}','{$updatedDate}')";

    $result = mysqli_query($conn,$query) or die("Unsuccessful!"); 

    header("Location: http://localhost:8080/phpwork/core/Product%20Grid/product-grid.php"); 
    mysqli_close($conn);
 ?>
