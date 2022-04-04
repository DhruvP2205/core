<?php Ccc::loadClass('Block_Core_Edit_Tabs_Content');
Ccc::loadClass('Block_Salesman_Edit_Tab');

class Block_Salesman_Edit_Tabs_Salesman extends Block_Core_Edit_Tabs_Content
{ 
    public function __construct()
    {
        $this->setTemplate('view/salesman/edit/tabs/salesman.php');
    }

    public function getSalesman()
    {
        return Ccc::getRegistry('salesman');
    }
}
