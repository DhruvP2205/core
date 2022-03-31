<?php Ccc::loadClass('Block_Core_Template');

class Block_Customer_Index extends Block_Core_Template   
{
    public function __construct()
    {
        $this->setTemplate('view/customer/index.php');
    }
}
