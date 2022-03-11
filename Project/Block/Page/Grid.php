<?php Ccc::loadClass('Block_Core_Template');

class Block_Page_Grid extends Block_Core_Template   
{
    protected $pager;

    public function getPager()
    {
        return $this->pager;
    }

    public function setPager($pager)
    {
        $this->pager = $pager;
    }

    public function __construct()
    {
        $this->setTemplate('view/page/grid.php');
    }

    public function getPages()
    {
        $request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);

        $pagerModel = Ccc::getModel('Core_Pager');
        $totalCount = $pagerModel->getAdapter()->fetchOne("SELECT count(pageId) FROM `page`");
        
        $pagerModel->execute($totalCount, $page);
        $this->setPager($pagerModel);
        
        $pageModel = Ccc::getModel('Page');
        
        $pages = $pageModel->fetchAll("SELECT * FROM `page` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}");
        return $pages;
    }
}
