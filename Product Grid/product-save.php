<?php
    include 'Adapter.php';

    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        if($_POST["submit"] == "Save")
        {
            $adapter=new Adapter();

            $productName = $_POST['productName'];
            $productPrice = $_POST['productPrice'];
            $productQunty = $_POST['productQunty'];
            $productStatus = $_POST['productStatus'];
            $createdDate = date("Y-m-d H:i:s");

            $result=$adapter->insert("insert into product(name,price,quantity,status,createdDate) values ('{$productName}','{$productPrice}','{$productQunty}','{$productStatus}','{$createdDate}')");

            if($result)
            {
                header('Location: http://localhost:8080/phpwork/core/Product%20Grid/product-grid.php');
            }

        }
        
        if($_POST["Update"] == "update")
        {
            $adapter=new Adapter();

            $productID = $_POST['productID'];
            $productName = $_POST['productName'];
            $productPrice = $_POST['productPrice'];
            $productQunty = $_POST['productQunty'];
            $productStatus = $_POST['productStatus'];
            $updatedDate=date("Y-m-d H:i:s");

            $result=$adapter->update("update product set name ='$productName', price = '$productPrice', quantity='$productQunty',status ='$productStatus', updatedDate='$updatedDate' where productID = $productID");
            if($result)
            {
                header('Location: http://localhost:8080/phpwork/core/Product%20Grid/product-grid.php');
            }
        }
    }
?>
