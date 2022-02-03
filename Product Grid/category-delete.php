<?php
    include 'Adapter.php';

    if($_SERVER['REQUEST_METHOD']=='GET')
    {
            $categoryID = $_GET['id'];
            $adapter = new Adapter();
            $result = $adapter->delete("delete from category where categoryID = $categoryID");
            if($result)
            {
                header('Location: http://localhost:8080/phpwork/core/Product%20Grid/category-grid.php');
            }
    }
?>
