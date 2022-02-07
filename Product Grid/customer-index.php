<?php require_once('Adapter.php'); ?>
<?php

class Customer{

    public function gridAction()
    {
        require_once('customer-grid.php');
    }

    public function saveAction()
    {
        try {
            if($_SERVER['REQUEST_METHOD']=='POST')
            {
                $adapter = new Adapter();
                
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

                if($_POST["submit"] == "Save")
                {
                    $customer = $adapter->insert("insert into customer(`firstName`, `lastName`, `email`, `mobile`, `status`, `createdDate`) values ('{$customerFname}','{$customerLname}','{$customerEmail}','{$customerMobile}','{$customerStatus}','{$createdDate}')");
                    if(!$customer)
                    {
                        throw new Exception("System is unable to save record.",1);
                    }

                    $addressInsert = $adapter->insert("INSERT INTO `address`(`customerID`, `address`, `zipcode`, `city`, `state`, `country`, `billingAddress`, `shipingAddress`, `createdDate`) VALUES ('{$customer}','{$address}','{$addressZipcode}','{$addressCity}','{$addressState}','{$addressCountry}','{$billingAddress}','{$shipingAddress}','{$createdDate}')");
                    if(!$addressInsert)
                    {
                        throw new Exception("System is unable to save record.",1);
                    }

                    $this->redirect('customer-index.php?a=gridAction');
                }


                if($_POST["submit"]=="update")
                {
                    if(!isset($_GET['id'])){
                        throw new Exception("Invalid Request.", 1);
                    }
                    if(!(int)$_GET['id']){
                        throw new Exception("Invalid Request.", 1);
                    }
                    $customerID = $_GET['id'];
                    $customer = $adapter->update("update customer set firstName ='$customerFname', lastName = '$customerLname', email='$customerEmail', mobile='$customerMobile',status ='$customerStatus', updatedDate='$updatedDate' where customerID = $customerID");
                    if(!$customer)
                    {
                        throw new Exception("System is unable to update record.",1);
                    }

                    $customerAddress = $adapter->update("update address set address ='$address', zipcode='$addressZipcode', city='$addressCity', state='$addressState',country='$addressCountry',billingAddress='$billingAddress',shipingAddress='$shipingAddress', updatedDate='$updatedDate' where customerID = $customerID");
                    if(!$customerAddress)
                    {
                        throw new Exception("System is unable to update record.",1);
                    }
                    $this->redirect('customer-index.php?a=gridAction');
                }
            }
        } catch (Exception $e) {
            /*echo $e->getMessage();*/
            $this->redirect('customer-index.php?a=gridAction');
        }
        
    }

    public function editAction()
    {
        require_once('customer-edit.php');
    }

    public function addAction()
    {
        require_once('customer-add.php');
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
                $adapter =new Adapter();
                $result=$adapter->delete("DELETE FROM customer WHERE customerID = '$customerID'");
                if(!$result)
                {
                    throw new Exception("System is unable to delete record.",1);
                }
                $this->redirect('customer-index.php?a=gridAction');
            }
        } catch (Exception $e) {
            /*echo $e->getMessage();*/
            $this->redirect('customer-index.php?a=gridAction');
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

$action = ($_GET['a']) ? $_GET['a'] : 'errorAction';
$customer = new Customer();
$customer->$action();

?>
