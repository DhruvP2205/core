<?php Ccc::loadClass('Block_Core_Grid');

class Block_Customer_Grid extends Block_Core_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->prepareCollections();
    }

    public function prepareCollections()
    {
        $this->addColumn([
        'title' => 'Customer Id',
        'type' => 'int',
        'key' =>'customerId'
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
        'title' => 'Billing Address',
        'type' => 'varchar',
        'key' =>'billing'
        ],'Billing Address');

        $this->addColumn([
        'title' => 'Shipping Address',
        'type' => 'varchar',
        'key' =>'shipping'
        ],'Shipping Address');

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

        $this->addAction(['title' => 'edit','method' => 'getEditUrl','class' => 'customer' ],'Edit');
        $this->addAction(['title' => 'delete','method' => 'getDeleteUrl','class' => 'customer' ],'Delete');
        $this->addAction(['title' => 'price','method' => 'getPriceUrl','class' => 'customer_price' ],'Price');
        $this->prepareCollectionContent();       
    }

    public function prepareCollectionContent()
    {
        $customers = $this->getCustomers();
        $this->setCollection($customers);
        return $this;
    }

    public function getCustomers()
    {
        $request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr',20);

        $pagerModel = Ccc::getModel('Core_Pager');
        
        $customerModel = Ccc::getModel('Customer');   
        $totalCount = $pagerModel->getAdapter()->fetchOne("SELECT count(customerId) FROM `customer`");
        
        $pagerModel->execute($totalCount,$page,$ppr);
        $this->setPager($pagerModel);
        $customers = $customerModel->fetchAll("SELECT * FROM `customer` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}");
        
        $customerColumn = [];
        foreach ($customers as $customer)
        {
            $billing = null;
            $shipping = null;
            foreach($customer->getBillingAddress()->getData() as $key => $value)
            {
                if($key != 'addressId' && $key != 'customerId')
                {
                    $billing .= $key." : ".$value."<br>";
                }
            }
            foreach($customer->getShippingAddress()->getData() as $key => $value)
            {
                if($key != 'addressId' && $key != 'customerId')
                {
                    $shipping .= $key." : ".$value."<br>";
                }
            }
            $customer->setData(['billing' => $billing]);
            $customer->setData(['shipping' => $shipping]);
            array_push($customerColumn,$customer);
        }        
        return $customerColumn;
    }
}
