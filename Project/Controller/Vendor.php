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

    public function indexAction()
    {
        $this->setTitle('Vendor');
        $content = $this->getLayout()->getContent();
        $vendorGrid = Ccc::getBlock('Vendor_Index');
        $content->addChild($vendorGrid);

        $this->renderLayout();
    }

    public function gridBlockAction()
    {
        $vendorGrid = Ccc::getBlock('Vendor_Grid')->toHtml();
        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#indexContent',
                    'content' => $vendorGrid
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
        $vendorModel = Ccc::getModel("Vendor");
        $vendorAddress = $vendorModel->getAddress();
        $vendor = $vendorModel;
        $address = $vendorModel;

        Ccc::register('vendor',$vendorModel);
        Ccc::register('address',$vendorModel);

        $vendorEdit = $this->getLayout()->getBlock('Vendor_Edit')->toHtml();

        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
        
        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#indexContent',
                    'content' => $vendorEdit
                ],
                [
                    'element' => '#adminMessage',
                    'content' => $messageBlock
                ]
            ]
        ];
        $this->renderJson($response);
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

    protected function saveAddress($vendor = null)
    {
        $request = $this->getRequest();
        if(!$vendor)
        {
            $vendorId = $request->getRequest('id');
            if(!$vendorId)
            {
                throw new Exception("First create vendor.");
            }
            $vendor = Ccc::getModel('vendor')->load($vendorId);
        }
        if(!$request->getPost())
        {
            throw new Exception("Invalid Request.");
        }
        $address = $vendor->getAddress();
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
            $request = $this->getRequest();
            if($request->getPost('vendor'))
            {
                $vendor = $this->saveVendor();
                if(!$vendor)
                {
                    throw new Exception("System is unable to Save.", 1);
                }
                $this->saveAddress($vendor);
            }
            if($request->getPost('address'))
            {
                $this->saveAddress();         
            }
            $message = $this->getMessage()->addMessage('Vendor Inserted succesfully.',1);
            $this->gridBlockAction();
        }
        catch (Exception $e) 
        {
            $message = $this->getMessage()->addMessage($e->getMessage(),3);
            $this->gridBlockAction();
        }
    }

    public function editBlockAction()
    {
        try
        {
            $vendorModel = Ccc::getModel('Vendor');
            $addressModel = Ccc::getModel('vendor_address');

            $request = $this->getRequest();
            $vendorId = $request->getRequest('id');
            if(!$vendorId)
            {
                throw new Exception("Error Processing Request");         
            }
            if(!(int)$vendorId)
            {
                throw new Exception("Error Processing Request", 1);         
            }
            $vendor = $vendorModel->load($vendorId);
            if(!$vendor)
            {
                throw new Exception("Error Processing Request", 1);         
            }
            $address = $vendor->getAddress();

            Ccc::register('vendor',$vendor);
            Ccc::register('address',$address);

            $vendorEdit = Ccc::getBlock('vendor_Edit')->toHtml();
            $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
            $response = [
                'status' => 'success',
                'elements' => [
                    [
                        'element' => '#indexContent',
                        'content' => $vendorEdit
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
