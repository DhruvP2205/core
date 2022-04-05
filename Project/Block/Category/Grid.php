<?php Ccc::loadClass("Block_Core_Grid"); ?>
<?php

class Block_Category_Grid extends Block_Core_Grid
{
    protected $pager = null;

    public function __construct()
    {
        parent::__construct();
        $this->prepareCollections();
    }

    public function prepareCollections()
    {

        $this->addColumn([
        'title' => 'Category Id',
        'type' => 'int',
        'key' =>'categoryId'
        ],'id');
        $this->addColumn([
        'title' => 'Name',
        'type' => 'varchar',
        'key' =>'name'
        ],'Name');
        $this->addColumn([
        'title' => 'Path',
        'type' => 'varchar',
        'key' =>'path'
        ],'Path');
        $this->addColumn([
        'title' => 'Base',
        'type' => 'varchar',
        'key' =>'base'
        ],'Base');
        $this->addColumn([
        'title' => 'Thumb',
        'type' => 'varchar',
        'key' =>'thumb'
        ],'Thumb');
        $this->addColumn([
        'title' => 'Small',
        'type' => 'int',
        'key' =>'small'
        ],'Small');
        $this->addColumn([
        'title' => 'Status',
        'type' => 'datetime',
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
        $this->addAction([
            'title' => 'edit','method' => 'getEditUrl','class' => 'category' 
        ],'Edit');
        $this->addAction([
            'title' => 'delete','method' => 'getDeleteUrl','class' => 'category' 
        ],'Delete');
        $this->prepareCollectionContent();       
    }

    public function prepareCollectionContent()
    {
        $categories = $this->getCategory();
        $this->setCollection($categories);
        return $this;
    }

    public function getCategory()
    {

        $request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr',20);

        $pagerModel = Ccc::getModel('Core_Pager');
        $totalCount = $pagerModel->getAdapter()->fetchOne("SELECT COUNT('categoryId') FROM `category`");
        
        $pagerModel->execute($totalCount, $page, $ppr);
        $this->setPager($pagerModel);
        
        $categoryModel = Ccc::getModel('Category');
        
        $categories = $categoryModel->fetchAll("SELECT * FROM `category` ORDER BY `path` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}");
        $categoryColumn = [];
        if(!$categories)
        {
            return null;
        }
        foreach ($categories as $category) 
        {
            array_push($categoryColumn, $category);
        }        
        return $categoryColumn;
    }
}
