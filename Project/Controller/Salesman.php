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

    public function indexAction()
    {
        $this->setTitle('Salesman');
        $content = $this->getLayout()->getContent();
        $salesmanGrid = Ccc::getBlock('Salesman_Index');
        $content->addChild($salesmanGrid);
        $this->renderLayout();
    }

    public function gridBlockAction()
    {
        $salesmanGrid = Ccc::getBlock('Salesman_Grid')->toHtml();
        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#indexContent',
                    'content' => $salesmanGrid
                ],
                [
                    'element' => '#adminMessage',
                    'content' => $messageBlock
                ]
            ]
        ];
        $this->renderJson($response);
    }

    public function addBlockAction()
    {
        $salesmanModel = Ccc::getModel("Salesman");
        Ccc::register('salesman',$salesmanModel);

        $salesmanEdit = $this->getLayout()->getBlock('Salesman_Edit')->toHtml();
        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
        
        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#indexContent',
                    'content' => $salesmanEdit
                ],
                [
                    'element' => '#adminMessage',
                    'content' => $messageBlock
                ]
            ]
        ];
        $this->renderJson($response);
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
            $this->gridBlockAction();
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->gridBlockAction();
        }
    }

    public function editBlockAction()
    {
        try
        {
            $this->setTitle('Edit Salesman');
            $salesmanModel = Ccc::getModel('Salesman');
            $request = $this->getRequest();
            $id = (int)$request->getRequest('id');

            if(!$id)
            {
                throw new Exception("Request Invalid.");
            }
            
            $salesman = $salesmanModel->load($id);
            
            if(!$salesman)
            {   
                throw new Exception("System is unable to find record.");
            }
            Ccc::register('salesman',$salesman);

            $salesmanEdit = Ccc::getBlock('Salesman_Edit')->toHtml();
            $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
            $response = [
                'status' => 'success',
                'elements' => [
                    [
                        'element' => '#indexContent',
                        'content' => $salesmanEdit
                    ],
                    [
                        'element' => '#adminMessage',
                        'content' => $messageBlock
                    ]
                ]
            ];
            $this->renderJson($response);
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->gridBlockAction();
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
            if($customers)
            {
                foreach($customers as $customer)
                {
                    $customerPrices = $customerPriceModel->fetchAll("SELECT `entityId` FROM `customer_price` WHERE `customerId` = {$customer->customerId}");
                    foreach ($customerPrices as $customerPrice) 
                    {
                        $customerPriceModel->load($customerPrice->entityId)->delete();
                    }
                }
            }

            $result = $salesmanModel->load($salesmanId);
            if(!$result)
            {
                throw new Exception("Error Processing Request");
            }
            $result->delete();
            $this->getMessage()->addMessage('Data Deleted.');
            $this->gridBlockAction();
        } 
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->gridBlockAction();
        }
    }
}
