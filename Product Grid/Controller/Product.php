<?php

Ccc::loadClass('Controller_Core_Action');

class Controller_Product extends Controller_Core_Action{

    public function gridAction()
    {
        $adapter = new Model_Core_Adapter();
        $products = $adapter->fetchAll("SELECT * FROM product");
        
        $view = $this->getView();
        $view->setTemplate('view/product/grid.php');
        $view->addData('products',$products);
        $view->toHtml();
    }

    protected function saveProduct(){
        try {
            if(!isset($_POST['product']))
            {
                throw new Exception("Request Invelid.",1);
            }
            
            $adapter = new Model_Core_Adapter();

            $row = $_POST['product'];
                
            $productName = $_POST['product']['name'];
            $productPrice = $_POST['product']['price'];
            $productQunty = $_POST['product']['quantity'];
            $productStatus = $_POST['product']['status'];
            $createdDate = date("Y-m-d H:i:s");
            $updatedDate = date("Y-m-d H:i:s");

            if(isset($_GET['id']))
            {
                if(!(int)$_GET['id']){
                    throw new Exception("Invalid Request.", 1);
                }
                $productID = $_GET['id'];

                $result = $adapter->update("update product set name ='$productName', price = '$productPrice', quantity='$productQunty',status ='$productStatus', updatedDate='$updatedDate' where productID = $productID");
                if(!$result)
                {
                    throw new Exception("System is unable to update record.",1);
                }
            }
            else{
                $result = $adapter->insert("insert into product(name,price,quantity,status,createdDate) values ('{$productName}','{$productPrice}','{$productQunty}','{$productStatus}','{$createdDate}')");

                if(!$result)
                {
                    throw new Exception("System is unable to save record.",1);
                }

                return $result;
            }
        } catch (Exception $e) {
            /*echo $e->getMessage();*/
            $this->redirect('index.php?c=product&a=grid');
        }
    }

    public function saveAction()
    {
        try
        {
            $this->saveProduct();
            $this->redirect('index.php?c=product&a=grid');
        }
        catch (Exception $e) 
        {
            $this->redirect('index.php?c=product&a=grid');
        }
    }

    public function editAction()
    {
        try
        {
            if(!isset($_GET['id']))
            {
                throw new Exception("Invalid Request.", 1);
            }
            if(!(int)$_GET['id'])
            {
                throw new Exception("Invalid Request.", 1);
            }

            $productID = $_GET['id'];

            $adapter = new Model_Core_Adapter();
            $product = $adapter->fetchRow("select * FROM product WHERE productID = $productID");

            $view = $this->getView();
            $view->addData('product',$product);
            $view->setTemplate('view/product/edit.php');
            $view->toHtml();

        }
        catch (Exception $e)
        {
            /*echo $e->getMessage();*/
            $this->redirect('index.php?c=product&a=grid');
        }
        require_once('view/product/edit.php');
    }

    public function addAction()
    {
        $view = $this->getView();
        $view->setTemplate('view/product/add.php');
        $view->toHtml();
    }

    protected function deleteProduct(){
        try {
            if($_SERVER['REQUEST_METHOD']=='GET')
            {
                if(!isset($_GET['id'])){
                    throw new Exception("Invalid Request.", 1);
                }
                if(!(int)$_GET['id']){
                    throw new Exception("Invalid Request.", 1);
                }
                $productID = $_GET['id'];
                $adapter = new Model_Core_Adapter();
                $result = $adapter->delete("DELETE FROM product WHERE productID = '$productID'");
                if(!$result)
                {
                    throw new Exception("System is unable to delete record.",1);
                }
                $this->redirect('index.php?c=product&a=grid');
            }
        } catch (Exception $e) {
            /*echo $e->getMessage();*/
            $this->redirect('index.php?c=product&a=grid');
        }
    }

    public function deleteAction()
    {
        try
        {
            $this->deleteProduct();
            $this->redirect('index.php?c=product&a=grid');
        }
        catch (Exception $e) 
        {
            $this->redirect('index.php?c=product&a=grid');
        }
    }

    public function redirect($url)
    {
        header("Location: $url");
        exit();
    }

    public function errorAction()
    {
        echo "404<br>Not Found.";
    }
}

?>
