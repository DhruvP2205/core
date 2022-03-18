<?php Ccc::loadClass('Controller_Admin_Action');

class Controller_Category extends Controller_Admin_Action
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
        $this->setTitle('Category');
        $content = $this->getLayout()->getContent();
        $categoryGrid = Ccc::getBlock('Category_Grid');
        $content->addChild($categoryGrid,'Grid');
        $this->renderLayout();
    }

    public function addAction()
    {
        $this->setTitle('Add Category');
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
                        throw new Exception("Sysetm is unable to save your data");   
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
                            throw new Exception("system is unabel to insert your data");
                        }
                        $categoryId = $insert->categoryId;
                        $categoryData->resetData();
                        $categoryData->path = $categoryId;
                        $categoryData->categoryId = $categoryId;
                        $result = $categoryModel->save();
                        $this->getMessage()->addMessage('data inserted successfully',1);
                    }
                    else
                    {
                        $insert = $categoryModel->save();
                        if(!$insert->categoryId)
                        {
                            throw new Exception("system is unabel to insert your data");
                        }
                        $categoryData->categoryId = $insert->categoryId;
                        $parentPath = $categoryModel->load($categoryData->parentId);
                        $categoryData->path = $parentPath->path."/". $insert->categoryId;
                        $result = $categoryData->save();
                    }
                    if(!$result)
                    {
                        throw new Exception("Sysetm is unable to save your data");   
                    }
                }
                $this->getMessage()->addMessage('data inserted successfully',1);
                $this->redirect('grid','category',[],true);
            }
        }
        catch (Exception $e) 
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->redirect('grid','category',[],true);
        }
    }


    public function editAction()
    {
        try
        {
            $this->setTitle('Edit Category');
            $categoryModel = Ccc::getModel('Category');
            $request = $this->getRequest();

            $id = $request->getRequest('id');
            
            if(!$id)
            {
                throw new Exception("Request Invalid.");
            }

            if(!(int)$id)
            {
                throw new Exception("Request Invalid.");
            }

            $category = $categoryModel->load($id);

            if(!$category)
            {
                throw new Exception("System is unable to find record.");
            }

            $content = $this->getLayout()->getContent();
            $categoryEdit = Ccc::getBlock('Category_Edit')->setData(['category'=>$category]);
            $content->addChild($categoryEdit,'Edit');
            $this->renderLayout();
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
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
                throw new Exception("Request Invalid.");
            }

            $id = $request->getRequest('id');

            if(!$id)
            {
                throw new Exception("Unable to find data.");
            }

            $mediaData = $categoryModel->fetchAll("SELECT `name` FROM `category_media` WHERE  `categoryId` = {$id}");
            foreach ($mediaData as $data)
            {
                unlink(Ccc::getBlock('Category_Grid')->getBaseUrl("Media/category/"). $data->name);
            }

            $result = $categoryModel->load($id);

            if(!$result)
            {
                throw new Exception("Unable to Delete Record.");
            }
            $result->delete();
            $this->getMessage()->addMessage('Data Deleted.');
            $this->redirect('grid','category',[],true);
        }
        catch (Exception $e) 
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->redirect('grid','category',[],true);
        }
    }
}
