<?php Ccc::loadClass('Block_Core_Grid'); 

class Block_Vendor_Grid extends Block_Core_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->prepareCollections();
    }

    public function prepareCollections()
    {
        $this->addColumn([
        'title' => 'Vendor Id',
        'type' => 'int',
        'key' =>'vendorId'
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
        'title' => 'Status',
        'type' => 'int',
        'key' =>'status'
        ],'Status');

        $this->addColumn([
        'title' => 'Address',
        'type' => 'varchar',
        'key' =>'address'
        ],'Address');

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

        $this->addAction(['title' => 'edit','method' => 'getEditUrl','class' => 'vendor' ],'Edit');
        $this->addAction(['title' => 'delete','method' => 'getDeleteUrl','class' => 'vendor' ],'Delete');
        $this->prepareCollectionContent();       
    }

    public function prepareCollectionContent()
    {
        $vendors = $this->getVendors();
        $this->setCollection($vendors);
        return $this;
    }

    public function getVendors()
    {
        $request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr',20);

        $pagerModel = Ccc::getModel('Core_Pager');
        $vendorModel = Ccc::getModel('Vendor');

        $totalCount = $pagerModel->getAdapter()->fetchOne("SELECT count(vendorId) FROM `vendor`");

        $pagerModel->execute($totalCount, $page, $ppr);
        $this->setPager($pagerModel);

        $vendors = $vendorModel->fetchAll("SELECT * FROM `vendor` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}");

        $vendorColumn = [];
        if($vendors)
        {
            foreach ($vendors as $vendor)
            {
                $address = null;
                foreach($vendor->getAddress()->getData() as $key => $value)
                {
                    if($key != 'addressId' && $key != 'vendorId')
                    {
                        $address .= $key." : ".$value."<br>";
                    }
                }
                $vendor->setData(['address' => $address]);
                array_push($vendorColumn, $vendor);
            }
        }
        return $vendorColumn;
    }
}
