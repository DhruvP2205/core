<?php Ccc::loadClass('Block_Core_Template');

class Block_Customer_Edit extends Block_Core_Template   
{ 
    public function __construct()
    {
        $this->setTemplate('view/customer/edit.php');
    }
    
    public function getCustomer()
    {
        $customer = $this->customer;
        return $customer;
    }

    public function getAddress()
    {
        $address = $this->address;
        if($address == null)
        {
            return Ccc::getModel('Customer_Address');
        }
        return $address;
    }
}
