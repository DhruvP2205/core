<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');

class Controller_Product extends Controller_Core_Action
{
    public function gridAction()
    {
        Ccc::getBlock('Product_Grid')->toHtml();
    }

    public function saveAction()
    {
        try
        {
            $request = $this->getRequest();
            if(!$request->isPost())
            {
                throw new Exception("Request Invalid.",1);
            }
            $postData = $request->getPost('product');

            if(!$postData)
            {
                throw new Exception("Request Invelid.",1);
            }
            
            $productTable = Ccc::getModel('Product');

            if(array_key_exists('productID',$postData))
            {
                $productID = $postData['productID'];

                if(!(int)$productID)
                {
                    throw new Exception("Invalid Request.", 1);
                }

                $postData['updatedDate'] = date('y-m-d h:m:s');
                $productId = $productTable->update($postData,$productID);
            }
            else
            {
                $postData['createdDate'] = date('y-m-d h:m:s');
                $productInsertedId = $productTable->insert($postData);
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

    public function editAction()
    {
        try
        {
            $productID = $this->getRequest()->getRequest('id');
            if(!$productID)
            {
                throw new Exception("Id is not valid.");
            }

            if(!(int)$productID)
            {
                throw new Exception("Invalid Request.", 1);
            }

            $productModel = Ccc::getModel('Product');
            $productTable = new Model_Product();
            $product = $productTable->fetchRow($productID);

            Ccc::getBlock('Product_Edit')->addData('product',$product)->toHtml();

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
        Ccc::getBlock('Product_Add')->toHtml();
    }

    public function deleteAction()
    {
        try
        {
            $request = $this->getRequest();

            if(!$request->getRequest('id'))
            {
                throw new Exception("Invelid Request", 1);
            }

            $productID = $request->getRequest('id');
            
            if(!(int)$productID)
            {
                throw new Exception("Invalid Request.", 1);
            }

            $productTable = Ccc::getModel('product');
            $productTable->delete($productID);
            $this->redirect('index.php?c=product&a=grid');
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            exit();
            /*$this->redirect('index.php?c=product&a=grid');*/
        }
    }
}

?>
