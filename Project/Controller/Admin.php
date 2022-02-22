<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');

class Controller_Admin extends Controller_Core_Action
{
    public function gridAction()
    {
        /*$adminModel = Ccc::getModel('Admin');
        echo "<pre>";
        print_r($adminModel);
        $admin = $adminModel->getRow();
        $admin->firstName = "Dhruv";
        $admin->lastName = "Prajapati";
        print_r($admin);*/
        Ccc::getBlock('Admin_Grid')->toHtml();
    }

    public function addAction()
    {
        Ccc::getBlock('Admin_Add')->toHtml();
    }

    public function saveAction()
    {
        try
        {
            $request = $this->getRequest();

            if(!$request->isPost())
            {
                throw new Exception("Invalid request.",1);
            }

            $postData = $request->getPost('admin');

            if(!$postData)
            {
                throw new Exception("Invalid data posted.", 1);
                
            }
            $adminModel = Ccc::getModel('Admin');
            $admin = $adminModel->getRow();
            $admin->firstName = $postData['firstName'];
            $admin->lastName = $postData['lastName'];
            $admin->email = $postData['email'];
            $admin->password = $postData['password'];
            $admin->status = $postData['status'];
            $adminTable = Ccc::getModel('Admin');

            if(array_key_exists('adminID',$postData))
            {
                $adminID = $postData['adminID'];
                if(!(int)$adminID)
                {
                    throw new Exception("Invalid Request.", 1);
                }
                $admin->adminID = $postData["adminID"];
                $admin->updatedDate = date('y-m-d h:m:s');
                $update = $admin->save($admin->adminID, $admin);
            }
            else
            {

                $admin->createdDate = date('y-m-d h:m:s');
                $adminInsertedID = $admin->save();
                if($adminInsertedID == null)
                {
                    throw new Exception("System is unable to Insert.", 1);
                }
            }
            $this->redirect($this->getView()->getUrl('admin','grid'));
        } 
        
        catch (Exception $e) 
        {
            echo $e->getMessage();
            exit();
            $this->redirect($this->getView()->getUrl('admin','grid'));
        }
    }

    public function editAction()
    {
        try
        {
            $adminModel = Ccc::getModel('Admin');
            $request = $this->getRequest();
            $adminID = $request->getRequest('id');

            if(!$adminID)
            {
                throw new Exception("Id is not valid.");
            }

            if(!(int)$adminID)
            {
                throw new Exception("Invalid Request.", 1);
            }

            $admin = $adminModel->fetchRow("SELECT * FROM admin WHERE adminID = {$adminID}");

            if(!$admin)
            {
                throw new Exception("System is unable to find record.", 1); 
            }

            Ccc::getBlock('Admin_Edit')->addData('admin',$admin)->toHtml();
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            exit();
            $this->redirect($this->getView()->getUrl('admin','grid'));
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
            
            if(!(int)$adminId)
            {
                throw new Exception("Invalid Request.", 1);
            }
            
            $adminTable->delete($adminId);
            $this->redirect($this->getView()->getUrl('admin','grid',[],true));
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            exit();
            $this->redirect('index.php?c=admin&a=grid');
        }
    }
}

?>
