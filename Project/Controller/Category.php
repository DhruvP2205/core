<?php Ccc::loadClass('Controller_Core_Action');

class Controller_Category extends Controller_Core_Action{

    public function gridAction()
    {
        $content = $this->getLayout()->getContent();
        $categoryGrid = Ccc::getBlock('Category_Grid');
        $content->addChild($categoryGrid,'Grid');
        $this->renderLayout();
    }

    public function addAction()
    {
        $categoryModel = Ccc::getModel('Category');
        $content = $this->getLayout()->getContent();
        $categoryAdd = Ccc::getBlock('category_Edit')->setData(['category'=>$categoryModel]);
        $content->addChild($categoryAdd,'Add');
        $this->renderLayout();
    }

    public function saveAction()
    {
        try
        {
            $categoryModel = Ccc::getModel('Category');
            $request = $this->getRequest();
            $id = $request->getRequest('id');
            if($request->isPost())
            {
                $postData = $request->getPost('category');
                $categoryData = $categoryModel->setData($postData);
                if(!empty($id))
                {
                    $categoryData->categoryId = $id;
                    $categoryData->updatedDate = date('y-m-d h:m:s');
                    if(!$postData['parentId'])
                    {
                        $categoryData->parentId = NULL;
                    }
                    $result = $categoryModel->save();
                    if(!$result)
                    {
                        $this->getMessage()->addMessage('unable to update.',1);
                        throw new Exception("Sysetm is unable to save your data", 1);   
                    }
                    
                    $allPath = $categoryModel->fetchAll("SELECT * FROM `category` WHERE `path` LIKE '%$id%' ");
                    foreach ($allPath as $path) 
                    {
                        $finalPath = explode('/',$path->path);
                        foreach ($finalPath as $subPath) 
                        {
                            if($subPath == $id)
                            {
                                if(count($finalPath) != 1)
                                {
                                    array_shift($finalPath);
                                }    
                                break;
                            }
                            array_shift($finalPath);
                        }
                        if($path->parentId)
                        {
                            $parentPath = $categoryModel->load($path->parentId);
                            $path->path = $parentPath->path ."/".implode('/',$finalPath);
                        }
                        else
                        {
                            $path->path = $path->categoryId;
                        }
                        $result = $path->save();
                    }
                    $this->getMessage()->addMessage('Data Updated Successfully.',1);
                }
                else
                {
                    $categoryData->createdDate = date('y-m-d h:m:s');
                    if(!$categoryData->parentId)
                    {
                        unset($categoryData->parentId);
                        $insert = $categoryModel->save();
                        if(!$insert->categoryId)
                        {
                            $this->getMessage()->addMessage('unable to Inser Data.',3);
                            throw new Exception("system is unabel to insert your data", 1);
                        }
                        $categoryData->resetData();
                        $categoryData->path = $insert->categoryId;
                        $categoryData->categoryId = $insert->categoryId;
                        $result = $categoryModel->save();
                        $this->getMessage()->addMessage('data inserted successfully',1);
                    }
                    else
                    {
                        $insert = $categoryModel->save();
                        if(!$insert->categoryId)
                        {
                            throw new Exception("system is unabel to insert your data", 1);
                        }
                        $categoryData->categoryId = $insert->categoryId;
                        $parentPath = $categoryModel->load($categoryData->parentId);
                        $categoryData->path = $parentPath->path."/". $insert->categoryId;
                        $result = $categoryData->save();
                    }
                    if(!$result)
                    {
                        $this->getMessage()->addMessage('unable to insert data.',3);
                        throw new Exception("Sysetm is unable to save your data", 1);   
                    }
                }
                $this->getMessage()->addMessage('data inserted successfully',1);
                $this->redirect('grid','category',[],true);
            }
        }
        catch (Exception $e) 
        {
            $this->redirect('grid','category',[],true);
        }
    }


    public function editAction()
    {
        try
        {
            $categoryModel = Ccc::getModel('Category');
            $request = $this->getRequest();

            $id = $request->getRequest('id');
            
            if(!$id)
            {
                $this->getMessage()->addMessage('Request Invalid.',3);
                throw new Exception("Request Invalid.", 1);
            }

            if(!(int)$id)
            {
                $this->getMessage()->addMessage('Request Invalid.',3);
                throw new Exception("Request Invalid.", 1);
            }

            $category = $categoryModel->load($id);

            if(!$category)
            {
                $this->getMessage()->addMessage('System is unable to find record.',3); 
                throw new Exception("System is unable to find record.", 1);
            }

            $content = $this->getLayout()->getContent();
            $categoryEdit = Ccc::getBlock('Category_Edit')->setData(['category'=>$category]);
            $content->addChild($categoryEdit,'Edit');
            $this->renderLayout();
        }
        catch (Exception $e)
        {
            $this->redirect('grid','category',[],true);
        }
    }

    public function deleteAction()
    {
        try
        {
            $categoryModel = Ccc::getModel('Category');
            $request = $this->getRequest();

            if(!$request->getRequest('id'))
            {
                $this->getMessage()->addMessage('Request Invalid.',3);
                throw new Exception("Request Invalid.", 1);
            }

            $id = $request->getRequest('id');
            if(!$id)
            {
                $this->getMessage()->addMessage('Unable to find data.',3);
                throw new Exception("Unable to find data.", 1);
            }
            $result = $categoryModel->load($id)->delete();

            if(!$result)
            {
                $this->getMessage()->addMessage('Unable to Delete Record.',3);
                throw new Exception("Unable to Delete Record.", 1);
            }
            $this->getMessage()->addMessage('Data Deleted.');
            $this->redirect('grid','category',[],true);
        }
        catch (Exception $e) 
        {
            $this->redirect('grid','category',[],true);
        }
    }
}
