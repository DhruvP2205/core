<?php Ccc::loadClass('Controller_Core_Action');

class Controller_Product extends Controller_Core_Action
{
    public function gridAction()
    {
        Ccc::getBlock('Product_Grid')->toHtml();
    }

    public function addAction()
    {
        $productModel = Ccc::getModel('Product');
        Ccc::getBlock('Product_Edit')->setData(['product'=>$productModel])->toHtml();
    }

    public function editAction()
    {
        try 
        {
            $productModel = Ccc::getModel('Product');
            $request = $this->getRequest();
            $id = (int)$request->getRequest('id');

            if(!$id)
            {
                throw new Exception("Invalid Request", 1);
            }

            $product = $productModel->load($id);

            if(!$product)
            {
                throw new Exception("System is unable to find record.", 1);
            }
            
            Ccc::getBlock('Product_Edit')->addData('product',$product)->toHtml();   
        } 
        catch (Exception $e) 
        {
            throw new Exception("System is unable to find record.", 1);
        }
    }

    public function deleteAction()
    {
        try 
        {
            $productModel = Ccc::getModel('Product');
            $request = $this->getRequest();

            if(!$request->getRequest('id'))
            {
                throw new Exception("Invalid Request.", 1);
            }

            $productId = $request->getRequest('id');
            if(!$productId)
            {
                throw new Exception("Unable to fetch ID.", 1);
            }

            $medias = $productModel->fetchAll("SELECT name FROM media WHERE  productId='$productId'");
            foreach ($medias as $media)
            {
                unlink($this->getView()->getBaseUrl("Media/Product/"). $media->name);
            }

            $result = $productModel->load($productId)->delete();
            if(!$result)
            {
                throw new Exception("Unable to Delet Record.", 1);   
            }

            $this->redirect($this->getView()->getUrl('grid','product',[],true));
        } 
        catch (Exception $e) 
        {
            $this->redirect($this->getView()->getUrl('grid','product',[],true));
        }       
    }


    public function saveAction()
    {
        try
        {
            $request = $this->getRequest();
            $productModel = Ccc::getModel('Product');

            if(!$request->isPost())
            {
                throw new Exception("Request Invalid.",1);
            }

            $postData = $request->getPost('product');

            if(!$postData)
            {
                throw new Exception("Invalid data Posted.", 1);
            }

            $product = $productModel;
            $product->setData($postData);

            if(!($product->productId))
            {
                unset($product->productId);
                $product->createdDate = date('y-m-d h:m:s');
                $result = $product->save();
                if(!$result)
                {
                    throw new Exception("unable to Updated Record.", 1);
                }   
            }
            else
            {
                if(!(int)$product->productId)
                {
                    throw new Exception("Invelid Request.",1);
                }

                $product->updatedDate = date('y-m-d h:m:s');
                $result=$product->save();

                if(!$result)
                {
                    throw new Exception("unable to insert Record.", 1);
                }
            }
            $this->redirect($this->getView()->getUrl('grid','product',[],true));
        } 
        catch (Exception $e) 
        {
            $this->redirect($this->getView()->getUrl('grid','product',[],true));
        }
    }
}


?>