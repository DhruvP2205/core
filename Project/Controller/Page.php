<?php Ccc::loadClass('Controller_Admin_Action');

class Controller_Page extends Controller_Admin_Action
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
        $this->setTitle('Page');
        $content = $this->getLayout()->getContent();
        $pageGrid = Ccc::getBlock('Page_Grid');
        $content->addChild($pageGrid,'Grid');
        $this->renderLayout();
    }

    public function addAction()
    {
        $this->setTitle('Add Page');
        $pageModel = Ccc::getModel('Page');
        $content = $this->getLayout()->getContent();
        $pageAdd = Ccc::getBlock('Page_Edit')->setData(['page'=>$pageModel]);
        $content->addChild($pageAdd,'Add');
        $this->renderLayout();
    }

    public function saveAction()
    {
        try
        {
            $pageModel = Ccc::getModel('Page');
            $request = $this->getRequest();

            if(!$request->isPost())
            {
                $this->getMessage()->addMessage('Request Invalid.',3);
                throw new Exception("Request Invalid.", 1);
            }

            $postData = $request->getPost('page');

            if(!$postData)
            {
                $this->getMessage()->addMessage('Invalid data Posted.',3);
                throw new Exception("Invalid data Posted.", 1);
            }

            $page = $pageModel;
            $page->setData($postData);

            if(!($page->pageId))
            {
                unset($page->pageId);
                $page->createdDate = date('y-m-d h:m:s'); 
            }
            else
            {
                if(!(int)$page->pageId)
                {
                    $this->getMessage()->addMessage('Invalid Request.',3);
                    throw new Exception("Invalid Request.", 1);
                }
                $page->updatedDate = date('y-m-d h:m:s');
            }
            $result = $page->save();

            if(!$result)
            {
                $this->getMessage()->addMessage('Unable to Save Record.',3);
                throw new Exception("Unable to Save Record.", 1);
            } 
            $this->getMessage()->addMessage('Your Data saved Successfully.');
            $this->redirect('grid','page',[],true);
        } 
        catch (Exception $e) 
        {
            $this->redirect('grid','page',[],true);
        }
    }

    public function editAction()
    {
        try 
        {
            $this->setTitle('Edit Page');
            $pageModel = Ccc::getModel('Page');
            $request = $this->getRequest();
            
            $id = (int)$request->getRequest('id');
            if(!$id)
            {
                $this->getMessage()->addMessage('Request Invalid.',3);
                throw new Exception("Request Invalid.", 1);
            }
            
            $page = $pageModel->load($id);
            if(!$page)
            {
                $this->getMessage()->addMessage('System is unable to find record.',3);
                throw new Exception("System is unable to find record.", 1);
            }

            $content = $this->getLayout()->getContent();
            $pageEdit = Ccc::getBlock('Page_Edit')->setData(['page'=>$page]);
            $content->addChild($pageEdit,'Edit');
            $this->renderLayout();
        }    
        catch (Exception $e) 
        {
            $this->redirect('grid','page',[],true);
        }
    }

    public function deleteAction()
    {
        try
        {
            $pageModel = Ccc::getModel('Page');
            $request = $this->getRequest();

            $deleteId = $request->getPost('page');
            if($deleteId)
            {
                foreach ($deleteId as $id)
                {
                    $result = $pageModel->load($id);
                    if(!$result)
                    {
                        $this->getMessage()->addMessage('unable to delete.',3);
                        throw new Exception("Unable to Save", 1);
                    }
                    $result->delete();
                }
                $this->getMessage()->addMessage('Data deleted.');
                $this->redirect('grid','page',[],true);
            }

            if(!$request->getRequest('id'))
            {
                $this->getMessage()->addMessage('Request Invalid.',3);
                throw new Exception("Request Invalid.", 1);
            }

            $id = $request->getRequest('id');
            if(!$id)
            {
                $this->getMessage()->addMessage('Unable to fetch ID.',3);
                throw new Exception("Unable to fetch ID.", 1);
            }

            $result = $pageModel->load($id);
            if(!$result)
            {
                $this->getMessage()->addMessage('Unable to Delete Record.',3);
                throw new Exception("Unable to Delete Record.", 1);
            }
            $result->delete();
            $this->getMessage()->addMessage('Data Deleted.');
            $this->redirect('grid','page',[],true);
        }
        catch(Exception $e)
        {
            $this->redirect('grid','page',[],true);
        }
    }
}
