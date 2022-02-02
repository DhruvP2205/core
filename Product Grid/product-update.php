<?php 
     $productID = $_POST['productID'];
     $productName = $_POST['productName'];
     $productPrice = $_POST['productPrice'];
     $productQunty = $_POST['productQunty'];
     $productStatus = $_POST['productStatus'];
     $createdDate = $_POST['createdDate'];
     $updatedDate = $_POST['updatedDate'];

     $conn = mysqli_connect('localhost:3308','root','1234','demodb') or die("Connection failed");
     
     $query = "update product set name ='$productName', price = '$productPrice', quantity='$productQunty',status ='$productStatus', createdDate = '$createdDate', updatedDate='$updatedDate' where productID = $productID";
     
     $result = mysqli_query($conn,$query) or die("Unsuccessful!"); 

     header("Location: http://localhost:8080/phpwork/core/Product%20Grid/product-grid.php"); 
     mysqli_close($conn);
 ?>
