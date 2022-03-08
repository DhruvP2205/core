<?php  Ccc::loadClass('Block_Core_Template');
class Block_Core_Layout_Header_Menu extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate('view/core/layout/header/menu.php');
    }
}
