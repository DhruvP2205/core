<?php
Ccc::loadClass('Controller_Core_Action');

class Controller_Customer extends Controller_Core_Action
{
    public function gridAction()
    {
        Ccc::getBlock('Customer_Grid')->toHtml();
    }

    protected function saveCustomer()
    {
        $customerModel = Ccc::getModel('Customer');
        $request = $this->getRequest();

        if(!$request->getPost('customer'))
        {
            throw new Exception("Invalid Request", 1);
        }   
        $postData = $request->getPost('customer');

        if(!$postData)
        {
            throw new Exception("Invalid data posted.", 1); 
        }

        if (array_key_exists('customerID',$postData))
        {
            if(!(int)$postData['customerID'])
            {
                throw new Exception("Invalid Request.", 1);
            }
            $customerID = $postData["customerID"];
            $postData['updatedDate']  = date('y-m-d h:m:s');
            $update = $customerModel->update($postData,$customerID);
            return $postData["customerID"];
        }
        else
        {
            $postData['createdDate'] = date('y-m-d h:m:s');
            $insert = $customerModel->insert($postData);
            print_r($insert);
            return $insert;
        }
    }

    protected function saveAddress($customerID)
    {
        $addressModel = Ccc::getModel('Customer_Address');
        $request = $this->getRequest();
    
        if(!$request->getPost('address'))
        {
            throw new Exception("Invalid Request", 1);
        }   
        $postData = $request->getPost('address');

        if(!$postData)
        {
            throw new Exception("Invalid data posted.", 1); 
        }

        if (array_key_exists('customerID',$postData))
        {
            $postData['updatedDate']  = date('y-m-d y:m:s');
            print_r($postData);
            $update = $addressModel->update($postData, $postData['customerID']);
        }
        else
        {
            $postData['customerID'] = $customerID;
            $postData['createdDate']  = date('y-m-d y:m:s');
            $insert = $addressModel->insert($postData);
            print_r($insert);
            return $insert;
        }
    }

    public function saveAction()
    {
        try
        {
            $customerID = $this->saveCustomer();
            $request = $this->getRequest();

            if(!$request->getPost('address'))
            {
                $this->redirect($this->getView()->getUrl('customer','grid',[],true));
            }
            $this->saveAddress($customerID);

            $this->redirect($this->getView()->getUrl('customer','grid',[],true));
        } 
        
        catch (Exception $e) 
        {
            echo $e->getMessage();
            exit();
            $this->redirect($this->getView()->getUrl('customer','grid',[],true));
        }
    }

    public function editAction()
    {
        try
        {
            $customerModel = Ccc::getModel('Customer');
            $request = $this->getRequest();
            $customerID = (int)$request->getRequest('id');
            if(!$customerID)
            {
                throw new Exception("Invalid Request", 1);
            }
            $customer = $customerModel->fetchRow("SELECT * FROM customer WHERE customerID = {$customerID}");
            if(!$customer)
            {
                throw new Exception("System is unable to find customer record.", 1);
                
            }
            $addressModel = Ccc::getModel('Customer_Address');
            $address = [];
            $address = $addressModel->fetchRow("SELECT * FROM address WHERE customerID = {$customerID}");
            if(!$address)
            {
                $address = ['address'=>null,'zipcode'=>null,'city'=>null,'state'=>null,'country'=>null,'billingAddress'=>0,'shipingAddress'=>0];
            }
            Ccc::getBlock('Customer_Edit')->addData('customer',$customer)->addData('address',$address)->toHtml();
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            exit();
            $this->redirect($this->getView()->getUrl('customer','grid',[],true));
        }
        
    }

    public function addAction()
    {
        Ccc::getBlock('Customer_Add')->toHtml();
    }

    public function deleteAction()
    {
        try 
        {
            if($_SERVER['REQUEST_METHOD']=='GET')
            {
                if(!isset($_GET['id'])){
                    throw new Exception("Invalid Request.", 1);
                }
                if(!(int)$_GET['id']){
                    throw new Exception("Invalid Request.", 1);
                }
                $customerID = $_GET['id'];
                $adapter = new Model_Core_Adapter();
                $result=$adapter->delete("DELETE FROM customer WHERE customerID = '$customerID'");
                if(!$result)
                {
                    throw new Exception("System is unable to delete record.",1);
                }
                $this->redirect('index.php?c=customer&a=grid');
            }
        } catch (Exception $e) {
            /*echo $e->getMessage();*/
            $this->redirect('index.php?c=customer&a=grid');
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
