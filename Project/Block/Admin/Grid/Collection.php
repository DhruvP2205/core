<?php Ccc::loadClass('Block_Core_Grid_Collection');

class Block_Admin_Grid_Collection extends Block_Core_Grid_Collection
{
    public function __construct()
    {
        $this->setCurrentCollection('personal');
        parent::__construct();
    }

    public function prepareCollections()
    {
        $this->addCollection([
            'header' => ['Admin Id','First Name','Last Name','Email','Status','Created Date','Updated Date'],
            'action' => $this->getActions(),
            'url' => $this->getUrl(null,null,['Collection' => 'personal'])
        ],'personal');
        $this->prepareCollectionContent();
    }

    public function prepareCollectionContent()
    {
        $admins = $this->getAdmins();
        $adminData = [];
        foreach($admins as $admin)
        {
            $tempData = [];
            $admin->status = $admin->getStatus($admin->status); 
            
            foreach($admin->getData() as $key => $value)
            {
                $tempData[] = $value;
            }
            array_push($adminData, $tempData);
        }
        $this->setColumns($adminData);
        return $this;
    }

    public function getAdmins()
    {
        $request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr',20);

        $pagerModel = Ccc::getModel('Core_Pager');
        
        $adminModel = Ccc::getModel('Admin');   
        $totalCount = $pagerModel->getAdapter()->fetchOne("SELECT count(adminId) FROM `admin`");
        
        $pagerModel->execute($totalCount,$page,$ppr);
        $this->setPager($pagerModel);
        $admins = $adminModel->fetchAll("SELECT `adminId`,`firstName`,`lastName`,`email`,`status`,`createdDate`,`updatedDate` FROM `admin` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}");
        $this->setPagerModel($pagerModel);
        return $admins;

    }
}
