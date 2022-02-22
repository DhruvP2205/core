<?php
Ccc::loadClass('Model_Core_Table_Row');

class Model_Customer_Address_Row extends Model_Core_Table_Row
{
    public function __construct()
    {
        $this->setTableClassName('Customer_Address');
    }
}
