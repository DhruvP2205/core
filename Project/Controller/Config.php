<?php Ccc::loadClass('Controller_Admin_Action');

class Controller_Config extends Controller_Admin_Action
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
        $this->setTitle('Config');
        $content = $this->getLayout()->getContent();
        $configGrid = Ccc::getBlock('Config_Grid');
        $content->addChild($configGrid,'Grid');
        $this->renderLayout();
    }

    public function addAction()
    {
        $this->setTitle('Add Config');
        $configModel = Ccc::getModel('Config');
        $content = $this->getLayout()->getContent();
        $configAdd = Ccc::getBlock('Config_Edit')->setData(['config'=>$configModel]);
        $content->addChild($configAdd,'Add');
        $this->renderLayout();
    }

    public function saveAction()
    {
        try
        {
            $request = $this->getRequest();
            $configModel = Ccc::getModel('Config');
            if(!$request->isPost())
            {
                throw new Exception("Request Invalid.");
            }
            $postData = $request->getPost('config');
            if(!$postData)
            {
                throw new Exception("Invalid data Posted.");
            }
            $config = $configModel;
            $config->setData($postData);

            if(!($config->configId))
            {
                unset($config->configId);
                $config->createdDate = date('y-m-d h:m:s');  
            }
            else
            {
                if(!(int)$config->configId)
                {
                    throw new Exception("Invalid Request.");
                }
            }
            $result = $config->save();
            if(!$result)
            {
                throw new Exception("Unable to Save Record.");
            }
            $this->getMessage()->addMessage('Your Data saveed Successfully.');
            $this->redirect('grid','config',[],true);
        } 
        catch (Exception $e) 
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->redirect('grid','config',[],true);
        }
    }

    public function editAction()
    {
        try 
        {
            $this->setTitle('Edit Config');
            $configModel = Ccc::getModel('Config');
            $request = $this->getRequest();
            $id = (int)$request->getRequest('id');
            if(!$id)
            {
                throw new Exception("Request Invalid.");
            }
            $config = $configModel->load($id);
            if(!$config)
            {
                throw new Exception("System is unable to find record."); 
            }
            $content = $this->getLayout()->getContent();
            $configEdit = Ccc::getBlock('Config_Edit')->setData(['config'=>$config]);
            $content->addChild($configEdit,'Edit');
            $this->renderLayout();
        }    
        catch (Exception $e) 
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->redirect('grid','config',[],true);
        }
    }


    public function deleteAction()
    {
        try
        {
            $configModel = Ccc::getModel('Config');
            $request = $this->getRequest();
            if(!$request->getRequest('id'))
            {
                throw new Exception("Request Invalid.");
            }
            
            $id = $request->getRequest('id');
            $result = $configModel->load($id);
            if(!$result)
            {
                throw new Exception("Unable to Delete Record.");
            }
            $result->delete();
            $this->getMessage()->addMessage('Data Deleted.');
            $this->redirect('grid','config',[],true);
        }
        catch(Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->redirect('grid','config',[],true);
        }
    }
}
