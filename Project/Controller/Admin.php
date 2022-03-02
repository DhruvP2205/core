<?php
Ccc::loadClass('Controller_Core_Action');

class Controller_Admin extends Controller_Core_Action
{
    public function gridAction()
    {
        $content = $this->getLayout()->getContent();
        $adminGrid = Ccc::getBlock('Admin_Grid');
        $content->addChild($adminGrid,'Grid');
        $this->renderLayout();
    }

    public function addAction()
    {
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
            $request=$this->getRequest();
            $adminModel= Ccc::getModel('Admin');

            if(!$request->isPost())
            {
                throw new Exception("Request Invalid.",1);
            }

            $postData=$request->getPost('admin');

            if(!$postData)
            {
                throw new Exception("Invalid data Posted.", 1);
            }

            $admin = $adminModel;
            $admin->setData($postData);

            if(!($admin->adminId))
            {
                unset($admin->adminId);
                $admin->createdDate = date('y-m-d h:m:s');
                $result=$admin->save();
                if(!$result)
                {
                    throw new Exception("unable to Save Record.", 1);        
                }   
            }
            else
            {
                if(!(int)$admin->adminId)
                {
                    throw new Exception("Invelid Request.",1);
                }
                $admin->updatedDate = date('y-m-d h:m:s');
                $result=$admin->save();
                if(!$result)
                {
                    throw new Exception("unable to uodate Record.", 1);
                }
            }
            $this->redirect($this->getView()->getUrl('grid','admin',[],true));
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            exit();
            $this->redirect($this->getView()->getUrl('grid','admin',[],true));
        }
    }

    public function editAction()
    {
        try
        {
            $adminModel = Ccc::getModel('Admin');
            $request = $this->getRequest();
            $id = (int)$request->getRequest('id');

            if(!$id)
            {
                throw new Exception("Invalid Request", 1);
            }
            
            $admin = $adminModel->load($id);
            
            if(!$admin)
            {   
                throw new Exception("System is unable to find record.", 1); 
            }

            $content = $this->getLayout()->getContent();
            $adminEdit = Ccc::getBlock('Admin_Edit')->setData(['admin'=>$admin]);
            $content->addChild($adminEdit,'Edit');
            $this->renderLayout();
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            exit();
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
                throw new Exception("Invalid Request.", 1);
            }

            $adminId = $request->getRequest('id');

            if(!$adminId)
            {
                throw new Exception("Unable to fetch ID.", 1);
            }
            $result = $adminModel->load($adminId)->delete();
            if(!$result)
            {
                throw new Exception("Unable to Delet Record.", 1);
            }

            $this->redirect($this->getView()->getUrl('grid','admin',[],true));
        } 
        catch (Exception $e)
        {
            $this->redirect($this->getView()->getUrl('grid','admin',[],true));
        }
    }
}

?>
