<?php
Ccc::loadClass('Model_Core_Table');
class Model_Admin_Resource extends Model_Core_Table
{
    public function __construct()
    {
        $this->setTableName('admin');
        $this->setPrimaryKey('adminID');
    }
}
?>
