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
    
    public function gridAction()
    {
        $this->setTitle('Customer');
        $content = $this->getLayout()->getContent();
        $customerGrid = Ccc::getBlock('Customer_Grid');
        $content->addChild($customerGrid,'Grid');
        $this->renderLayout();
    }

    public function addAction()
    {
        $this->setTitle('Add Customer');

        $customerModel = Ccc::getModel('Customer');
        $billingAddress = $customerModel->getBillingAddress();
        $shippingAddress = $customerModel->getShippingAddress();

        $content = $this->getLayout()->getContent();
        $customerAdd = Ccc::getBlock('Customer_Edit');

        Ccc::register('customer',$customerModel);
        Ccc::register('billingAddress',$billingAddress);
        Ccc::register('shippingAddress',$shippingAddress);

        $content->addChild($customerAdd,'Add');
        $this->renderLayout();
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
        $this->getMessage()->addMessage('Customer Inserted succesfully.',1);
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
            $this->redirect('grid','customer',[],true);
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->redirect('grid','customer',[],true);
        }
    }

    public function editAction()
    {
        try
        {
            $this->setTitle('Edit Customer');
            $customerModel = Ccc::getModel('Customer');
            $request = $this->getRequest();
            $id = (int)$request->getRequest('id');
            if(!$id)
            {
                throw new Exception("Request Invalid.");
            }
            
            $customer = $customerModel->load($id);
            
            if(!$customer)
            {   
                throw new Exception("System is unable to find record.");
            }

            $content = $this->getLayout()->getContent();
            $customerEdit = Ccc::getBlock('Customer_Edit');
            Ccc::register('customer',$customer);
            Ccc::register('billingAddress',$customer->getBillingAddress());
            Ccc::register('shippingAddress',$customer->getShippingAddress());

            $content->addChild($customerEdit,'Edit');
            $this->renderLayout();   
        }
        catch (Exception $e) 
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->redirect('grid','customer',[],true);
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
            $this->getMessage()->addMessage('Data Deleted.');
            $this->redirect('grid','customer',[],true);
        } 
        catch (Exception $e) 
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->redirect('grid','customer',[],true);
        }       
    }
}
