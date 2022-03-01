<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php
class Block_Core_Layout extends Block_Core_Template
{
    protected $children = [];

    public function __construct()
    {
        $this->setTemplate("view/core/layout.php");
    }

    public function setChildren($children)
    {
        $this->children = $children;
        return $this;
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function setChiled($key,$value)
    {
        $this->children[$key] = $value;
        return $this;
    }

    public function getChild($key)
    {
        if(array_key_exists($key,$this->children)){
            return $this->children[$key];
        }
        return null;
    }

    public function removeChild($key)
    {
        if(array_key_exists($key,$this->children)){
            unset($this->children[$key]);
        }
        return $this;
    }

    public function getHeader()
    {
        $child = Ccc::getBlock('Core_Layout_Header');
        if(array_key_exists('header',$this->children)){
            $child = $this->getChild('header');
        }
        $this->children['header'] = $child;
        return $child;
    }

    public function getFooter()
    {
        $child = Ccc::getBlock('Core_Layout_Footer');
        if(array_key_exists('footer',$this->children)){
            $child = $this->getChild('footer');
        }
        $this->children['footer'] = $child;
        return $child;
    }

    public function getContent()
    {
        $child = Ccc::getBlock('Core_Layout_Content');
        if(array_key_exists('content',$this->children)){
            $child = $this->getChild('content');
        }
        $this->children['content'] = $child;
        return $child;
    }
}

?>
