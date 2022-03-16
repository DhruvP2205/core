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
            $this->getMessage()->addMessage('Request Invalid.',3);
            throw new Exception("Request Invalid.", 1);
        }
        $postData = $request->getPost('vendor');
        if(!$postData)
        {
            $this->getMessage()->addMessage('Invalid data Posted.',3);
            throw new Exception("Invalid data Posted.", 1);
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
                $this->getMessage()->addMessage('Invalid Request.',3);
                throw new Exception("Invalid Request.", 1);
            }
            $vendor->updatedDate = date('y-m-d h:i:s');
        }
        $result = $vendor->save();
        if(!$result->vendorId)
        {
            $this->getMessage()->addMessage('Unable to Save Record.',3);
            throw new Exception("Unable to Save Record.", 1);
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
            $this->getMessage()->addMessage('Request Invalid.',3);
            throw new Exception("Invalid Request.", 1);
        }  

        $postData = $request->getPost('address');
        if(!$postData)
        {
            $this->getMessage()->addMessage('Invalid data Posted.',3);
            throw new Exception("Invalid data Posted.", 1);
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
            $this->getMessage()->addMessage('Unable to Save Record.',3);
            throw new Exception("Unable to Save Record.", 1);
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
                $this->getMessage()->addMessage('Request Invalid.',3);
                throw new Exception("Request Invalid.", 1);
            }
            
            $vendor = $vendorModel->load($id);
            
            if(!$vendor)
            {   
                $this->getMessage()->addMessage('System is unable to find record.',3);
                throw new Exception("System is unable to find record.", 1);
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
                $this->getMessage()->addMessage('Request Invalid.',3);
                throw new Exception("Request Invalid.", 1);
            }

            $vendorId = $request->getRequest('id');
            if(!$vendorId)
            {
                $this->getMessage()->addMessage('Unable to fetch ID.',3);
                throw new Exception("Unable to fetch ID.", 1);
            }
            $result = $vendorModel->load($vendorId);
            if(!$result)
            {
                $this->getMessage()->addMessage('Unable to Delete Record.',3);
                throw new Exception("Unable to Delete Record.", 1);
            }
            $result->delete();
            $this->getMessage()->addMessage('Data Deleted.');
            $this->redirect('grid','vendor',[],true);
        } 
        catch (Exception $e) 
        {
            $this->redirect('grid','vendor',[],true);
        }       
    }
}
