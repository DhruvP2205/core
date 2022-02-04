<?php require_once('Adapter.php'); ?>
<?php

class Product{

    public function gridAction()
    {
        require_once('product-grid.php');
    }

    public function saveAction()
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $adapter = new Adapter();

            $productName = $_POST['product']['name'];
            $productPrice = $_POST['product']['price'];
            $productQunty = $_POST['product']['quantity'];
            $productStatus = $_POST['product']['status'];
            $createdDate = date("Y-m-d H:i:s");
            $updatedDate = date("Y-m-d H:i:s");

            if($_POST["submit"] == "Save")
            {
                $result = $adapter->insert("insert into product(name,price,quantity,status,createdDate) values ('{$productName}','{$productPrice}','{$productQunty}','{$productStatus}','{$createdDate}')");

                if($result)
                {
                    header('Location: product-index.php?a=gridAction');
                }
            }
            
            if($_POST["Update"] == "update")
            {
                $adapter=new Adapter();
                $productID = $_GET['id'];

                $result=$adapter->update("update product set name ='$productName', price = '$productPrice', quantity='$productQunty',status ='$productStatus', updatedDate='$updatedDate' where productID = $productID");
                if($result)
                {
                    header('Location: product-index.php?a=gridAction');
                }
            }
        }
    }

    public function editAction()
    {
        require_once('product-edit.php');
    }

    public function addAction()
    {
        require_once('product-add.php');
    }

    public function deleteAction()
    {
        if($_SERVER['REQUEST_METHOD']=='GET')
        {
            $productID = $_GET['id'];
            $adapter = new Adapter();
            $result = $adapter->delete("DELETE FROM product WHERE productID = '$productID'");
            if($result)
            {
                header('Location: product-index.php?a=gridAction');
            }
        }
    }

    public function errorAction()
    {
        echo "404<br>Not Found.";
    }
}

$action = ($_GET['a']) ? $_GET['a'] : 'errorAction';
$product = new Product();
$product->$action();
?>
