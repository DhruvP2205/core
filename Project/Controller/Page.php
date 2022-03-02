<?php Ccc::loadClass('Controller_Core_Action');?>
<?php 

class Controller_Page extends Controller_Core_Action
{
    public function gridAction()
    {
        $content = $this->getLayout()->getContent();
        $pageGrid = Ccc::getBlock('Page_Grid');
        $content->addChild($pageGrid,'Grid');
        $this->renderLayout();
    }

    public function addAction()
    {
        $pageModel = Ccc::getModel('Page');
        $content = $this->getLayout()->getContent();
        $pageAdd = Ccc::getBlock('Page_Edit')->setData(['page'=>$pageModel]);
        $content->addChild($pageAdd,'Add');
        $this->renderLayout();
    }

    public function editAction()
    {
        try 
        {
            $pageModel = Ccc::getModel('Page');
            $request = $this->getRequest();
            $id = (int)$request->getRequest('id');
            if(!$id)
            {
                throw new Exception("Invalid Request", 1);
            }
            
            $page = $pageModel->load($id);
            if(!$page)
            {
                throw new Exception("System is unable to find record.", 1);
            }

            $content = $this->getLayout()->getContent();
            $pageEdit = Ccc::getBlock('Page_Edit')->setData(['page'=>$page]);
            $content->addChild($pageEdit,'Edit');
            $this->renderLayout();
        }    
        catch (Exception $e) 
        {
            throw new Exception("Invalid Request.", 1);
        }
    }


    public function deleteAction()
    {
        try
        {
            $pageModel = Ccc::getModel('Page');
            $request=$this->getRequest();

            if(!$request->getRequest('id'))
            {
                throw new Exception("Invelid Request", 1);
            }

            $id = $request->getRequest('id');
            $page_id = $pageModel->load($id)->delete();

            $this->redirect($this->getView()->getUrl('grid','page',[],true));
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
            $this->redirect($this->getView()->getUrl('grid','page',[],true));
        }
    }


    public function saveAction()
    {
        try
        {
            $pageModel = Ccc::getModel('Page');
            $request = $this->getRequest();

            if(!$request->isPost())
            {
                throw new Exception("Request Invalid.",1);
            }

            $postData = $request->getPost('page');

            if(!$postData)
            {
                throw new Exception("Invalid data Posted.", 1);
            }

            $page = $pageModel;
            $page->setData($postData);

            if(!($page->pageId))
            {
                unset($page->pageId);
                $page->createdDate = date('y-m-d h:m:s');
                $result=$page->save();

                if(!$result)
                {
                    throw new Exception("unable to Updated Record.", 1);
                }   
            }
            else
            {
                if(!(int)$page->pageId)
                {
                    throw new Exception("Invelid Request.",1);
                }
                $page->updatedDate = date('y-m-d h:m:s');
                $result=$page->save();
                
                if(!$result)
                {
                    throw new Exception("unable to insert Record.", 1);
                }
            }
            $this->redirect($this->getView()->getUrl('grid','page',[],true));
        } 
        catch (Exception $e) 
        {
            $this->redirect($this->getView()->getUrl('grid','page',[],true));
        }
    }
}
?>
