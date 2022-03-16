<?php Ccc::loadClass('Model_Core_Row');

class Model_Customer extends Model_Core_Row
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;
    const STATUS_DISABLED_DEFAULT = 1;
    const STATUS_ENABLED_LBL = 'Active';
    const STATUS_DISABLED_LBL = 'Inactive';

    protected $billingAddress;
    protected $shippingAddress;
    
    public function __construct()
    {
        $this->setResourceClassName('Customer_Resource');
        parent::__construct();
    }

    public function getStatus($key = null)
    {
        $statuses = [
            self::STATUS_ENABLED => self::STATUS_ENABLED_LBL,
            self::STATUS_DISABLED => self::STATUS_DISABLED_LBL
        ];
        if(!$key)
        {
            return $statuses;
        }

        if(array_key_exists($key, $statuses)) {
            return $statuses[$key];
        }
        return self::STATUS_DISABLED_DEFAULT;
    }

    public function getBillingAddress($reload = false)
    {
        $addressModel = Ccc::getModel('Customer_Address');
        if(!$this->customerId)
        {
            return $addressModel;
        }
        if($this->billingAddress && !$reload)
        {
            return $this->billingAddress;
        }
        $address = $addressModel->fetchRow("SELECT * FROM `customer_address` WHERE `customerId` = {$this->customerId} AND `billingAddress` = 1");
        if(!$address)
        {
            return $addressModel;
        }
        $this->setBillingAddress($address);
        return $address;
    }

    public function setBillingAddress($address)
    {
        $this->billingAddress = $address;
        return $this;
    }

    
    public function getShippingAddress($reload = false)
    {
        $addressModel = Ccc::getModel('Customer_Address');
        if(!$this->customerId)
        {
            return $addressModel;
        }
        if($this->shippingAddress && !$reload)
        {
            return $this->shippingAddress;
        }
        $address = $addressModel->fetchRow("SELECT * FROM `customer_address` WHERE `customerId` = {$this->customerId} AND `shipingAddress` = 1");
        if(!$address)
        {
            return $addressModel;
        }
        $this->setShippingAddress($address);
        return $address;
    }

    public function setShippingAddress($address)
    {
        $this->shippingAddress = $address;
        return $this;
    }
}
