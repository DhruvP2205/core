<?php Ccc::loadClass('Model_Core_Row');

class Model_Vendor_Address extends Model_Core_Row
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;
    const STATUS_DISABLED_DEFAULT = 1;
    const STATUS_ENABLED_LBL = 'Active';
    const STATUS_DISABLED_LBL = 'Inactive';

    public function __construct()
    {
        $this->setResourceClassName('Vendor_Address_Resource');
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

    public function setVendor(Mode_Vendor $vendor)
    {
        $this->vendor = $vendor;
        return $this;
    }

    public function getVendor($reload = false)
    {
        $vendorModal = Ccc::getModel('Vendor');
        if(!$this->vendorId)
        {
            return null;
        }
        if($this->vendor && !$reload)
        {
            return $this->vendor;
        }

        $vendor = $vendorModal->fetchRow("SELECT * FROM `vendor` WHERE `vendorId` = {$this->vendorId}");
        if(!$vendor){
            return $vendorModal;
        }
        $this->setVendor($vendor);
        return $this->vendor;
    }
}
