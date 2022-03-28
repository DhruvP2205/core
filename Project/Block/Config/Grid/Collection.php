<?php Ccc::loadClass('Block_Core_Grid_Collection');

class Block_Config_Grid_Collection extends Block_Core_Grid_Collection
{
    public function __construct()
    {
        $this->setCurrentCollection('config');
        parent::__construct();
    }

    public function prepareCollections()
    {
        $this->addCollection([
            'header' => ['Config Id','Name','Code','Value','Status','Created Date'],
            'action' => $this->getActions(),
            'url' => $this->getUrl(null,null,['Collection' => 'config'])
        ],'config');
        $this->prepareCollectionContent();
    }

    public function prepareCollectionContent()
    {
        $configs = $this->getConfigs();
        $configData = [];
        foreach($configs as $config)
        {
            $tempData = [];
            $config->status = $config->getStatus($config->status); 
            
            foreach($config->getData() as $key => $value)
            {
                $tempData[] = $value;
            }
            array_push($configData, $tempData);
        }
        $this->setColumns($configData);
        return $this;
    }

    public function getConfigs()
    {
        $request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr',20);

        $pagerModel = Ccc::getModel('Core_Pager');
        $configModel = Ccc::getModel('Config');

        $totalCount = $pagerModel->getAdapter()->fetchOne("SELECT count(configId) FROM `config`");
        $pagerModel->execute($totalCount, $page, $ppr);

        $this->setPager($pagerModel);
        $configs = $configModel->fetchAll("SELECT `configId`, `name`, `code`, `value`, `status`, `createdDate` FROM `config` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}");
        $this->setPagerModel($pagerModel);
        return $configs;
    }
}
