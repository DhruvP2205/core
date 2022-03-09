<?php Ccc::loadClass('Block_Core_Template');

class Block_Salesman_Grid extends Block_Core_Template   
{ 
    public function __construct()
    {
        $this->setTemplate('view/salesman/grid.php');
    }

    public function getSalesmans()
    {
        $salesmanModel = Ccc::getModel('Salesman');
        $salesmans = $salesmanModel->fetchAll("SELECT * FROM `salesman`");
        return $salesmans;
    }
}
