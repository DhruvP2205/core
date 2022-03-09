<?php
Ccc::loadClass('Controller_Core_Action');

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
                        $this->getMessage()->addMessage('Sysetm is unable to save your data.',3);
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
                    $this->getMessage()->addMessage('Your Data updated Successfully');
                }
                else
                {
                    $categoryData->createdDate = date('y-m-d h:m:s');

                    if(!$categoryData->parentId)
                    {
                        unset($categoryData->parentId);
                        $insertId = $categoryModel->save();

                        if(!$insertId)
                        {
                            $this->getMessage()->addMessage('Sysetm is unable to insert your data.',3);
                        }

                        $categoryData->resetData();
                        $categoryData->path = $insertId;
                        $categoryData->categoryId = $insertId;
                        $result = $categoryModel->save();
                    }
                    else
                    {
                        $insertId = $categoryModel->save();

                        if(!$insertId)
                        {
                            $this->getMessage()->addMessage('Sysetm is unable to insert your data.',3);
                        }

                        $categoryData->categoryId = $insertId;
                        $parentPath = $categoryModel->load($categoryData->parentId);
                        $categoryData->path = $parentPath->path."/". $insertId;
                        $result = $categoryData->save();
                    }
                    if(!$result)
                    {
                        $this->getMessage()->addMessage('Sysetm is unable to insert your data.',3);
                    }
                    $this->getMessage()->addMessage('Your Data save Successfully');
                }
                $this->redirect($this->getView()->getUrl('grid','category',[],true));
            }
        }
        catch (Exception $e) 
        {
            $this->redirect($this->getView()->getUrl('category','grid'));
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
            }

            if(!(int)$id)
            {
                $this->getMessage()->addMessage('Request Invalid.',3);
            }

            $category = $categoryModel->load($id);

            if(!$category)
            {
                $this->getMessage()->addMessage('System is unable to find record.',3); 
            }

            $content = $this->getLayout()->getContent();
            $categoryEdit = Ccc::getBlock('Category_Edit')->setData(['category'=>$category]);
            $content->addChild($categoryEdit,'Edit');
            $this->renderLayout();
        }
        catch (Exception $e)
        {
            $this->redirect($this->getView()->getUrl('grid','category'));
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
            }

            $id = $request->getRequest('id');
            if(!$id)
            {
                $this->getMessage()->addMessage('Unable to find data.',3);
            }
            $result = $categoryModel->load($id)->delete();

            if(!$result)
            {
                $this->getMessage()->addMessage('Unable to Delete Record.',3);
            }
            $this->getMessage()->addMessage('Data Deleted.');
            $this->redirect($this->getView()->getUrl('grid','category',[],true));
        }
        catch (Exception $e) 
        {
            $this->redirect($this->getView()->getUrl('grid','category'));
        }
    }
}

?>
