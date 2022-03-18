<?php Ccc::loadClass("Controller_Admin_Action");

class Controller_Salesman_Customer extends Controller_Admin_Action
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
        $this->setTitle('Salesman Customer');
        $content = $this->getLayout()->getContent();
        $salesmanGrid = Ccc::getBlock("Salesman_Customer_Grid");
        $content->addChild($salesmanGrid);
        $this->renderLayout();
    }

    public function saveAction()
    {
        try
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
                        throw new Exception("Data not saved.");
                    }
                }
                $this->getMessage()->addMessage("Data saved.");
                $this->redirect('grid','Salesman_Customer');
            }
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->redirect('grid','Salesman_Customer');
        }
        
    }
}
