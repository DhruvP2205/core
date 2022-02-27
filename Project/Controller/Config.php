        <?php Ccc::loadClass('Controller_Core_Action');?>
<?php 

class Controller_Config extends Controller_Core_Action{


    public function gridAction()
    {
        Ccc::getBlock('Config_Grid')->toHtml();
    }
    public function addAction()
    {
        $configModel = Ccc::getModel('Config');
        Ccc::getBlock('Config_Edit')->setData(['config'=>$configModel])->toHtml();
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
                throw new Exception("Invalid Request", 1);
            }
            $config = $configModel->load($id);
            if(!$config)
            {
                throw new Exception("System is unable to find record.", 1);
                
            }
            Ccc::getBlock('Config_Edit')->setData(['config'=>$config])->toHtml();
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
            $configModel = Ccc::getModel('Config');
            $request=$this->getRequest();
            if(!$request->getRequest('id'))
            {
                throw new Exception("Invelid Request", 1);
            }
            $id=$request->getRequest('id');
            $config_id=$configModel->load($id)->delete();
            $this->redirect($this->getView()->getUrl('grid','config',[],true));
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
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
                throw new Exception("Request Invalid.",1);
            }
            $postData=$request->getPost('config');
            if(!$postData)
            {
                throw new Exception("Invalid data Posted.", 1);
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
                    throw new Exception("unable to Updated Record.", 1);
                    
                }   
            }
            else
            {
                if(!(int)$config->configId)
                {
                    throw new Exception("Invelid Request.",1);
                }
                $result=$config->save();
                if(!$result)
                {
                    throw new Exception("unable to insert Record.", 1);
                }
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
