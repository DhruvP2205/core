<?php
Ccc::loadClass('Controller_Core_Action');

class Controller_Salesman extends Controller_Core_Action
{
    public function gridAction()
    {
        Ccc::getBlock('Salesman_Grid')->toHtml();
    }

    public function addAction()
    {
        $salesmanModel = Ccc::getModel('Salesman');
        Ccc::getBlock('Salesman_Edit')->setData(['salesman'=>$salesmanModel])->toHtml();
    }

    public function saveAction()
    {
        try
        {
            $request=$this->getRequest();
            $salesmanModel= Ccc::getModel('Salesman');

            if(!$request->isPost())
            {
                throw new Exception("Request Invalid.",1);
            }

            $postData=$request->getPost('salesman');

            if(!$postData)
            {
                throw new Exception("Invalid data Posted.", 1);
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
                    throw new Exception("unable to Save Record.", 1);        
                }   
            }
            else
            {
                if(!(int)$salesman->salesmanId)
                {
                    throw new Exception("Invelid Request.",1);
                }
                $salesman->updatedDate = date('y-m-d h:m:s');
                $result=$salesman->save();
                if(!$result)
                {
                    throw new Exception("unable to uodate Record.", 1);
                }
            }
            $this->redirect($this->getView()->getUrl('grid','Salesman',[],true));
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            exit();
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
                throw new Exception("Invalid Request", 1);
            }
            
            $salesman = $salesmanModel->load($id);
            
            if(!$salesman)
            {   
                throw new Exception("System is unable to find record.", 1); 
            }
            Ccc::getBlock('Salesman_Edit')->setData(['salesman'=>$salesman])->toHtml();
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            exit();
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
                throw new Exception("Invalid Request.", 1);
            }

            $salesmanId = $request->getRequest('id');

            if(!$salesmanId)
            {
                throw new Exception("Unable to fetch ID.", 1);
                
            }
            $result = $salesmanModel->load($salesmanId)->delete();
            if(!$result)
            {
                throw new Exception("Unable to Delet Record.", 1);
                
            }
            $this->redirect($this->getView()->getUrl('grid','salesman',[],true));
        } 
        catch (Exception $e)
        {
            $this->redirect($this->getView()->getUrl('grid','salesman',[],true));
        }
    }
}

?>
