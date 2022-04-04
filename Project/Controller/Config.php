<?php Ccc::loadClass('Controller_Admin_Action');

class Controller_Config extends Controller_Admin_Action
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
        $this->setTitle('Config');
        $content = $this->getLayout()->getContent();
        $configGrid = Ccc::getBlock('Config_Grid');
        $content->addChild($configGrid,'Grid');
        $this->renderLayout();
    }

    public function indexAction()
    {
        $this->setTitle('Config');
        $content = $this->getLayout()->getContent();
        $configGrid = Ccc::getBlock('Config_Index');
        $content->addChild($configGrid);
        $this->renderLayout();
    }

    public function gridBlockAction()
    {
        $configGrid = Ccc::getBlock('Config_Grid')->toHtml();
        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#indexContent',
                    'content' => $configGrid
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
        $configModel = Ccc::getModel("Config");
        Ccc::register('config',$configModel);

        $configEdit = $this->getLayout()->getBlock('Config_Edit')->toHtml();
        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
        
        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#indexContent',
                    'content' => $configEdit
                ],
                [
                    'element' => '#adminMessage',
                    'content' => $messageBlock
                ]
            ]
        ];
        $this->renderJson($response);
    }

    public function addAction()
    {
        $this->setTitle('Add Config');
        $configModel = Ccc::getModel('Config');
        $content = $this->getLayout()->getContent();
        $configAdd = Ccc::getBlock('Config_Edit');
        Ccc::register('config',$configModel);
        $content->addChild($configAdd,'Add');
        $this->renderContent();
    }

    public function saveAction()
    {
        try
        {
            $request = $this->getRequest();
            $configModel = Ccc::getModel('Config');
            if(!$request->isPost())
            {
                throw new Exception("Request Invalid.");
            }
            $postData = $request->getPost('config');
            if(!$postData)
            {
                throw new Exception("Invalid data Posted.");
            }
            $config = $configModel;
            $config->setData($postData);

            if(!($config->configId))
            {
                unset($config->configId);
                $config->createdDate = date('y-m-d h:m:s');  
            }
            else
            {
                if(!(int)$config->configId)
                {
                    throw new Exception("Invalid Request.");
                }
            }
            $result = $config->save();
            if(!$result)
            {
                throw new Exception("Unable to Save Record.");
            }
            $message = $this->getMessage()->addMessage('Your Data saveed Successfully.');
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
            $this->setTitle('Edit Config');
            $configModel = Ccc::getModel('config');
            $request = $this->getRequest();
            $id = (int)$request->getRequest('id');

            if(!$id)
            {
                throw new Exception("Request Invalid.");
            }
            
            $config = $configModel->load($id);
            
            if(!$config)
            {   
                throw new Exception("System is unable to find record.");
            }
            Ccc::register('config',$config);

            $configEdit = Ccc::getBlock('Config_Edit')->toHtml();
            $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
            $response = [
                'status' => 'success',
                'elements' => [
                    [
                        'element' => '#indexContent',
                        'content' => $configEdit
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
            $this->setTitle('Edit Config');
            $configModel = Ccc::getModel('Config');
            $request = $this->getRequest();
            $id = (int)$request->getRequest('id');
            if(!$id)
            {
                throw new Exception("Request Invalid.");
            }
            $config = $configModel->load($id);
            if(!$config)
            {
                throw new Exception("System is unable to find record."); 
            }
            $content = $this->getLayout()->getContent();
            $configEdit = Ccc::getBlock('Config_Edit');
            Ccc::register('config',$config);
            $content->addChild($configEdit,'Edit');
            $this->renderContent();
        }    
        catch (Exception $e) 
        {
            $message = $this->getMessage()->addMessage($e->getMessage(),3);
            echo $message->getMessages()['success'];
        }
    }


    public function deleteAction()
    {
        try
        {
            $configModel = Ccc::getModel('Config');
            $request = $this->getRequest();
            if(!$request->getRequest('id'))
            {
                throw new Exception("Request Invalid.");
            }
            
            $id = $request->getRequest('id');
            $result = $configModel->load($id);
            if(!$result)
            {
                throw new Exception("Unable to Delete Record.");
            }
            $result->delete();
            $message = $this->getMessage()->addMessage('Data Deleted.');
            $this->gridBlockAction();
        }
        catch(Exception $e)
        {
            $message = $this->getMessage()->addMessage($e->getMessage(),3);
            $this->gridBlockAction();
        }
    }
}
