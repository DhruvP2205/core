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
        $content = $this->getLayout()->getContent();
        $customerGrid = Ccc::getBlock('Customer_Grid');
        $content->addChild($customerGrid,'Grid');
        $this->renderLayout();
    }

    public function addAction()
    {
        $customerModel = Ccc::getModel('Customer'); 
        $addressModel = Ccc::getModel('Customer_Address');
        $content = $this->getLayout()->getContent();
        $customerAdd = Ccc::getBlock('Customer_Edit')->setData(['customer'=>$customerModel,'address'=>$addressModel]);
        $content->addChild($customerAdd,'Add');
        $this->renderLayout();
    }

    public function editAction()
    {
        try
        {
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
            $addressModel = Ccc::getModel('Customer_Address');
            $address = $addressModel->load($id,'customerId');
            if(!$address)
            {
                $address = Ccc::getModel('Customer_Address');
            }

            $content = $this->getLayout()->getContent();
            $customerEdit = Ccc::getBlock('Customer_Edit')->setData(['customer'=>$customer,'address'=>$address]);
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

            $result = $customerModel->load($customerId)->delete();
            if(!$result)
            {
                $this->getMessage()->addMessage('Unable to Delete Record.',3);
                throw new Exception("Unable to Delete Record.", 1);
            }
            $this->getMessage()->addMessage('Data Deleted.');
            $this->redirect('grid','customer',[],true);
        } 
        catch (Exception $e) 
        {
            $this->redirect('grid','customer',[],true);
        }       
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


    protected function saveAddress($customerId)
    {
        $addressModel = Ccc::getModel('Customer_Address');
        $request = $this->getRequest();
        if(!$request->getPost('address'))
        {
            $this->getMessage()->addMessage('Request Invalid.',3);
            throw new Exception("Invalid Request.", 1);
        }   
        $postData = $request->getPost('address');
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
        else
        {
            $address->billingAddress = (!array_key_exists('billingAddress',$postData))?2:1;
            $address->shipingAddress = (!array_key_exists('shipingAddress',$postData))?2:1;
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
            $request = $this->getRequest();
            $postData = $request->getPost('address');
            if(!$postData['zipCode'])
            {
                $this->redirect('grid','customer',[],true);
            }
            $this->saveAddress($customerId);
            $this->redirect('grid','customer',[],true);
        }
        catch (Exception $e) 
        {
            $this->redirect('grid','customer',[],true);
        }
    }
}
