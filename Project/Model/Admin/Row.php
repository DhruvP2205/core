<?php
Ccc::loadClass('Model_Core_Table_Row');

class Model_Admin_Row extends Model_Core_Table_Row
{
    public function __construct()
    {
        $this->setTableClassName('Admin');
    }

    public function fetchAll($query)
    {
        $admins = $this->getTable()->fetchAll("select * from admin");
        if(!$admins)
        {
            return $admins;
        }
        $adminObj = [];
        foreach($admins as &$admin)
        {
            $admin = (new $this())->setData($admin);
        }
        return $admins;
    }
}
