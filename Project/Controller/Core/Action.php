<?php
Ccc::loadClass('Model_Core_View');

class Controller_Core_Action
{
    protected $view = null;
    protected $layout = null;
    
    public function getLayout()
    {
        if(!$this->layout)
        {
            $this->setLayout(Ccc::getBlock('Core_Layout'));
        }
        return $this->layout;
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
        return $this;
    }

    public function renderLayout()
    {
        return $this->getLayout()->toHtml();
    }

    public function getAdapter()
    {
        global $adapter;
        return $adapter;
    }

    public function getView()
    {
        if (!$this->view)
        {
            $this->setView(new Model_Core_View());
        }
        return $this->view;
    }

    public function setView($view)
    {
        $this->view = $view;
        return $this;
    }
    
    public function redirect($url)
    {
        header("Location: $url");
        exit();
    }

    public function getRequest()
    {
        return Ccc::getFront()->getRequest();
    }
}
?>
