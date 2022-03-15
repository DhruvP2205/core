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
        $customerAdd = Ccc::getBlock('Customer_Edit')->setData(['customer'=>$customerModel, 'billingAddress'=>$billingAddress, 'shippingAddress'=>$shippingAddress]);
        $content->addChild($customerAdd,'Add');
        $this->renderLayout();
    }

    protected function saveCustomer()
    {
        $customerModel = Ccc::getModel('Customer');
        $request = $this->getRequest();
        if(!$request->getPost('customer'))
        {
            $this->getMessage()->addMessage('Request Invalid.',3);
            throw new Exception("Request Invalid.", 1);
        }   
        $postData = $request->getPost('customer');
        if(!$postData)
        {
            $this->getMessage()->addMessage('Invalid data Posted.',3);
            throw new Exception("Invalid data Posted.", 1);
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
            $update = $customer->save();
        }
        $save = $customer->save();
        if(!$save->customerId)
        {
            $this->getMessage()->addMessage('Unable to insert Customer.',3);
            throw new Exception("Unable to insert Customer.", 1);
        }
        $this->getMessage()->addMessage('Customer Inserted succesfully.',1);
        return $save->customerId;
    }


    protected function saveAddress($customerId, $type)
    {
        $addressModel = Ccc::getModel('Customer_Address');
        $request = $this->getRequest();
        if(!$request->getPost($type))
        {
            $this->getMessage()->addMessage('Request Invalid.',3);
            throw new Exception("Invalid Request.", 1);
        }   
        $postData = $request->getPost($type);
        if(!$postData)
        {
            $this->getMessage()->addMessage('Invalid data Posted.',3);
            throw new Exception("Invalid data Posted.", 1);
        }
        $address = $addressModel;
        $address->setData($postData);
        $address->customerId = $customerId;

        if(!$address->addressId)
        {   
            unset($address->addressId);
        }
        $save = $address->save();
        if(!$save)
        {
            $this->getMessage()->addMessage('Customer Details Not Saved.',3);
            throw new Exception("Customer Details Not Saved.", 1);
        }
    }

    public function saveAction()
    {
        try
        {
            $customerId = $this->saveCustomer();
            if($customerId)
            {
                $this->saveAddress($customerId,'billingAddress');
                $this->saveAddress($customerId,'shippingAddress');
            }
            $this->redirect('grid','customer',[],true);
        }
        catch (Exception $e)
        {
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
                $this->getMessage()->addMessage('Request Invalid.',3);
                throw new Exception("Request Invalid.", 1);
            }
            
            $customer = $customerModel->load($id);
            
            if(!$customer)
            {   
                $this->getMessage()->addMessage('System is unable to find record.',3);
                throw new Exception("System is unable to find record.", 1);
            }

            $content = $this->getLayout()->getContent();
            $customerEdit = Ccc::getBlock('Customer_Edit')->setData(['customer'=>$customer]);
            $content->addChild($customerEdit,'Edit');
            $this->renderLayout();   
        }
        catch (Exception $e) 
        {
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
                $this->getMessage()->addMessage('Request Invalid.',3);
                throw new Exception("Request Invalid.", 1);
            }

            $customerId = $request->getRequest('id');
            if(!$customerId)
            {
                $this->getMessage()->addMessage('Unable to fetch ID.',3);
                throw new Exception("Unable to fetch ID.", 1);
            }

            $result = $customerModel->load($customerId);
            if(!$result)
            {
                $this->getMessage()->addMessage('Unable to Delete Record.',3);
                throw new Exception("Unable to Delete Record.", 1);
            }
            $result->delete();
            $this->getMessage()->addMessage('Data Deleted.');
            $this->redirect('grid','customer',[],true);
        } 
        catch (Exception $e) 
        {
            $this->redirect('grid','customer',[],true);
        }       
    }
}
