<?php

Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
Ccc::loadClass('Model_Admin');

$c = new Ccc();

class Controller_Product extends Controller_Core_Action
{
    public function gridAction()
    {
        $adapter = new Model_Core_Adapter();
        $products = $adapter->fetchAll("SELECT * FROM product");
        
        $view = $this->getView();
        $view->setTemplate('view/product/grid.php');
        $view->addData('products',$products);

        $view->toHtml();
    }

    protected function saveProduct()
    {
        try
        {
            global $c;
            $post = $c->getFront()->getRequest();
            $post->getPost();
            if(!$post->ispost('product'))
            {
                throw new Exception("Request Invelid.",1);
            }
            
            $adapter = new Model_Core_Adapter();

            $row = $post->getPost('product');
                
            $productName = $row['name'];
            $productPrice = $row['price'];
            $productQunty = $row['quantity'];
            $productStatus = $row['status'];
            $createdDate = date("Y-m-d H:i:s");
            $updatedDate = date("Y-m-d H:i:s");

            if(array_key_exists('productID',$row))
            {
                $productID = $row['productID'];

                if(!(int)$productID)
                {
                    throw new Exception("Invalid Request.", 1);
                }

                $result = $adapter->update("update product set name ='$productName', price = '$productPrice', quantity='$productQunty',status ='$productStatus', updatedDate='$updatedDate' where productID = $productID");

                if(!$result)
                {
                    throw new Exception("System is unable to update record.",1);
                }
            }
            else
            {
                $result = $adapter->insert("insert into product(name,price,quantity,status,createdDate) values ('{$productName}','{$productPrice}','{$productQunty}','{$productStatus}','{$createdDate}')");

                if(!$result)
                {
                    throw new Exception("System is unable to save record.",1);
                }

                return $result;
            }
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            exit();
            /*$this->redirect('index.php?c=product&a=grid');*/
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
            global $c;
            $request = $c->getFront()->getRequest();
            $productID = $request->getRequest('id');

            if(!(int)$productID)
            {
                throw new Exception("Invalid Request.", 1);
            }

            $adapter = new Model_Core_Adapter();
            $product = $adapter->fetchRow("select * FROM product WHERE productID = $productID");

            $view = $this->getView();
            $view->addData('product',$product);
            $view->setTemplate('view/product/edit.php');
            $view->toHtml();

        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            exit();
            /*$this->redirect('index.php?c=product&a=grid');*/
        }
    }

    public function addAction()
    {
        $view = $this->getView();
        $view->setTemplate('view/product/add.php');
        $view->toHtml();
    }

    protected function deleteProduct()
    {
        try
        {
            global $c;
            $request = $c->getFront()->getRequest();

            if(!$request->getRequest('id'))
            {
                throw new Exception("Invelid Request", 1);
            }

            $productID = $request->getRequest('id');
            
            if(!(int)$productID)
            {
                throw new Exception("Invalid Request.", 1);
            }

            $adapter = new Model_Core_Adapter();
            $result = $adapter->delete("DELETE FROM product WHERE productID = '$productID'");
            if(!$result)
            {
                throw new Exception("System is unable to delete record.",1);
            }
            $this->redirect('index.php?c=product&a=grid');
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            exit();
            /*$this->redirect('index.php?c=product&a=grid');*/
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
