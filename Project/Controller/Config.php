<?php Ccc::loadClass('Controller_Core_Action');?>
<?php 

class Controller_Config extends Controller_Core_Action
{
    public function gridAction()
    {
        $content = $this->getLayout()->getContent();
        $configGrid = Ccc::getBlock('Config_Grid');
        $content->addChild($configGrid,'Grid');
        $this->renderLayout();
    }

    public function addAction()
    {
        $configModel = Ccc::getModel('Config');
        $content = $this->getLayout()->getContent();
        $configAdd = Ccc::getBlock('Config_Edit')->setData(['config'=>$configModel]);
        $content->addChild($configAdd,'Add');
        $this->renderLayout();
    }

    public function editAction()
    {
        try 
        {
            $configModel = Ccc::getModel('Config');
            $request = $this->getRequest();
            $id = (int)$request->getRequest('id');
            if(!$id)
            {
                $this->getMessage()->addMessage('Request Invalid.',3);
            }
            $config = $configModel->load($id);
            if(!$config)
            {
                $this->getMessage()->addMessage('System is unable to find record.',3); 
            }
            $content = $this->getLayout()->getContent();
            $configEdit = Ccc::getBlock('Config_Edit')->setData(['config'=>$config]);
            $content->addChild($configEdit,'Edit');
            $this->renderLayout();
        }    
        catch (Exception $e) 
        {
            $this->redirect($this->getView()->getUrl('grid','config',[],true));
        }
    }


    public function deleteAction()
    {
        try
        {
            $configModel = Ccc::getModel('Config');
            $request=$this->getRequest();
            if(!$request->getRequest('id'))
            {
                $this->getMessage()->addMessage('Request Invalid.',3);
            }
            $id=$request->getRequest('id');
            $result=$configModel->load($id)->delete();
            if(!$result)
            {
                $this->getMessage()->addMessage('Unable to Delete Record.',3);
            }
            $this->getMessage()->addMessage('Data Deleted.');
            $this->redirect($this->getView()->getUrl('grid','config',[],true));
        }
        catch(Exception $e)
        {
            $this->redirect($this->getView()->getUrl('grid','config',[],true));
        }
    }


    public function saveAction()
    {
        try
        {
            $request=$this->getRequest();
            $configModel= Ccc::getModel('Config');
            if(!$request->isPost())
            {
                $this->getMessage()->addMessage('Request Invalid.',3);
            }
            $postData=$request->getPost('config');
            if(!$postData)
            {
                $this->getMessage()->addMessage('Invalid data Posted.',3);
            }
            $config=$configModel;
            $config->setData($postData);

            if(!($config->configId))
            {
                unset($config->configId);
                $config->createdDate = date('y-m-d h:m:s');
                $result=$config->save();
                if(!$result)
                {
                    $this->getMessage()->addMessage('Unable to Save Record.',3);
                }
                $this->getMessage()->addMessage('Your Data save Successfully');  
            }
            else
            {
                if(!(int)$config->configId)
                {
                    $this->getMessage()->addMessage('Invalid Request.',3);
                }
                $result=$config->save();
                if(!$result)
                {
                    $this->getMessage()->addMessage('Unable to Update Record.',3);
                }
                $this->getMessage()->addMessage('Your Data Update Successfully');
            }
            $this->redirect($this->getView()->getUrl('grid','config',[],true));
        } 
        catch (Exception $e) 
        {

            $this->redirect($this->getView()->getUrl('grid','config',[],true));
        }
    }

}


?>
