<?php Ccc::loadClass('Controller_Admin_Action');

class Controller_Page extends Controller_Admin_Action
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
        $this->setTitle('Page');
        $content = $this->getLayout()->getContent();
        $pageGrid = Ccc::getBlock('Page_Grid');
        $content->addChild($pageGrid,'Grid');
        $this->renderLayout();
    }

    public function indexAction()
    {
        $this->setTitle('Page');
        $content = $this->getLayout()->getContent();
        $pageGrid = Ccc::getBlock('Page_Index');
        $content->addChild($pageGrid);
        $this->renderLayout();
    }

    public function gridBlockAction()
    {
        $pageGrid = Ccc::getBlock('Page_Grid')->toHtml();
        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#indexContent',
                    'content' => $pageGrid
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
        $pageModel = Ccc::getModel("Page");
        Ccc::register('page',$pageModel);

        $pageEdit = $this->getLayout()->getBlock('Page_Edit')->toHtml();
        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
        
        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#indexContent',
                    'content' => $pageEdit
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
        $this->setTitle('Add Page');
        $pageModel = Ccc::getModel('Page');
        $content = $this->getLayout()->getContent();
        $pageAdd = Ccc::getBlock('Page_Edit')->setData(['page'=>$pageModel]);
        $content->addChild($pageAdd,'Add');
        $this->renderLayout();
    }

    public function saveAction()
    {
        try
        {
            $pageModel = Ccc::getModel('Page');
            $request = $this->getRequest();

            if(!$request->isPost())
            {
                throw new Exception("Request Invalid.");
            }

            $postData = $request->getPost('page');

            if(!$postData)
            {
                throw new Exception("Invalid data Posted.");
            }

            $page = $pageModel;
            $page->setData($postData);

            if(!($page->pageId))
            {
                unset($page->pageId);
                $page->createdDate = date('y-m-d h:m:s'); 
            }
            else
            {
                if(!(int)$page->pageId)
                {
                    throw new Exception("Invalid Request.");
                }
                $page->updatedDate = date('y-m-d h:m:s');
            }
            $result = $page->save();

            if(!$result)
            {
                throw new Exception("Unable to Save Record.");
            } 
            $this->getMessage()->addMessage('Your Data saved Successfully.');
            $this->gridBlockAction();
        } 
        catch (Exception $e) 
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->gridBlockAction();
        }
    }

    public function editBlockAction()
    {
        try
        {
            $this->setTitle('Edit Page');
            $pageModel = Ccc::getModel('Page');
            $request = $this->getRequest();
            $id = (int)$request->getRequest('id');

            if(!$id)
            {
                throw new Exception("Request Invalid.");
            }
            
            $page = $pageModel->load($id);
            
            if(!$page)
            {   
                throw new Exception("System is unable to find record.");
            }
            Ccc::register('page',$page);

            $pageEdit = Ccc::getBlock('Page_Edit')->toHtml();
            $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
            $response = [
                'status' => 'success',
                'elements' => [
                    [
                        'element' => '#indexContent',
                        'content' => $pageEdit
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
            $this->setTitle('Edit Page');
            $pageModel = Ccc::getModel('Page');
            $request = $this->getRequest();
            
            $id = (int)$request->getRequest('id');
            if(!$id)
            {
                throw new Exception("Request Invalid.");
            }
            
            $page = $pageModel->load($id);
            if(!$page)
            {
                throw new Exception("System is unable to find record.");
            }

            $content = $this->getLayout()->getContent();
            $pageEdit = Ccc::getBlock('Page_Edit')->setData(['page'=>$page]);
            $content->addChild($pageEdit,'Edit');
            $this->renderLayout();
        }    
        catch (Exception $e) 
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->redirect('grid','page',[],true);
        }
    }

    public function deleteAction()
    {
        try
        {
            $pageModel = Ccc::getModel('Page');
            $request = $this->getRequest();

            $deleteId = $request->getPost('page');
            if($deleteId)
            {
                foreach ($deleteId as $id)
                {
                    $result = $pageModel->load($id);
                    if(!$result)
                    {
                        throw new Exception("Unable to Save");
                    }
                    $result->delete();
                }
                $this->getMessage()->addMessage('Data deleted.');
                $this->redirect('grid','page',[],true);
            }

            if(!$request->getRequest('id'))
            {
                throw new Exception("Request Invalid.");
            }

            $id = $request->getRequest('id');
            if(!$id)
            {
                throw new Exception("Unable to fetch ID.");
            }

            $result = $pageModel->load($id);
            if(!$result)
            {
                throw new Exception("Unable to Delete Record.");
            }
            $result->delete();
            $this->getMessage()->addMessage('Data Deleted.');
            $this->gridBlockAction();
        }
        catch(Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->gridBlockAction();
        }
    }
}
