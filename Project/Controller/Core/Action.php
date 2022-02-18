<?php
    Ccc::loadClass('Model_Core_View');
    Ccc::loadClass('Model_Core_Request');

    class Controller_Core_Action
    {
        protected $view = null;

        public function getAdapter()
        {
            global $adapter;
            return $adapter;
        }

        public function redirect($url)
        {
            header("Location: $url");
            exit();
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

        public function getRequest()
        {
            return Ccc::getFront()->getRequest();
        }

        public function getUrl($a=null, $c=null, $data = [], $reset = false)
        {
            $urlData = [];
            if($c==null && $a==null && $data==null && $reset==false)
            {
                $urlData = $this->getRequest()->getRequest();
            }

            if($c == null)
            {
                $urlData['c'] = $this->getRequest()->getRequest('c');
            }
            else
            {
                $urlData['c'] = $c;
            }

            if($a == null)
            {
                $urlData['a'] = $this->getRequest()->getRequest('a');
            }
            else
            {
                $urlData['a'] = $a;
            }

            if($reset)
            {
                if($data)
                {
                    $urlData = array_merge($urlData,$data);
                }
            }

            else
            {
                $urlData = array_merge($this->getRequest()->getRequest(),$urlData);
                if($data)
                {
                    $urlData = array_merge($urlData,$data);
                }   
            }
            $url = "index.php?".http_build_query($urlData);
            print($url);
        }
    }
?>
