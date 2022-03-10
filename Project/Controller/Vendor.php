<?php Ccc::loadClass('Controller_Admin_Action');

class Controller_Vendor extends Controller_Admin_Action
{
    public function gridAction()
    {
        $content = $this->getLayout()->getContent();
        $vendorGrid = Ccc::getBlock('Vendor_Grid');
        $content->addChild($vendorGrid,'Grid');
        $this->renderLayout();
    }

    public function addAction()
    {
        $vendorModel = Ccc::getModel('Vendor'); 
        $addressModel = Ccc::getModel('Vendor_Address');
        $content = $this->getLayout()->getContent();
        $vendorAdd = Ccc::getBlock('Vendor_Edit')->setData(['vendor'=>$vendorModel,'address'=>$addressModel]);
        $content->addChild($vendorAdd,'Add');
        $this->renderLayout();
    }

    public function editAction()
    {
        try
        {
            $vendorModel = Ccc::getModel('Vendor');
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
            $addressModel = Ccc::getModel('Vendor_Address');
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
            $result = $vendorModel->load($vendorId)->delete();
            if(!$result)
            {
                $this->getMessage()->addMessage('Unable to Delete Record.',3);
                throw new Exception("Unable to Delete Record.", 1);
            }
            $this->getMessage()->addMessage('Data Deleted.');
            $this->redirect('grid','vendor',[],true);
        } 
        catch (Exception $e) 
        {
            $this->redirect('grid','vendor',[],true);
        }       
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
            $insert = $vendor->save();
            if(!$insert->vendorId)
            {
                $this->getMessage()->addMessage('Unable to Save Record.',3);
                throw new Exception("Unable to Save Record.", 1);
            }
            $this->getMessage()->addMessage('Your Data save Successfully');
            return $insert->vendorId;
        }
        else
        {
            if(!(int)$vendor->vendorId)
            {
                $this->getMessage()->addMessage('Invalid Request.',3);
                throw new Exception("Invalid Request.", 1);
            }
            $vendor->updatedDate = date('y-m-d h:i:s');
            $update = $vendor->save();
            if(!$update)
            {
                $this->getMessage()->addMessage('Unable to Update Record.',3);
                throw new Exception("Unable to Update Record.", 1);
            }
            $this->getMessage()->addMessage('Your Data Update Successfully');
            return $update->vendorId;
        } 
    }


    protected function saveAddress($vendorId)
    {

        $addressModel = Ccc::getModel('Vendor_Address');
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
        
        if($address->addressId == null)
        {   
            $address->vendorId = $vendorId;
            unset($address->addressId);
            $insert = $address->save();
            if(!$insert)
            {
                $this->getMessage()->addMessage('Unable to Save Record.',3);
                throw new Exception("Unable to Save Record.", 1);
            }
            $this->getMessage()->addMessage('Your Data save Successfully');
        }
        else
        {
            $update = $address->save();
            if(!$update)
            {
                $this->getMessage()->addMessage('Unable to Update Record.',3);
                throw new Exception("Unable to Update Record.", 1);
            }
            $this->getMessage()->addMessage('Your Data Update Successfully');
        }
    }


    public function saveAction()
    {
        try
        {
            $vendorId = $this->saveVendor();
            $request = $this->getRequest();
            $postData = $request->getPost('address');
            if(!$postData['zipCode'])
            {
                $this->redirect('grid','vendor',[],true);
            }

            $this->saveAddress($vendorId);

            $this->redirect('grid','vendor',[],true);
        }
        catch (Exception $e) 
        {
            $this->redirect('grid','vendor',[],true);
        }
    }
}
