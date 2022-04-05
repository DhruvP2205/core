<?php Ccc::loadClass('Block_Core_Grid');

class Block_Admin_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		parent::__construct();
		$this->prepareCollections();
	}

	public function prepareCollections()
    {
       	$this->addColumn([
		'title' => 'Admin Id',
		'type' => 'int',
		'key' =>'adminId'
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

		$this->addAction(['title' => 'edit', 'method' => 'getEditUrl', 'class' => 'admin' ], 'Edit');
		$this->addAction(['title' => 'delete', 'method' => 'getDeleteUrl', 'class' => 'admin' ], 'Delete');
        $this->prepareCollectionContent();       
    }

	public function prepareCollectionContent()
    {
        $admins = $this->getAdmins();
        $this->setCollection($admins);
        return $this;
    }

	public function getAdmins()
    {
        $request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr',20);

        $pagerModel = Ccc::getModel('Core_Pager');
        $totalCount = $pagerModel->getAdapter()->fetchOne("SELECT count(adminId) FROM `admin`");
        
        $pagerModel->execute($totalCount, $page, $ppr);
        $this->setPager($pagerModel);
        
        $adminModel = Ccc::getModel('Admin');
        
        $admins = $adminModel->fetchAll("SELECT * FROM `admin` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}");
        $adminColumn = [];
        if($admins)
        {
        	foreach ($admins as $admin) 
	        {
	            array_push($adminColumn, $admin);
	        } 
        }
        return $adminColumn;
    }
}
