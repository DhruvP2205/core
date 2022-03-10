<?php Ccc::loadClass('Controller_Admin_Action');

class Controller_Product extends Controller_Admin_Action
{
    public function __construct()
    {
        if(!$this->authentication())
        {
            $this->redirect('login','admin_login');
        }
    }
    
    public function gridAction()
    {
        $content = $this->getLayout()->getContent();
        $productGrid = Ccc::getBlock('Product_Grid');
        $content->addChild($productGrid,'Grid');
        $this->renderLayout();
    }

    public function addAction()
    {
        $productModel = Ccc::getModel('Product');
        $content = $this->getLayout()->getContent();
        $productAdd = Ccc::getBlock('Product_Edit')->setData(['product'=>$productModel]);
        $content->addChild($productAdd,'Add');
        $this->renderLayout();
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
                $this->getMessage()->addMessage('Invalid Request.',3);
                throw new Exception("Invalid Request.", 1);
            }

            $product = $productModel->load($id);

            if(!$product)
            {
                $this->getMessage()->addMessage('System is unable to find record.',3);
                throw new Exception("System is unable to find record.", 1); 
            }
            $content = $this->getLayout()->getContent();
            $productEdit = Ccc::getBlock('Product_Edit')->setData(['product'=>$product]);
            $content->addChild($productEdit,'Edit');
            $this->renderLayout();
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
                $this->getMessage()->addMessage('Request Invalid.',3);
                throw new Exception("Request Invalid.", 1);
            }

            $productId = $request->getRequest('id');
            if(!$productId)
            {
                $this->getMessage()->addMessage('Unable to fetch ID.',3);
                throw new Exception("Unable to fetch ID.", 1);
            }
            
            $medias = $productModel->fetchAll("SELECT `name` FROM `media` WHERE  `productId` = {$productId}");
            foreach ($medias as $media)
            {
                unlink($this->getView()->getBaseUrl("Media/Product/"). $media->name);
            }

            $result = $productModel->load($productId)->delete();
            if(!$result)
            {
                $this->getMessage()->addMessage('Unable to Delete Record.',3);
                throw new Exception("Unable to Delete Record.", 1);
            }
            $this->getMessage()->addMessage('Data Deleted.');
            $this->redirect('grid','product',[],true);
        } 
        catch (Exception $e) 
        {
            $this->redirect('grid','product',[],true);
        }       
    }


    public function saveAction()
    {
        try
        {
            $productModel = Ccc::getModel('Product');
            $request = $this->getRequest();

            if(!$request->isPost())
            {
                $this->getMessage()->addMessage('Request Invalid.',3);
                throw new Exception("Request Invalid.", 1);
            }

            $postData = $request->getPost('product');
            $categoryIds = $request->getPost('category');
            if(!$postData)
            {
                $this->getMessage()->addMessage('Invalid data Posted.',3);
                throw new Exception("Invalid data Posted.", 1);
            }
            
            $product = $productModel;
            $product->setData($postData);

            if(!($product->productId))
            {
                unset($product->productId);
                $product->createdDate = date('y-m-d h:m:s');
            }
            else
            {
                if(!(int)$product->productId)
                {
                    $this->getMessage()->addMessage('Invalid Request.',3);
                    throw new Exception("Error Processing Request", 1);
                }
                $product->updatedDate = date('y-m-d h:m:s');
            }

            $result = $product->save();
            if(!$result)
            {
                $this->getMessage()->addMessage('unable to inserted.',3);
                throw new Exception("unable to Updated Record.", 1);
            }

            if(!$categoryIds)
            {
                $categoryIds['exists'] = []; 
            }

            $product->saveCategories($categoryIds);
            $this->getMessage()->addMessage('Data inserted.');
            $this->redirect('grid','product',[],true);
        } 
        catch (Exception $e) 
        {
            $this->redirect('grid','product',[],true);
        }
    }
}
