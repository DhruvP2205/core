<?php Ccc::loadClass('Block_Core_Grid');

class Block_Config_Grid extends Block_Core_Grid
{ 
    public function __construct()
    {
        parent::__construct();
        $this->prepareCollections();
    }

    public function prepareCollections()
    {
        $this->addColumn([
        'title' => 'Config Id',
        'type' => 'int',
        'key' =>'configId'
        ],'Config Id');

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
        'title' => 'Value',
        'type' => 'varchar',
        'key' =>'value'
        ],'Value');

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

        $this->addAction(['title' => 'edit', 'method' => 'getEditUrl', 'class' => 'config' ], 'Edit');
        $this->addAction(['title' => 'delete', 'method' => 'getDeleteUrl', 'class' => 'config' ], 'Delete');
        $this->prepareCollectionContent();       
    }

    public function prepareCollectionContent()
    {
        $configs = $this->getConfigs();
        $this->setCollection($configs);
        return $this;
    }

    public function getConfigs()
    {
        $request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr',20);

        $pagerModel = Ccc::getModel('Core_Pager');
        $totalCount = $pagerModel->getAdapter()->fetchOne("SELECT count(configId) FROM `config`");
        
        $pagerModel->execute($totalCount, $page, $ppr);
        $this->setPager($pagerModel);
        
        $configModel = Ccc::getModel('Config');
        
        $configs = $configModel->fetchAll("SELECT * FROM `config` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}");
        $configColumn = [];
        foreach ($configs as $config) 
        {
            array_push($configColumn, $config);
        }        
        return $configColumn;
    }
}
