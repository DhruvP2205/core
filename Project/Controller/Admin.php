<?php Ccc::loadClass('Controller_Admin_Action');

class Controller_Admin extends Controller_Admin_Action
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
        $this->setTitle('Admin');
        $content = $this->getLayout()->getContent();
        $adminGrid = Ccc::getBlock('Admin_Index');
        $content->addChild($adminGrid);
        $this->renderLayout();
    }

    public function gridBlockAction()
    {
        $adminGrid = Ccc::getBlock('Admin_Grid')->toHtml();
        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#indexContent',
                    'content' => $adminGrid
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
        $adminModel = Ccc::getModel("Admin");
        Ccc::register('admin',$adminModel);

        $adminEdit = $this->getLayout()->getBlock('Admin_Edit')->toHtml();
        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
        
        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#indexContent',
                    'content' => $adminEdit
                ],
                [
                    'element' => '#adminMessage',
                    'content' => $messageBlock
                ]
            ]
        ];
        $this->renderJson($response);
    }

    public function saveAction()
    {
        try
        {
            $adminModel = Ccc::getModel('Admin');
            $request = $this->getRequest();

            if(!$request->isPost())
            {
                throw new Exception("Request Invalid.");
            }

            $postData = $request->getPost('admin');

            if(!$postData)
            {
                throw new Exception("Invalid data Posted.");
            }

            $admin = $adminModel;
            $admin->setData($postData);

            if(!($admin->adminId))
            {
                unset($admin->adminId);
                $admin->createdDate = date('y-m-d h:m:s');
                $admin->password = md5($admin->password);
            }
            else
            {
                if(!(int)$admin->adminId)
                {
                    throw new Exception("Invalid Request.");
                }
                $admin->updatedDate = date('y-m-d h:m:s');
            }
            $result = $admin->save();
            if(!$result)
            {
                throw new Exception("Unable to Save Record.");
            }
            $message = $this->getMessage()->addMessage('Your Data save Successfully');
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
            $this->setTitle('Edit Admin');
            $adminModel = Ccc::getModel('Admin');
            $request = $this->getRequest();
            $id = (int)$request->getRequest('id');

            if(!$id)
            {
                throw new Exception("Request Invalid.");
            }
            
            $admin = $adminModel->load($id);
            
            if(!$admin)
            {   
                throw new Exception("System is unable to find record.");
            }
            Ccc::register('admin',$admin);

            $adminEdit = Ccc::getBlock('Admin_Edit')->toHtml();
            $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
            $response = [
                'status' => 'success',
                'elements' => [
                    [
                        'element' => '#indexContent',
                        'content' => $adminEdit
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
            $adminModel = Ccc::getModel('Admin');
            $request = $this->getRequest();

            if(!$request->getRequest('id'))
            {
                throw new Exception("Request Invalid.");
            }

            $adminId = $request->getRequest('id');

            if(!$adminId)
            {
                throw new Exception("Unable to fetch ID.");
            }
            $result = $adminModel->load($adminId);
            if(!$result)
            {
                throw new Exception("Unable to Delete Record.");
            }
            $result->delete();
            $message = $this->getMessage()->addMessage('Data Deleted.');
            $this->gridBlockAction();
        } 
        catch (Exception $e)
        {
            $message = $this->getMessage()->addMessage($e->getMessage(),3);
            $this->gridBlockAction();
        }
    }
}
