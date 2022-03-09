<?php Ccc::loadClass('Controller_Core_Action');

class Controller_Customer_Price extends Controller_Core_Action
{
    public function gridAction()
    {
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
                    $customerPriceModel->discount = $customer['discount'];
                    $customerPriceModel->productId = $customer['productId'];
                    $customerPriceModel->save();
                }
            }
            $this->getMessage()->addMessage('Discount set successfully');
            $this->redirect('grid','customer_price',['id' => $customerId],true);
        }
        catch (Exception $e)
        {
            $this->redirect('grid','customer_price',['id' => $customerId],true);
        }
    }
}
