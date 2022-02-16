<?php

Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
Ccc::loadClass('Model_Admin');

$c = new Ccc();


class Controller_Admin extends Controller_Core_Action{

    public function gridAction()
    {
        $adminTable = new Model_Admin();
        $admins = $adminTable->fetchAll();
        
        $view = $this->getView();
        $view->setTemplate('view/admin/grid.php');
        $view->addData('admins',$admins);

        $view->toHtml();
    }

    protected function saveAdmin(){
        try
        {
            global $c;
            $post = $c->getFront()->getRequest();
            $post->getPost();
            if(!$post->ispost('admin'))
            {
                throw new Exception("Request Invelid.",1);
            }
            
            $adapter = new Model_Core_Adapter();

            $row = $post->getPost('admin');
                
            $adminFname = $row['firstName'];
            $adminLname = $row['lastName'];
            $adminEmail = $row['email'];
            $adminPassword = $row['password'];
            $adminStatus = $row['status'];

            $createdDate = date('y-m-d h:m:s');
            $updatedDate = date('y-m-d h:m:s');

            if(array_key_exists('adminID',$row))
            {
                $adminID = $row['adminID'];

                if(!(int)$adminID){
                    throw new Exception("Invalid Request.", 1);
                }

                $data = ['firstName'=>$adminFname,'lastName'=>$adminLname,'email'=>$adminEmail,'password'=>$adminPassword,'status'=>$adminStatus,'updatedDate'=>$updatedDate];

                $adminTable = new Model_Admin();
                $admin_id = $adminTable->update($data,$adminID);
            }
            else
            {

                $data = ['firstName'=>$adminFname,'lastName'=>$adminLname,'email'=>$adminEmail,'password'=>$adminPassword,'status'=>$adminStatus,'createdDate'=>$createdDate];

                $adminTable = new Model_Admin();
                $adminInsertedID = $adminTable->insert($data);

                return $adminInsertedID;
            }
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            exit();
            //$this->redirect('index.php?c=admin&a=grid');
        }
    }

    
    public function saveAction()
    {
        try
        {
            $customerID = $this->saveAdmin();
            $this->redirect('index.php?c=admin&a=grid');
        } 
        
        catch (Exception $e) 
        {
            $this->redirect('index.php?c=admin&a=grid');
        }
    }

    public function editAction()
    {
        try
        {
            global $c;
            $request = $c->getFront()->getRequest();
            $adminID = $request->getRequest('id');

            if(!(int)$adminID)
            {
                throw new Exception("Invalid Request.", 1);
            }

            $adminTable = new Model_Admin();
            $admins = $adminTable->fetchRow($adminID);

            $view = $this->getView();
            $view->addData('admins',$admins);
            $view->setTemplate('view/admin/edit.php');
            $view->toHtml();

        } catch (Exception $e) {
            echo $e->getMessage();
            exit();
            /*$this->redirect('index.php?c=admin&a=grid');*/
        }
    }

    public function addAction()
    {
        $view = $this->getView();
        $view->setTemplate('view/admin/add.php');
        $view->toHtml();
    }

    public function deleteAction()
    {
        try
        {
            global $c;
            $request = $c->getFront()->getRequest();

            if(!$request->getRequest('id'))
            {
                throw new Exception("Invelid Request", 1);
            }

            $adminID = $request->getRequest('id');
            
            if(!(int)$adminID)
            {
                throw new Exception("Invalid Request.", 1);
            }

            $adminTable = new Model_Admin();
            $adminTable->delete($adminID);
            $this->redirect('index.php?c=admin&a=grid');
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            exit();
            /*$this->redirect('index.php?c=admin&a=grid');*/
        }
    }

    public function redirect($url)
    {
        header("Location: $url");
        exit();
    }

    public function errorAction()
    {
        echo "404<br>Not Found.";
    }
}

?>
