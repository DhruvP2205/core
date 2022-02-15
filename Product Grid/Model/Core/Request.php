<?php 

class Model_Core_Request
{
    public function getPost($key = null,$value = null)
    {
        if($key == null && $value == null)
        {   
            //return $_POST;
            print_r($_POST);
        }
        elseif($key == null && $value!=null)
        {
            return $_POST[$value];
        }
        else
        {
            if(array_key_exists($key, $_POST))
            {
                return $_POST[$key];
            }
        }
    }
    
    public function getRequest($key,$value)
    {
        
    }

    public function ispost()
    {
        if($SERVER['SERVER_REQUEST'] == 'POST')
        {
            return true;
        }
        return false;
    }

    public function getActionName()
    {
        $actionName = (isset($_GET['a'])) ? $_GET['a'] : 'error';
        return $actionName;
    }

    public function getControllerName()
    {
        $controllerName = (isset($_GET['c'])) ? ucfirst($_GET['c']) : 'Customer';
        return $controllerName;
    }
}

?>
