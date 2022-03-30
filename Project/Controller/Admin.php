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

    public function indexAction()
    {
        $this->setTitle('Admin');
        $adminGrid = Ccc::getBlock('Admin_Index');
        $content = $this->getLayout()->getContent();
        $content->addChild($adminGrid,'Grid');
        $this->renderContent();
    }

    public function grid1Action()
    {
        $this->renderJson(['status' => 'Success']);
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
        $adminAdd = Ccc::getBlock('Admin_Edit');
        Ccc::register('admin',$adminModel);
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
            $message = $this->getMessage()->addMessage('Your Data save Successfully');
            echo $message->getMessages()['success'];
        }
        catch (Exception $e)
        {
            $message = $this->getMessage()->addMessage($e->getMessage(),3);
            echo $message->getMessages()['error'];
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
            Ccc::register('admin',$admin);
            $content = $this->getLayout()->getContent();
            $adminEdit = Ccc::getBlock('Admin_Edit');
            $content->addChild($adminEdit,'Edit');
            $this->renderLayout();
        }
        catch (Exception $e)
        {
            $message = $this->getMessage()->addMessage($e->getMessage(),3);
            echo $message->getMessages()['error'];
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
            $message = $this->getMessage()->addMessage('Data Deleted.');
            echo $message->getMessages()['success'];
        } 
        catch (Exception $e)
        {
            $message = $this->getMessage()->addMessage($e->getMessage(),3);
            echo $message->getMessages()['error'];
        }
    }
}
