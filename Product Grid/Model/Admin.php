<?php
Ccc::loadClass('Model_Core_Table');

class Model_Admin extends Model_Core_Table
{
    /*protected $tableName = 'admin';
    protected $primaryKey = 'adminID';*/

    public function __construct()
    {
        $this->setTableName('admin')->setPrimaryKey('adminID');
    }
}
?>
