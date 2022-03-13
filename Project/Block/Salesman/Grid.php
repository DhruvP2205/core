<?php Ccc::loadClass('Block_Core_Template');

class Block_Salesman_Grid extends Block_Core_Template   
{ 
    public function __construct()
    {
        $this->setTemplate('view/salesman/grid.php');
    }

    public function getSalesmans()
    {
        $request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr',20);

        $pagerModel = Ccc::getModel('Core_Pager');
        $salesmanModel = Ccc::getModel('Salesman');

        $totalCount = $pagerModel->getAdapter()->fetchOne("SELECT count(salesmanId) FROM `salesman`");

        $pagerModel->execute($totalCount, $page, $ppr);
        $this->setPager($pagerModel);

        $salesmans = $salesmanModel->fetchAll("SELECT * FROM `salesman` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}");
        return $salesmans;
    }
}
