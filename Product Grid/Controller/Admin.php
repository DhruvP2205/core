<?php
class Controller_Admin{

    public function gridAction()
    {
        require_once('view/admin/grid.php');
    }

    protected function saveAdmin(){
        try {
            if(!isset($_POST['admin']))
            {
                throw new Exception("Request Invelid.",1);
            }
            
            $adapter = new Model_Core_Adapter();

            $row = $_POST['admin'];
                
            $adminFname = $_POST['admin']['firstName'];
            $adminLname = $_POST['admin']['lastName'];
            $adminEmail = $_POST['admin']['email'];
            $adminPassword = $_POST['admin']['password'];
            $adminStatus = $_POST['admin']['status'];

            $createdDate = date('y-m-d h:m:s');
            $updatedDate = date('y-m-d h:m:s');

            if(isset($_GET['id']))
            {
                if(!(int)$_GET['id']){
                    throw new Exception("Invalid Request.", 1);
                }
                $adminID = $_GET['id'];

                $admin = $adapter->update("update admin set firstName ='$adminFname', lastName = '$adminLname', email='$adminEmail', password='$adminPassword', status ='$adminStatus', updatedDate='$updatedDate' where adminID = $adminID");
                if(!$admin)
                {
                    throw new Exception("System is unable to update record.",1);
                }
            }
            else{
                $admin = $adapter->insert("insert into admin(`firstName`, `lastName`, `email`, `password`, `status`, `createdDate`) values ('{$adminFname}','{$adminLname}','{$adminEmail}','{$adminPassword}','{$adminStatus}','{$createdDate}')");
                if(!$admin)
                {
                    throw new Exception("System is unable to save record.",1);
                }

                return $admin;
            }
        } catch (Exception $e) {
            /*echo $e->getMessage();*/
            $this->redirect('index.php?c=admin&a=grid');
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
        require_once('view/admin/edit.php');
    }

    public function addAction()
    {
        require_once('view/admin/add.php');
    }

    public function deleteAction()
    {
        try {
            if($_SERVER['REQUEST_METHOD']=='GET')
            {
                if(!isset($_GET['id'])){
                    throw new Exception("Invalid Request.", 1);
                }
                if(!(int)$_GET['id']){
                    throw new Exception("Invalid Request.", 1);
                }
                $adminID = $_GET['id'];
                $adapter = new Model_Core_Adapter();
                $result = $adapter->delete("DELETE FROM admin WHERE adminID = '$adminID'");
                if(!$result)
                {
                    throw new Exception("System is unable to delete record.",1);
                }
                $this->redirect('index.php?c=admin&a=grid');
            }
        } catch (Exception $e) {
            /*echo $e->getMessage();*/
            $this->redirect('index.php?c=admin&a=grid');
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
