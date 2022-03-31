<?php Ccc::loadClass('Block_Core_Edit_Tabs_Content');
Ccc::loadClass('Block_Admin_Edit_Tab');

class Block_Admin_Edit_Tabs_Personal extends Block_Core_Edit_Tabs_Content
{ 
    public function __construct()
    {
        $this->setTemplate('view/admin/edit/tabs/personal.php');
    }

    public function getAdmin()
    {
        return Ccc::getRegistry('admin');
    }
}
