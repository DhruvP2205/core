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

        $customer = $customerModel->getRow();
        $customer->firstName = $postData['firstName'];
        $customer->lastName = $postData['lastName'];
        $customer->email = $postData['email'];
        $customer->mobile = $postData['mobile'];
        $customer->status = $postData['status'];

        if (array_key_exists('customerID',$postData))
        {
            if(!(int)$postData['customerID'])
            {
                throw new Exception("Invalid Request.", 1);
            }
            $customer->customerID = $postData["customerID"];
            $customer->updatedDate = date('y-m-d h:m:s');

            $update = $customer->save($customer->customerID,$customer);
        }
        else
        {
            $customer->createdDate = date('y-m-d h:m:s');
            $insert = $customer->save();
            if($insert == null)
            {
                throw new Exception("System is unable to Insert.", 1);
            }
            return $insert;
        }
    }

    protected function saveAddress($customerID)
    {
        print_r($customerID);
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

        $address = $addressModel->getRow();

        $address->address = $postData['address'];
        $address->zipcode = $postData['zipcode'];
        $address->city = $postData['city'];
        $address->state = $postData['state'];
        $address->country = $postData['country'];
        if(!array_key_exists('billingAddress',$postData)){
            $address->billingAddress = 0;
        }
        else
        {
            $address->billingAddress = $postData['billingAddress'];
        }
        if(!array_key_exists('shipingAddress',$postData)){
            $address->shipingAddress = 0;  
        }
        else{
            $address->shipingAddress = $postData['shipingAddress'];
        }
        
        if (array_key_exists('customerID',$postData))
        {
            $address->customerID = $postData['customerID'];
            $address->addressID = $postData['addressID'];
            $address->updatedDate  = date('y-m-d y:m:s');
            $update = $address->save();
        }
        else
        {
            $address->customerID = $customerID;
            $address->createdDate  = date('y-m-d y:m:s');
            $insert = $address->save();

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
            $address = $addressModel->fetchRow("SELECT * FROM address WHERE customerID = {$customerID}");

            if(!$address)
            {
                $address = ['address'=>null,'zipcode'=>null,'city'=>null,'state'=>null,'country'=>null,'billingAddress'=>0,'shipingAddress'=>0, 'customerID' => $customer['customerID']];
                /*throw new Exception("System is unable to find record.", 1);*/
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
}

?>
