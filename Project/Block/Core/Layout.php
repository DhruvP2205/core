<?php Ccc::loadClass('Block_Core_Template'); 

class Block_Core_Layout extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate("view/core/layout.php");
    }

    public function getHead()
    {
        $child = Ccc::getBlock('Core_Layout_Head');
        if(array_key_exists('head',$this->children))
        {
            $child = $this->getChild('head');
        }
        $this->children['head'] = $child;
        return $child;
    }

    public function getHeader()
    {
        $child = Ccc::getBlock('Core_Layout_Header');
        if(array_key_exists('header',$this->children))
        {
            $child = $this->getChild('header');
        }
        $this->children['header'] = $child;
        return $child;
    }

    public function getFooter()
    {
        $child = Ccc::getBlock('Core_Layout_Footer');
        if(array_key_exists('footer',$this->children))
        {
            $child = $this->getChild('footer');
        }
        $this->children['footer'] = $child;
        return $child;
    }

    public function getContent()
    {
        $child = Ccc::getBlock('Core_Layout_Content');
        if(array_key_exists('content',$this->children))
        {
            $child = $this->getChild('content');
        }
        $this->children['content'] = $child;
        return $child;
    }
}
