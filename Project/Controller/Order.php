<?php Ccc::loadClass("Controller_Admin_Action");

class Controller_Order extends Controller_Admin_Action
{
    public function __construct()
    {
        if(!$this->authentication())
        {
            $this->redirect('login','Admin_login');
        }
    }

    public function gridBlockAction()
    {
        $orderGrid = Ccc::getBlock('Order_Grid')->toHtml();
        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#indexContent',
                    'content' => $orderGrid,
                    ],
                [
                    'element' => '#adminMessage',
                    'content' => $messageBlock
                ]
            ]
        ];
        $this->renderJson($response);
    }

    public function editBlockAction()
    {
        try
        {
            $orderModel = Ccc::getModel("Order");
            $request = $this->getRequest();
            $orderId = $request->getRequest('id');
            if(!$orderId)
            {
                throw new Exception('Invalid Request', 1);          
            }
            if(!(int)$orderId)
            {
                throw new Exception('Invalid Request', 1);
            }
            $order = $orderModel->load($orderId);
            if(!$order)
            {
                throw new Exception('Invalid Request', 1);
            }
    
            Ccc::register('order',$order);

            $orderEdit = Ccc::getBlock('Order_Edit')->toHtml();
            $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
            $response = [
                'status' => 'success',
                'elements' => [
                    [
                        'element' => '#indexContent',
                        'content' => $orderEdit,
                        ],
                    [
                        'element' => '#adminMessage',
                        'content' => $messageBlock
                    ]
                ]
            ];
            $this->getMessage()->addMessage('Order status changed.');
            $this->renderJson($response);
        }catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->gridBlockAction();
        }
    }

    public function statusUpdateAction()
    {
        try
        {
            $request = $this->getRequest();
            $orderId = $request->getRequest('id');
            $order = Ccc::getModel('Order')->load($orderId);
            $comment = $order->getComment();
            $postData = $request->getPost('order');
            $order->status = $postData['status'];
            $order->state = $postData['state'];
            $result = $order->save();
            if(!$result)
            {
                throw new Exception("Status Not Updated.", 1);
            }
            $comment->setData($postData);
            $comment->orderId = $orderId;
            unset($comment->state);
            $success = $comment->save();
            if(!$success)
            {
                throw new Exception("Comment Not Saved", 1);
            }
            $this->editBlockAction();
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->editBlockAction();
        }
    }
}
