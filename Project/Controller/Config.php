<?php 
Ccc::loadClass('Controller_Core_Action');

class Controller_Config extends Controller_Core_Action
{
    public function gridAction()
    {
        Ccc::getBlock('Config_Grid')->toHtml();
    }
}
?>
