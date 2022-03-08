<?php Ccc::loadClass('Controller_Core_Action');

class Controller_Product extends Controller_Core_Action
{
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
                $this->getMessage()->addMessage('Request Invalid.',3);
            }

            $product = $productModel->load($id);

            if(!$product)
            {
                $this->getMessage()->addMessage('System is unable to find record.',3); 
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
            $mediaModel = Ccc::getModel('Product_Media');
            $request = $this->getRequest();

            if(!$request->getRequest('id'))
            {
                $this->getMessage()->addMessage('Request Invalid.',3);
            }

            $productId = $request->getRequest('id');
            if(!$productId)
            {
                $this->getMessage()->addMessage('Unable to fetch ID.',3);
            }

            $medias = $productModel->fetchAll("SELECT name FROM media WHERE  productId='$productId'");
            foreach ($medias as $media)
            {
                unlink($this->getView()->getBaseUrl("Media/Product/"). $media->name);
            }

            $result = $productModel->load($productId)->delete();
            if(!$result)
            {
                $this->getMessage()->addMessage('Unable to Delete Record.',3);
            }
            $this->getMessage()->addMessage('Data Deleted.');
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
                $this->getMessage()->addMessage('Request Invalid.',3);
            }

            $postData = $request->getPost('product');
            $categoryData = $request->getPost('category');
            
            
            if(!$postData)
            {
                $this->getMessage()->addMessage('Invalid data Posted.',3);
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
                    $this->getMessage()->addMessage('Unable to Save Record.',3);
                    throw new Exception("Error Processing Request", 1);
                }

                foreach($categoryData as $category)
                {
                    $productCategoryModel = Ccc::getModel('Product_Category');
                    $productCategoryModel->productId = $result;
                    $productCategoryModel->categoryId = $category;

                    $productCategoryModel->save();
                }
                $this->getMessage()->addMessage('Your Data save Successfully');
            }
            else
            {
                if(!(int)$product->productId)
                {
                    $this->getMessage()->addMessage('Invalid Request.',3);
                    throw new Exception("Error Processing Request", 1);
                }

                $product->updatedDate = date('y-m-d h:m:s');
                $result = $product->save();

                if(!$result)
                {
                    $this->getMessage()->addMessage('Unable to Update Record.',3);
                }

                $productCategoryModel = Ccc::getModel('Product_Category');
                $categoryProduct = $productCategoryModel->fetchAll("SELECT * FROM `category_product` WHERE `productId` = '$product->productId' ");

                foreach($categoryProduct as $category)
                {
                    $productCategoryModel->load($category->entityId)->delete();
                }

                foreach($categoryData as $category)
                {
                    $productCategoryModel = Ccc::getModel('Product_Category');
                    $productCategoryModel->productId = $product->productId;
                    $productCategoryModel->categoryId = $category;
                    $productCategoryModel->save();
                }
                $this->getMessage()->addMessage('Your Data Update Successfully');
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
