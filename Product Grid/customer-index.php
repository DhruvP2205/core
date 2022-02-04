<?php require_once('Adapter.php'); ?>
<?php

class Customer{

    public function gridAction()
    {
        require_once('customer-grid.php');
    }

    public function saveAction()
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $adapter = new Adapter();
            
            $customerFname = $_POST['customer']['firstName'];
            $customerLname = $_POST['customer']['lastName'];
            $customerEmail = $_POST['customer']['email'];
            $customerMobile = $_POST['customer']['mobile'];
            $customerStatus = $_POST['customer']['status'];
            $createdDate = date('y-m-d h:m:s');
            $updatedDate = date('y-m-d h:m:s');

            if($_POST["submit"] == "Save")
            {
                $customer = $adapter->insert("insert into customer(`firstName`, `lastName`, `email`, `mobile`, `status`, `createdDate`) values ('{$customerFname}','{$customerLname}','{$customerEmail}','{$customerMobile}','{$customerStatus}','{$createdDate}')");
                if($customer)
                {
                    header('Location: customer-index.php?a=gridAction');
                }

            }


            if($_POST["submit"]=="update")
            {
                $customerID = $_GET['id'];
                $customer = $adapter->update("update customer set firstName ='$customerFname', lastName = '$customerLname', email='$customerEmail', mobile='$customerMobile',status ='$customerStatus', updatedDate='$updatedDate' where customerID = $customerID");
                if($customer)
                {
                    header('Location: customer-index.php?a=gridAction');
                }
            }
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
        if($_SERVER['REQUEST_METHOD']=='GET')
        {
            $customerID = $_GET['id'];
            $adapter =new Adapter();
            $result=$adapter->delete("DELETE FROM customer WHERE customerID = '$customerID'");
            if($result)
            {
                header('Location: customer-index.php?a=gridAction');
            }
        }
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
