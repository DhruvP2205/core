<?php Ccc::loadClass('Block_Core_Grid');

class Block_Page_Grid extends Block_Core_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->prepareCollections();
    }

    public function prepareCollections()
    {
        $this->addColumn([
        'title' => 'Page Id',
        'type' => 'int',
        'key' =>'pageId'
        ],'id');

        $this->addColumn([
        'title' => 'Name',
        'type' => 'varchar',
        'key' =>'name'
        ],'Name');

        $this->addColumn([
        'title' => 'Code',
        'type' => 'varchar',
        'key' =>'code'
        ],'Code');

        $this->addColumn([
        'title' => 'Content',
        'type' => 'varchar',
        'key' =>'content'
        ],'Content');

        $this->addColumn([
        'title' => 'Status',
        'type' => 'int',
        'key' =>'status'
        ],'Status');

        $this->addColumn([
        'title' => 'Created Date',
        'type' => 'datetime',
        'key' =>'createdDate'
        ],'Created Date');

        $this->addColumn([
        'title' => 'Updated Date',
        'type' => 'datetime',
        'key' =>'updatedDate'
        ],'Updated Date');

        $this->addAction(['title' => 'edit', 'method' => 'getEditUrl', 'class' => 'page' ], 'Edit');
        $this->addAction(['title' => 'delete', 'method' => 'getDeleteUrl', 'class' => 'page' ], 'Delete');
        $this->prepareCollectionContent();       
    }

    public function prepareCollectionContent()
    {
        $pages = $this->getPages();
        $this->setCollection($pages);
        return $this;
    }

    public function getPages()
    {
        $request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr',20);

        $pagerModel = Ccc::getModel('Core_Pager');
        $totalCount = $pagerModel->getAdapter()->fetchOne("SELECT count(pageId) FROM `page`");
        
        $pagerModel->execute($totalCount, $page, $ppr);
        $this->setPager($pagerModel);
        
        $pageModel = Ccc::getModel('Page');
        
        $pages = $pageModel->fetchAll("SELECT * FROM `page` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}");
        $pageColumn = [];
        foreach ($pages as $page) 
        {
            array_push($pageColumn, $page);
        }        
        return $pageColumn;
    }
}
