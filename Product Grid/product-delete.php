<?php
    include 'Adapter.php';

    if($_SERVER['REQUEST_METHOD']=='GET')
    {
            $productID = $_GET['id'];
            $adapter = new Adapter();
            $result = $adapter->delete("DELETE FROM product WHERE productID = $productID");
            if($result)
            {
                header('Location: http://localhost:8080/phpwork/core/Product%20Grid/product-grid.php');
            }
    }
?>
