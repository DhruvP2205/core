<?php
Ccc::loadClass('Controller_Core_Action');

class Controller_Salesman extends Controller_Core_Action
{
    public function gridAction()
    {
        $content = $this->getLayout()->getContent();
        $salesmanGrid = Ccc::getBlock('Salesman_Grid');
        $content->addChild($salesmanGrid,'Grid');
        $this->renderLayout();
    }

    public function addAction()
    {
        $salesmanModel = Ccc::getModel('Salesman');
        $content = $this->getLayout()->getContent();
        $salesmanAdd = Ccc::getBlock('Salesman_Edit')->setData(['salesman'=>$salesmanModel]);
        $content->addChild($salesmanAdd,'Add');
        $this->renderLayout();
    }

    public function saveAction()
    {
        try
        {
            $request=$this->getRequest();
            $salesmanModel= Ccc::getModel('Salesman');

            if(!$request->isPost())
            {
                $this->getMessage()->addMessage('Request Invalid.',3);
            }

            $postData=$request->getPost('salesman');

            if(!$postData)
            {
                $this->getMessage()->addMessage('Invalid data Posted.',3);
            }

            $salesman = $salesmanModel;
            $salesman->setData($postData);

            if(!($salesman->salesmanId))
            {
                unset($salesman->salesmanId);
                $salesman->createdDate = date('y-m-d h:m:s');
                $result=$salesman->save();
                if(!$result)
                {
                    $this->getMessage()->addMessage('Unable to Save Record.',3);        
                }
                $this->getMessage()->addMessage('Your Data save Successfully');
            }
            else
            {
                if(!(int)$salesman->salesmanId)
                {
                    $this->getMessage()->addMessage('Invalid Request.',3);
                }
                $salesman->updatedDate = date('y-m-d h:m:s');
                $result=$salesman->save();
                if(!$result)
                {
                    $this->getMessage()->addMessage('Unable to Update Record.',3);
                }
                $this->getMessage()->addMessage('Your Data Update Successfully');
            }
            $this->redirect($this->getView()->getUrl('grid','Salesman',[],true));
        }
        catch (Exception $e)
        {
            $this->redirect($this->getView()->getUrl('grid','Salesman',[],true));
        }
    }

    public function editAction()
    {
        try
        {
            $salesmanModel = Ccc::getModel('Salesman');
            $request = $this->getRequest();
            $id = (int)$request->getRequest('id');

            if(!$id)
            {
                $this->getMessage()->addMessage('Request Invalid.',3);
            }
            
            $salesman = $salesmanModel->load($id);
            
            if(!$salesman)
            {   
                $this->getMessage()->addMessage('System is unable to find record.',3); 
            }

            $content = $this->getLayout()->getContent();
            $salesmanEdit = Ccc::getBlock('Salesman_Edit')->setData(['salesman'=>$salesman]);
            $content->addChild($salesmanEdit,'Edit');
            $this->renderLayout();
        }
        catch (Exception $e)
        {
            $this->redirect($this->getView()->getUrl('grid','salesman',[],true));
        }
    }


    public function deleteAction()
    {
        try 
        {
            $salesmanModel = Ccc::getModel('Salesman');
            $request = $this->getRequest();

            if(!$request->getRequest('id'))
            {
                $this->getMessage()->addMessage('Request Invalid.',3);
            }

            $salesmanId = $request->getRequest('id');

            if(!$salesmanId)
            {
                $this->getMessage()->addMessage('Unable to fetch ID.',3);
            }
            $result = $salesmanModel->load($salesmanId)->delete();
            if(!$result)
            {
                $this->getMessage()->addMessage('Unable to Delete Record.',3);
            }
            $this->getMessage()->addMessage('Data Deleted.');
            $this->redirect($this->getView()->getUrl('grid','salesman',[],true));
        } 
        catch (Exception $e)
        {
            $this->redirect($this->getView()->getUrl('grid','salesman',[],true));
        }
    }
}

?>
