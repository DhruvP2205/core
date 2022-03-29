<?php Ccc::loadClass('Block_Core_Template');

class Block_Config_Edit_Tabs_Config extends Block_Core_Template   
{ 
    public function __construct()
    {
        $this->setTemplate('view/config/edit/tabs/config.php');
    }

    public function getConfig()
    {
        return Ccc::getRegistry('config');
    }
}
