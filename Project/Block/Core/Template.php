<?php
Ccc::loadClass('Model_Core_View');
class Block_Core_Template extends Model_Core_View   
{ 
    protected $children = [];

    public function getChildren()
    {
        return $this->children;
    }
    public function setChildren($children)
    {
        $this->children=$children;
        return $this;
    }

    public function addChild($object,$key=null)
    {
        if(!$key)
        {
            $key = get_class($object);
        }
        $this->children[$key] = $object;
        return $this;
    }

    public function getChild($key)
    {
        if(array_key_exists($key,$this->children))
        {
            return $this->children[$key];
        }
        return null;

    }
    public function removeChild($key)
    {
        if(array_key_exists($key,$this->children))
        {
            unset($this->children[$key]);
        }
        return $this;
    }
}




