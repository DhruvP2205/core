<?php Ccc::loadClass('Controller_Admin_Action');

class Controller_Customer extends Controller_Admin_Action
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
        $this->setTitle('Customer');
        $content = $this->getLayout()->getContent();
        $adminGrid = Ccc::getBlock('Admin_Index');
        $content->addChild($adminGrid);

        $this->renderLayout();
    }

    public function gridBlockAction()
    {
        $customerGrid = Ccc::getBlock('Customer_Grid')->toHtml();
        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#indexContent',
                    'content' => $customerGrid
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

        $customerModel = Ccc::getModel("Customer");
        $billingAddress = $customerModel->getBillingAddress();
        $shippingAddress = $customerModel->getShippingAddress();
        $customer = $customerModel;
        $address = $customerModel;

        Ccc::register('customer',$customerModel);
        Ccc::register('billingAddress',$customerModel);
        Ccc::register('shippingAddress',$customerModel);

        $customerEdit = $this->getLayout()->getBlock('Customer_Edit')->toHtml();

        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
        
        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#indexContent',
                    'content' => $customerEdit
                ],
                [
                    'element' => '#adminMessage',
                    'content' => $messageBlock
                ]
            ]
        ];
        $this->renderJson($response);
    }

    public function editBlockAction()
    {
        try
        {
            $customerModel = Ccc::getModel("Customer");
            $addressModel = Ccc::getModel("Customer_Address");
            $request = $this->getRequest();
            $customerId = $request->getRequest('id');
            if(!$customerId)
            {
                throw new Exception("Error Processing Request");         
            }
            if(!(int)$customerId)
            {
                throw new Exception("Error Processing Request", 1);         
            }
            $customer = $customerModel->load($customerId);
            if(!$customer)
            {
                throw new Exception("Error Processing Request", 1);         
            }
            $billingAddress = $customer->getBillingAddress();
            $shippingAddress = $customer->getShippingAddress();

            Ccc::register('customer',$customer);
            Ccc::register('billingAddress',$billingAddress);
            Ccc::register('shippingAddress',$shippingAddress);

            $customerEdit = Ccc::getBlock('Customer_Edit')->toHtml();
            $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
            $response = [
                'status' => 'success',
                'elements' => [
                    [
                        'element' => '#indexContent',
                        'content' => $customerEdit
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

    protected function saveCustomer()
    {
        $customerModel = Ccc::getModel('Customer');
        $request = $this->getRequest();
        if(!$request->getPost('customer'))
        {
            throw new Exception("Request Invalid.");
        }   
        $postData = $request->getPost('customer');
        if(!$postData)
        {
            throw new Exception("Invalid data Posted.");
        }
        $customer = $customerModel;
        $customer->setData($postData);
        if(!$customer->customerId)
        {
            unset($customer->customerId);
            $customer->createdDate = date('y-m-d h:m:s');
        }
        else
        {
            $customer->updatedDate = date('y-m-d h:i:s');
        }
        $save = $customer->save();
        if(!$save->customerId)
        {
            throw new Exception("Unable to insert Customer.");
        }
        $message = $this->getMessage()->addMessage('Customer data saved succesfully.',1);
        return $save;
    }


    protected function saveAddress($customer = null)
    {
        $request = $this->getRequest();
        if(!$customer)
        {
            $customerId = $request->getRequest('id');
            if(!$customerId)
            {
                throw new Exception("First create customer.");
            }
            $customer = Ccc::getModel('customer')->load($customerId);
        }
        if(!$request->getPost())
        {
            throw new Exception("Invalid Request.");
        }
        $postBilling = $request->getPost('billingAddress');
        $postShipping = $request->getPost('shippingAddress');
        
        $billing = $customer->getBillingAddress();
        $shipping = $customer->getShippingAddress();

        if(!$billing->addressId)
        {
            unset($billing->addressId);
        }

        if(!$shipping->addressId)
        {
            unset($shipping->addressId);
        }

        if($postBilling)
        {
            $billing->setData($postBilling);
        }
        else
        {   
            $billing->billingAddress = 1;
            $billing->shipingAddress = 2;
        }
        $billing->customerId = $customer->customerId;

        if($postShipping)
        {
            $shipping->setData($postShipping);
        }
        else
        {
            $shipping->billingAddress = 2;
            $shipping->shipingAddress = 1;
        }
        $shipping->customerId = $customer->customerId;
        
        $save = $billing->save();

        if(!$save)
        {
            throw new Exception("Customer Details Not Saved.");
        }
        $save = $shipping->save();
        if(!$save)
        {
            throw new Exception("Customer Details Not Saved.");
        }
        $message = $this->getMessage()->addMessage('Customer data saved succesfully.',1);
    }

    public function saveAction()
    {
        try
        {
            $request = $this->getRequest();
            if($request->getPost('customer'))
            {
                $customer = $this->saveCustomer();
                if(!$customer)
                {
                    throw new Exception("System is unable to Save.", 1);
                }
                $this->saveAddress($customer);
            }
            if($request->getPost('billingAddress') || $request->getPost('shippingAddress'))
            {
                $this->saveAddress();           
            }
            $message = $this->getMessage()->addMessage('Customer Inserted succesfully.',1);
            $this->gridBlockAction();
        }
        catch (Exception $e)
        {
            $message = $this->getMessage()->addMessage($e->getMessage(),3);
            $this->gridBlockAction();
        }
    }

    public function deleteAction()
    {
        try 
        {
            $customerModel = Ccc::getModel('Customer');
            $request = $this->getRequest();
            if(!$request->getRequest('id'))
            {
                throw new Exception("Request Invalid.");
            }

            $customerId = $request->getRequest('id');
            if(!$customerId)
            {
                throw new Exception("Unable to fetch ID.");
            }

            $result = $customerModel->load($customerId);
            if(!$result)
            {
                throw new Exception("Unable to Delete Record.");
            }
            $result->delete();
            $message = $this->getMessage()->addMessage('Data deleted.');
            $this->gridBlockAction();
        } 
        catch (Exception $e) 
        {
            $message = $this->getMessage()->addMessage($e->getMessage(),3);
            $this->gridBlockAction();
        }       
    }
}
