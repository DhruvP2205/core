<?php Ccc::loadClass('Controller_Admin_Action');

class Controller_Salesman extends Controller_Admin_Action
{
    public function __construct()
    {
        if(!$this->authentication())
        {
            $this->redirect('login','admin_login');
        }
    }
    
    public function gridAction()
    {
        $this->setTitle('Salesman');
        $content = $this->getLayout()->getContent();
        $salesmanGrid = Ccc::getBlock('Salesman_Grid');
        $content->addChild($salesmanGrid,'Grid');
        $this->renderLayout();
    }

    public function addAction()
    {
        $this->setTitle('Add Salesman');
        $salesmanModel = Ccc::getModel('Salesman');
        $content = $this->getLayout()->getContent();
        $salesmanAdd = Ccc::getBlock('Salesman_Edit')->setData(['salesman'=>$salesmanModel]);
        $content->addChild($salesmanAdd,'Add');
        $this->renderLayout();
    }

    public function saveAction()
    {
        try
        {
            $salesmenModel = Ccc::getModel('salesman');
            $request = $this->getRequest();
            $postData = $request->getPost('salesman');
            if(!$postData)
            {
                throw new Exception("Invalid Request.");
            }

            $salesmen = $salesmenModel;
            $salesmen->setData($postData);

            if(!$salesmen->salesmanId)
            {
                unset($salesmen->salesmanId);
                $salesmen->createdDate = date("Y-m-d h:i:s");
            }
            else
            {
                $salesmen->updatedDate = date("Y-m-d h:i:s");
            }

            $insert = $salesmen->save();
            if(!$insert)
            {
                throw new Exception("Unable to insert Salesman.");
            }
            $this->getMessage()->addMessage('Salesman Inserted succesfully.',1); 
            $this->redirect('grid','salesman',[],true);
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->redirect('grid','Salesman',[],true);
        }
    }

    public function editAction()
    {
        try
        {
            $this->setTitle('Edit Salesman');
            $salesmanModel = Ccc::getModel('Salesman');
            $request = $this->getRequest();
            $id = (int)$request->getRequest('id');

            if(!$id)
            {
                throw new Exception("Error Processing Request");         
            }
            
            $salesman = $salesmanModel->load($id);
            
            if(!$salesman)
            {   
                throw new Exception("Error Processing Request");        
            }

            $content = $this->getLayout()->getContent();
            $salesmanEdit = Ccc::getBlock('Salesman_Edit')->setData(['salesman'=>$salesman]);
            $content->addChild($salesmanEdit,'Edit');
            $this->renderLayout();
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->redirect('grid','salesman',[],true);
        }
    }


    public function deleteAction()
    {
        try 
        {
            $salesmanModel = Ccc::getModel('Salesman');
            $customerModel = Ccc::getModel('Customer');
            $customerPriceModel = Ccc::getModel('Customer_Price');
            $request = $this->getRequest();

            if(!$request->getRequest('id'))
            {
                throw new Exception("Error Processing Request");
            }

            $salesmanId = (int)$request->getRequest('id');

            $customers = $customerModel->fetchAll("SELECT * FROM `customer` WHERE `salesmanId` = {$salesmanId}");
            foreach($customers as $customer)
            {
                $customerPrices = $customerPriceModel->fetchAll("SELECT `entityId` FROM `customer_price` WHERE `customerId` = {$customer->customerId}");
                foreach ($customerPrices as $customerPrice) 
                {
                    $customerPriceModel->load($customerPrice->entityId)->delete();
                }
            }

            $result = $salesmanModel->load($salesmanId);
            if(!$result)
            {
                throw new Exception("Error Processing Request");
            }
            $result->delete();
            $this->getMessage()->addMessage('Data Deleted.');
            $this->redirect('grid','salesman',[],true);
        } 
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->redirect('grid','salesman',[],true);
        }
    }
}
