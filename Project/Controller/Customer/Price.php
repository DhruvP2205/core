<?php Ccc::loadClass('Controller_Admin_Action');

class Controller_Customer_Price extends Controller_Admin_Action
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
        $this->setTitle('Customer Price');
        $content = $this->getLayout()->getContent();
        $customerPriceGrid = Ccc::getBlock('Customer_Price_Grid');
        $content->addChild($customerPriceGrid,'Grid');
        $this->renderLayout();
    }

    public function saveAction()
    {
        try 
        {
            $customerPriceModel = Ccc::getModel('Customer_Price');
            $request = $this->getRequest();
            $customerId = $request->getRequest('id');
            
            if($request->isPost())
            {
                $customers = $customerPriceModel->fetchAll("SELECT * FROM `customer_price` WHERE `customerId` = {$customerId}");

                if($customers)
                {
                    foreach($customers as $customer)
                    {
                        $customerPriceModel->load($customer->customerId,'customerId')->delete();
                    }
                }

                $customerData = $request->getPost('product');
                $customerPriceModel->customerId = $customerId;

                foreach($customerData as $customer)
                {
                    if($customer['salesmanPrice'] <= $customer['price'])
                    {
                        $customerPriceModel->price = $customer['price'];
                    }
                    else
                    {
                        $customerPriceModel->price = $customer['salesmanPrice'];
                    }
                    if($customer['price'])
                    {
                        $customerPriceModel->productId = $customer['productId'];
                        $customerPriceModel->save();
                        unset($customerPriceModel->entityId);
                    }
                }
            }
            $this->getMessage()->addMessage('Discount added.');
            $this->redirect('grid','customer_price',['id' => $customerId],true);
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->redirect('grid','customer_price',['id' => $customerId],true);
        }
    }
}
