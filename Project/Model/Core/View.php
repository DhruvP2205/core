<?php 
class Model_Core_View
{
    public $template = null;
    public $data = [];

    public function getTemplate()
    {
        return $this->template;
    }

    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }

    public function toHtml()
    {
        $data = $this->data;
        require($this->getTemplate());
    }

    public function getData($key = null)
    {
        if(!$key)
        {
            return $this->data;
        }
        if(array_key_exists($key,$this->data))
        {
            return $this->data[$key];
        }
        return null;
    }

    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }

    public function addData($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }

    public function removeData($key)
    {
        if(array_key_exists($key,$this->data))
        {
            unset($this->data[$key]);
        }
        return $this;
    }

    public function getUrl($a=null, $c=null, array $data = [], $reset = false)
    {
        $url = [];

        if($c==null && $a==null && $data==null && $reset==false)
        {
            $url = Ccc::getFront()->getRequest()->getRequest();
        }
        
        if($c == null)
        {
            $url['c'] = Ccc::getFront()->getRequest()->getRequest('c');
        }
        else
        {
            $url['c'] = $c;
        }

        if($a == null)
        {
            $url['a'] = Ccc::getFront()->getRequest()->getRequest('a');
        }
        else
        {
            $url['a'] = $a;
        }
        
        if($reset)
        {
            if($data)
            {
                $url = array_merge($url, $data);
            }
        }
        else
        {
            $url = array_merge(Ccc::getFront()->getRequest()->getRequest(),$url);
            if($data)
            {
                $url = array_merge($url, $data);
            }   
        }
        $finalUrl = "index.php?".http_build_query($url);
        return $finalUrl;
    }
    
    
    public function getBaseUrl($subUrl = null)
    {
        $url = "C:/xampp/htdocs/phpwork/admin-login/core/Project/";
        if($subUrl)
        {
            $url = $url."/".$subUrl;
        }
        return $url;
    }
}
