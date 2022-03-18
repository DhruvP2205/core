<?php Ccc::loadClass('Controller_Admin_Action');

class Controller_Admin extends Controller_Admin_Action
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
        $this->setTitle('Admin');
        $adminGrid = Ccc::getBlock('Admin_Grid');
        $content = $this->getLayout()->getContent();
        $content->addChild($adminGrid,'Grid');
        $this->renderLayout();
    }

    public function addAction()
    {
        $this->setTitle('Add Admin');
        $adminModel = Ccc::getModel('Admin');
        $content = $this->getLayout()->getContent();
        $adminAdd = Ccc::getBlock('Admin_Edit')->setData(['admin'=>$adminModel]);
        $content->addChild($adminAdd,'Add');
        $this->renderLayout();
    }

    public function saveAction()
    {
        try
        {
            $adminModel = Ccc::getModel('Admin');
            $request = $this->getRequest();

            if(!$request->isPost())
            {
                throw new Exception("Request Invalid.");
            }

            $postData = $request->getPost('admin');

            if(!$postData)
            {
                throw new Exception("Invalid data Posted.");
            }

            $admin = $adminModel;
            $admin->setData($postData);

            if(!($admin->adminId))
            {
                unset($admin->adminId);
                $admin->createdDate = date('y-m-d h:m:s');
                $admin->password = md5($admin->password);
            }
            else
            {
                if(!(int)$admin->adminId)
                {
                    throw new Exception("Invalid Request.");
                }
                $admin->updatedDate = date('y-m-d h:m:s');
            }
            $result = $admin->save();
            if(!$result)
            {
                throw new Exception("Unable to Save Record.");
            }
            $this->getMessage()->addMessage('Your Data save Successfully');
            $this->redirect('grid','admin',[],true);
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->redirect('grid','admin',[],true);
        }
    }

    public function editAction()
    {
        try
        {
            $this->setTitle('Edit Admin');
            $adminModel = Ccc::getModel('Admin');
            $request = $this->getRequest();
            $id = (int)$request->getRequest('id');

            if(!$id)
            {
                throw new Exception("Request Invalid.");
            }
            
            $admin = $adminModel->load($id);
            
            if(!$admin)
            {   
                throw new Exception("System is unable to find record.");
            }

            $content = $this->getLayout()->getContent();
            $adminEdit = Ccc::getBlock('Admin_Edit')->setData(['admin'=>$admin]);
            $content->addChild($adminEdit,'Edit');
            $this->renderLayout();
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->redirect('grid','admin',[],true);
        }
    }


    public function deleteAction()
    {
        try 
        {
            $adminModel = Ccc::getModel('Admin');
            $request = $this->getRequest();

            if(!$request->getRequest('id'))
            {
                throw new Exception("Request Invalid.");
            }

            $adminId = $request->getRequest('id');

            if(!$adminId)
            {
                throw new Exception("Unable to fetch ID.");
            }
            $result = $adminModel->load($adminId);
            if(!$result)
            {
                throw new Exception("Unable to Delete Record.");
            }
            $result->delete();
            $this->getMessage()->addMessage('Data Deleted.');
            $this->redirect('grid','admin',[],true);
        } 
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->redirect('grid','admin',[],true);
        }
    }
}
