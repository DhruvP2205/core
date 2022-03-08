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
                $this->getMessage()->addMessage('Request Invalid.',3);
            }

            $postData=$request->getPost('admin');

            if(!$postData)
            {
                $this->getMessage()->addMessage('Invalid data Posted.',3);
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
                    $this->getMessage()->addMessage('Unable to Save Record.',3);
                }
                $this->getMessage()->addMessage('Your Data save Successfully');
            }
            else
            {
                if(!(int)$admin->adminId)
                {
                    $this->getMessage()->addMessage('Invalid Request.',3);
                }
                $admin->updatedDate = date('y-m-d h:m:s');
                $result=$admin->save();
                if(!$result)
                {
                    $this->getMessage()->addMessage('Unable to Update Record.',3);
                }
                $this->getMessage()->addMessage('Your Data Update Successfully');
            }
            $this->redirect($this->getView()->getUrl('grid','admin',[],true));
        }
        catch (Exception $e)
        {
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
                $this->getMessage()->addMessage('Request Invalid.',3);
            }
            
            $admin = $adminModel->load($id);
            
            if(!$admin)
            {   
                $this->getMessage()->addMessage('System is unable to find record.',3); 
            }

            $content = $this->getLayout()->getContent();
            $adminEdit = Ccc::getBlock('Admin_Edit')->setData(['admin'=>$admin]);
            $content->addChild($adminEdit,'Edit');
            $this->renderLayout();
        }
        catch (Exception $e)
        {
            $this->redirect($this->getView()->getUrl('grid','admin',[],true));
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
                $this->getMessage()->addMessage('Request Invalid.',3);
            }

            $adminId = $request->getRequest('id');

            if(!$adminId)
            {
                $this->getMessage()->addMessage('Unable to fetch ID.',3);
            }
            $result = $adminModel->load($adminId)->delete();
            if(!$result)
            {
                $this->getMessage()->addMessage('Unable to Delete Record.',3);
            }
            $this->getMessage()->addMessage('Data Deleted.');
            $this->redirect($this->getView()->getUrl('grid','admin',[],true));
        } 
        catch (Exception $e)
        {
            $this->redirect($this->getView()->getUrl('grid','admin',[],true));
        }
    }
}

?>
