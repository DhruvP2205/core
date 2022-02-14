<?php

Ccc::loadClass('Controller_Core_Action');


class Controller_Customer extends Controller_Core_Action{

    public function gridAction()
    {
        $adapter = new Model_Core_Adapter();
        $customers = $adapter->fetchAll("SELECT c.`customerID`, c.`firstName`, c.`lastName`, c.`email`, c.`mobile`, c.`status`, c.`createdDate`, c.`updatedDate`, a.`addressID`, a.`address`, a.`zipcode`, a.`city`, a.`state`, a.`country`, a.`billingAddress`,a.`shipingAddress`, a.`createdDate`, a.`updatedDate` FROM `customer` c LEFT JOIN `address` a ON c.customerID = a.customerID ORDER BY c.customerID ASC");
        
        $view = $this->getView();
        $view->setTemplate('view/customer/grid.php');
        $view->addData('customers',$customers);
        $view->toHtml();
    }

    protected function saveCustomer(){
        try {
            if(!isset($_POST['customer']))
            {
                throw new Exception("Request Invelid.",1);
            }
            
            $adapter = new Model_Core_Adapter();

            $row = $_POST['customer'];
                
            $customerFname = $_POST['customer']['firstName'];
            $customerLname = $_POST['customer']['lastName'];
            $customerEmail = $_POST['customer']['email'];
            $customerMobile = $_POST['customer']['mobile'];
            $customerStatus = $_POST['customer']['status'];

            $address = $_POST['address']['address'];
            $addressZipcode = $_POST['address']['zipcode'];
            $addressCity = $_POST['address']['city'];
            $addressState = $_POST['address']['state'];
            $addressCountry = $_POST['address']['country'];
            $billingAddress = $_POST['address']['billing'];
            $shipingAddress = $_POST['address']['shiping'];

            $createdDate = date('y-m-d h:m:s');
            $updatedDate = date('y-m-d h:m:s');

            if(isset($_GET['id']))
            {
                if(!(int)$_GET['id']){
                    throw new Exception("Invalid Request.", 1);
                }
                $customerID = $_GET['id'];

                $customer = $adapter->update("update customer set firstName ='$customerFname', lastName = '$customerLname', email='$customerEmail', mobile='$customerMobile',status ='$customerStatus', updatedDate='$updatedDate' where customerID = $customerID");
                if(!$customer)
                {
                    throw new Exception("System is unable to update record.",1);
                }
            }
            else{
                $customer = $adapter->insert("insert into customer(`firstName`, `lastName`, `email`, `mobile`, `status`, `createdDate`) values ('{$customerFname}','{$customerLname}','{$customerEmail}','{$customerMobile}','{$customerStatus}','{$createdDate}')");
                if(!$customer)
                {
                    throw new Exception("System is unable to save record.",1);
                }

                return $customer;
            }
        } catch (Exception $e) {
            /*echo $e->getMessage();*/
            $this->redirect('index.php?c=customer&a=grid');
        }
    }

    protected function saveAddress($customerID){
        try {
            if(!isset($_POST['address']))
            {
                throw new Exception("Missing Address data in Request", 1);
            }
            
            $adapter = new Model_Core_Adapter();

            $row = $_POST['customer'];
            $rowAddress = $_POST['address'];
                
            $address = $_POST['address']['address'];
            $addressZipcode = $_POST['address']['zipcode'];
            $addressCity = $_POST['address']['city'];
            $addressState = $_POST['address']['state'];
            $addressCountry = $_POST['address']['country'];

            $billingAddress = 0;
            if(array_key_exists('billing',$rowAddress) && $rowAddress['billing'] == 1){
                $billingAddress = 1;
            }

            $shipingAddress = 0;
            if(array_key_exists('shiping',$rowAddress) && $rowAddress['shiping'] == 1){
                $shipingAddress = 1;
            }

            $createdDate = date('y-m-d h:m:s');
            $updatedDate = date('y-m-d h:m:s');

            if(isset($_GET['id']))
            {
                if(!(int)$_GET['id']){
                    throw new Exception("Invalid Request.", 1);
                }
                $customerID = $_GET['id'];
                    
                $updateAddress = $adapter->update("UPDATE `address` SET `address` = '$address', `zipcode` = '$addressZipcode', `city` = '$addressCity', `state` = '$addressState', `country` = '$addressCountry', `billingAddress` = '$billingAddress', `shipingAddress` = '$shipingAddress', `updatedDate` = 'updatedDate' WHERE `customerID` = $customerID");
                
                if(!$updateAddress)
                {   
                    throw new Exception("System is unable to Update.",1);
                }
            }
            else
            {
                $addressInsert = $adapter->insert("INSERT INTO `address`(`customerID`, `address`, `zipcode`, `city`, `state`, `country`, `billingAddress`, `shipingAddress`, `createdDate`) VALUES ('{$customerID}','{$address}','{$addressZipcode}','{$addressCity}','{$addressState}','{$addressCountry}','{$billingAddress}','{$shipingAddress}','{$createdDate}')");
                if(!$addressInsert)
                {
                    throw new Exception("System is unable to save record.",1);
                }
            }
        } catch (Exception $e) {
            /*echo $e->getMessage();*/
            $this->redirect('index.php?c=customer&a=grid');
        }
    }

    public function saveAction()
    {
        try
        {
            $customerID = $this->saveCustomer();
            $this->saveAddress($customerID);

            $this->redirect('index.php?c=customer&a=grid');
        } 
        
        catch (Exception $e) 
        {
            $this->redirect('index.php?c=customer&a=grid');
        }
    }

    public function editAction()
    {
        try
        {
            if(!isset($_GET['id']))
            {
                throw new Exception("Invalid Request.", 1);
            }
            if(!(int)$_GET['id'])
            {
                throw new Exception("Invalid Request.", 1);
            }

            $customerID = $_GET['id'];

            $adapter = new Model_Core_Adapter();
            $customer = $adapter->fetchRow("SELECT c.`customerID`, c.`firstName`, c.`lastName`, c.`email`, c.`mobile`, c.`status`, a.`addressID`, a.`address`, a.`zipcode`, a.`city`, a.`state`, a.`country`, a.`billingAddress`,a.`shipingAddress` FROM `customer` c LEFT JOIN `address` a ON c.customerID = a.customerID WHERE c.customerID = '$customerID' ORDER BY c.customerID ASC");

            $view = $this->getView();
            $view->addData('customer',$customer);
            $view->setTemplate('view/customer/edit.php');
            $view->toHtml();
        }
        catch (Exception $e)
        {
            /*echo $e->getMessage();*/
            $this->redirect('index.php?a=grid');
        }
        require_once('view/customer/edit.php');
    }

    public function addAction()
    {
        $view = $this->getView();
        $view->setTemplate('view/customer/add.php');
        $view->toHtml();
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
