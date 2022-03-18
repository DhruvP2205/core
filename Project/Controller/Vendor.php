<?php Ccc::loadClass('Controller_Admin_Action');

class Controller_Vendor extends Controller_Admin_Action
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
        $this->setTitle('Vendor');
        $content = $this->getLayout()->getContent();
        $vendorGrid = Ccc::getBlock('Vendor_Grid');
        $content->addChild($vendorGrid,'Grid');
        $this->renderLayout();
    }

    public function addAction()
    {
        $this->setTitle('Add Vendor');
        $vendorModel = Ccc::getModel('Vendor'); 
        $addressModel = Ccc::getModel('Vendor_Address');
        $content = $this->getLayout()->getContent();
        $vendorAdd = Ccc::getBlock('Vendor_Edit')->setData(['vendor'=>$vendorModel,'address'=>$addressModel]);
        $content->addChild($vendorAdd,'Add');
        $this->renderLayout();
    }

    protected function saveVendor()
    {
        $vendorModel = Ccc::getModel('Vendor');
        $request = $this->getRequest();

        if(!$request->getPost('vendor'))
        {
            throw new Exception("Request Invalid.");
        }
        $postData = $request->getPost('vendor');
        if(!$postData)
        {
            throw new Exception("Invalid data Posted.");
        }

        $vendor = $vendorModel;
        $vendor->setData($postData);

        if(!$vendor->vendorId)
        {
            unset($vendor->vendorId);
            $vendor->createdDate = date('y-m-d h:m:s');
        }
        else
        {
            if(!(int)$vendor->vendorId)
            {
                throw new Exception("Invalid Request.");
            }
            $vendor->updatedDate = date('y-m-d h:i:s');
        }
        $result = $vendor->save();
        if(!$result->vendorId)
        {
            throw new Exception("Unable to Save Record.");
        }
        $this->getMessage()->addMessage('Your Data saved Successfully');
        return $result;
    }

    protected function saveAddress($vendor)
    {
        $address = $vendor->getAddress();
        $request = $this->getRequest();
        if(!$request->getPost('address'))
        {
            throw new Exception("Invalid Request.");
        }  

        $postData = $request->getPost('address');
        if(!$postData)
        {
            throw new Exception("Invalid data Posted.");
        }

        if(!$address->addressId)
        {
            unset($address->addressId);
        }

        $address->setData($postData);
        
        $address->vendorId = $vendor->vendorId;
        
        $result = $address->save();
        if(!$result->addressId)
        {
            throw new Exception("Unable to Save Record.");
        }
        $this->getMessage()->addMessage('Your Data saved Successfully');
    }


    public function saveAction()
    {
        try
        {
            $vendor = $this->saveVendor();
            $this->saveAddress($vendor);
            $this->redirect('grid','vendor',[],true);
        }
        catch (Exception $e) 
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->redirect('grid','vendor',[],true);
        }
    }

    public function editAction()
    {
        try
        {
            $this->setTitle('Edit Vendor');
            $vendorModel = Ccc::getModel('Vendor');
            $addressModel = Ccc::getModel('vendor_address');

            $request = $this->getRequest();
            $id = (int)$request->getRequest('id');
            if(!$id)
            {
                throw new Exception("Request Invalid.");
            }
            
            $vendor = $vendorModel->load($id);
            
            if(!$vendor)
            {   
                throw new Exception("System is unable to find record.");
            }

            $address = $addressModel->load($id,'vendorId');
            if(!$address)
            {
                $address = Ccc::getModel('Vendor_Address');   
            }

            $content = $this->getLayout()->getContent();
            $vendorEdit = Ccc::getBlock('Vendor_Edit')->setData(['vendor'=>$vendor,'address'=>$address]);
            $content->addChild($vendorEdit,'Edit');
            $this->renderLayout();
        }
        catch (Exception $e) 
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->redirect($this->getView()->getUrl('grid','vendor',[],true));
        }
    }

    public function deleteAction()
    {
        try 
        {
            $vendorModel = Ccc::getModel('Vendor');
            $request = $this->getRequest();
            if(!$request->getRequest('id'))
            {
                throw new Exception("Request Invalid.");
            }

            $vendorId = $request->getRequest('id');
            if(!$vendorId)
            {
                throw new Exception("Unable to fetch ID.");
            }
            $result = $vendorModel->load($vendorId);
            if(!$result)
            {
                throw new Exception("Unable to Delete Record.");
            }
            $result->delete();
            $this->getMessage()->addMessage('Data Deleted.');
            $this->redirect('grid','vendor',[],true);
        } 
        catch (Exception $e) 
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->redirect('grid','vendor',[],true);
        }       
    }
}
