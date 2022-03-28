<?php Ccc::loadClass('Block_Core_Grid_Collection');

class Block_Customer_Grid_Collection extends Block_Core_Grid_Collection
{
    public function __construct()
    {
        $this->setCurrentCollection('personal');
        parent::__construct();
    }

    public function prepareCollections()
    {
        $this->addCollection([
            'header' => ['CustomerId' , 'First Name' , 'Last Name' , 'Email' , 'Mobile' , 'Status' , 'CreatedDate' , 'updatedDate' , 'Billing Address' , 'Shipping Address'],
            'action' => $this->getActions(),
            'url' => $this->getUrl(null,null,['Collection' => 'personal'])
        ],'personal');
        $this->prepareCollectionContent();       
    }

    public function prepareCollectionContent()
    {
        $customers = $this->getCustomers();
        foreach ($customers as $customer)
        {
            $customer->setData(['billing' => $customer->getBillingAddress()]);
            $customer->setData(['shipping' => $customer->getShippingAddress()]);
        }
        $customerArray = [];
        foreach($customers as $customer)
        {
            $customer->status = $customer->getStatus($customer->status);
            $tempArray = [];   
            foreach($customer->getData() as $key => $value)
            {
                $tempArray[] = $value;
                if($key == 'billing'||$key == 'shipping')
                {
                    $address= null;
                    foreach ($value->getData() as $k => $data) 
                    {   
                        if($k != 'billingAddress' && $k != 'shipingAddress' && $k != 'addressId' && $k != 'customerId')
                        {
                            $address .= $k." : ".$data."<br>";
                        }
                    }
                    array_push($tempArray,$address);
                }
            }
            unset($tempArray[8]);
            unset($tempArray[10]);
            array_push($customerArray , $tempArray);
        }
        $this->setColumns($customerArray ) ;
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
        $customers = $customerModel->fetchAll("SELECT `customerId`,`firstName`,`lastName`,`email`,`mobile`,`status`,`createdDate`,`updatedDate` FROM `customer` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}");
        $this->setPagerModel($pagerModel);
        return $customers;
    }
}
