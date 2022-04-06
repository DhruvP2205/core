<?php Ccc::loadClass('Block_Core_Grid');

class Block_Salesman_Grid extends Block_Core_Grid
{ 
    public function __construct()
    {
        parent::__construct();
        $this->prepareCollections();
    }

    public function prepareCollections()
    {
        $this->addColumn([
        'title' => 'Salesman Id',
        'type' => 'int',
        'key' =>'salesmanId'
        ],'id');

        $this->addColumn([
        'title' => 'First Name',
        'type' => 'varchar',
        'key' =>'firstName'
        ],'First Name');

        $this->addColumn([
        'title' => 'Last Name',
        'type' => 'varchar',
        'key' =>'lastName'
        ],'Last Name');

        $this->addColumn([
        'title' => 'Email',
        'type' => 'varchar',
        'key' =>'email'
        ],'Email');

        $this->addColumn([
        'title' => 'Mobile',
        'type' => 'int',
        'key' =>'mobile'
        ],'Mobile');

        $this->addColumn([
        'title' => 'Discount',
        'type' => 'int',
        'key' =>'discount'
        ],'Discount');

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

        $this->addAction(['title' => 'edit','method' => 'getEditUrl','class' => 'salesman' ],'Edit');
        $this->addAction(['title' => 'delete','method' => 'getDeleteUrl','class' => 'salesman' ],'Delete');
        $this->addAction(['title' => 'manage-customer','method' => 'getSalesmanUrl','class' => 'salesman_customer' ],'Salesman');
        $this->prepareCollectionContent();
    }

    public function prepareCollectionContent()
    {
        $salesmans = $this->getSalesmans();
        $this->setCollection($salesmans);
        return $this;
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
        $salesmanColumn = [];
        if($salesmans)
        {
            foreach ($salesmans as $salesman) 
            {
                array_push($salesmanColumn, $salesman);
            }
        }
        return $salesmanColumn;
    }
}
