<?php
    include 'Adapter.php';

    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        if($_POST["submit"] == "Save")
        {
            $adapter=new Adapter();

            $categoryName = $_POST['categoryName'];
            $categoryStatus = $_POST['categoryStatus'];
            $createdDate = date("Y-m-d H:i:s");

            $result = $adapter->insert("insert into category(name,status,createdDate) values ('{$categoryName}','{$categoryStatus}','{$createdDate}')");

            if($result)
            {
                header('Location: http://localhost:8080/phpwork/core/Product%20Grid/category-grid.php');
            }

        }
        
        if($_POST["Update"] == "update")
        {
            $adapter=new Adapter();

            $categoryID = $_POST['categoryID'];
            $categoryName = $_POST['categoryName'];
            $categoryStatus = $_POST['categoryStatus'];
            $updatedDate=date("Y-m-d H:i:s");

            $result=$adapter->update("update category set name ='$categoryName', status ='$categoryStatus', updatedDate='$updatedDate' where categoryID = $categoryID");
            if($result)
            {
                header('Location: http://localhost:8080/phpwork/core/Product%20Grid/category-grid.php');
            }
        }
    }
?>
