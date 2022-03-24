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
        $this->setTitle('Product');
        $content = $this->getLayout()->getContent();
        $productGrid = Ccc::getBlock('Product_Grid');
        $content->addChild($productGrid,'Grid');
        $this->renderLayout();
    }

    public function addAction()
    {
        $this->setTitle('Add Product');
        $productModel = Ccc::getModel('Product');
        $content = $this->getLayout()->getContent();
        $productAdd = Ccc::getBlock('Product_Edit')->setData(['product'=>$productModel]);
        $content->addChild($productAdd,'Add');
        $this->renderLayout();
    }

    public function saveAction()
    {
        try
        {
            $productModel = Ccc::getModel('Product');
            $request = $this->getRequest();

            if(!$request->isPost())
            {
                throw new Exception("Request Invalid.");
            }

            $postData = $request->getPost('product');
            $categoryIds = $request->getPost('category');
            $type = $request->getPost('discountType');
            if(!$postData)
            {
                throw new Exception("Invalid data Posted.");
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
                    throw new Exception("Error Processing Request");
                }
                $product->updatedDate = date('y-m-d h:m:s');
            }
            if($type == 2)
            {
                $product->discount = $product->price * $product->discount / 100 ;
            }
            if(!($product->costPrice <= ($product->price - $product->discount) && $product->price - $product->discount <= $product->price) || $product->discount<0)
            {
                throw new Exception("Invalid Discount.");
            }
            
            $result = $product->save();
            if(!$result)
            {
                throw new Exception("unable to Updated Record.");
            }

            if(!$categoryIds)
            {
                $categoryIds['exists'] = []; 
            }

            $product->saveCategories($categoryIds);
            $this->getMessage()->addMessage('Product saved.');
            $this->redirect('grid','product',[],true);
        } 
        catch (Exception $e) 
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->redirect('grid','product',[],true);
        }
    }

    public function editAction()
    {
        try 
        {
            $this->setTitle('Edit Product');
            $productModel = Ccc::getModel('Product');
            $request = $this->getRequest();
            $id = (int)$request->getRequest('id');

            if(!$id)
            {
                throw new Exception("Invalid Request.");
            }

            $product = $productModel->load($id);

            if(!$product)
            {
                throw new Exception("System is unable to find record."); 
            }
            $content = $this->getLayout()->getContent();
            $productEdit = Ccc::getBlock('Product_Edit')->setData(['product'=>$product]);
            $content->addChild($productEdit,'Edit');
            $this->renderLayout();
        } 
        catch (Exception $e) 
        {
            throw new Exception("System is unable to find record.");
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
                throw new Exception("Request Invalid.");
            }

            $productId = $request->getRequest('id');
            if(!$productId)
            {
                throw new Exception("Unable to fetch ID.");
            }
            
            $medias = $productModel->fetchAll("SELECT `name` FROM `product_media` WHERE  `productId` = {$productId}");
            foreach ($medias as $media)
            {
                unlink(Ccc::getBlock('Product_Grid')->getBaseUrl("Media/Product/"). $media->name);
            }

            $result = $productModel->load($productId);
            if(!$result)
            {
                throw new Exception("Unable to Delete Record.");
            }
            $result->delete();
            $this->getMessage()->addMessage('Data Deleted.');
            $this->redirect('grid','product',[],true);
        } 
        catch (Exception $e) 
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->redirect('grid','product',[],true);
        }       
    }
}
