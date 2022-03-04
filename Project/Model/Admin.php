<?php
Ccc::loadClass('Model_Core_Row');

class Model_Admin extends Model_Core_Row
{
    public function __construct()
    {
        $this->setResourceClassName('Admin_Resource');
        parent::__construct();
    }
}
?>
