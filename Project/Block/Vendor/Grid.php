<?php
Ccc::loadClass('Block_Core_Template'); 

class Block_Vendor_Grid extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate('view/vendor/grid.php');
    }

    public function getVendors()
    {
        $vendorModel = Ccc::getModel('Vendor');
        $vendors = $vendorModel->fetchAll("SELECT * FROM vendor");
        return $vendors;

    }

    public function getAddresses()
    {
        $addressModel = Ccc::getModel('Vendor_Address');
        $addresses = $addressModel->fetchAll("SELECT * FROM vendor_address");
        return $addresses;
    }

    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;
    const STATUS_DEFAULT = 1;
    const STATUS_ENABLED_LBL = 'Active';
    const STATUS_DISABLED_LBL = 'Inactive';
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
        return $statuses[self::STATUS_DEFAULT];
    }
}
?>
