<?php Ccc::loadClass("Controller_Core_Action");

class Controller_Salesman_Customer extends Controller_Core_Action
{
    public function gridAction()
    {
        $content = $this->getLayout()->getContent();
        $salesmanGrid = Ccc::getBlock("Salesman_Customer_Grid");
        $content->addChild($salesmanGrid);
        $this->renderLayout();
    }

    public function saveAction()
    {
        $customerModel = Ccc::getModel('Customer');
        $request = $this->getRequest();
        $salesmanId = $request->getRequest('id');

        if($request->isPost())
        {
            $customerData = $request->getPost('customer');
            $customerModel->salesmanId = $salesmanId;

            foreach($customerData as $customer)
            {
                $customerModel->customerId = $customer;
                $result = $customerModel->save(); 

                if(!$result)
                {
                    $this->getMessage()->addMessage("Data not saved");
                    throw new Exception("Error Processing Request", 1);
                }
            }
            $this->redirect('grid','Salesman_Customer');
        }
    }
}
