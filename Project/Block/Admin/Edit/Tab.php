<?php Ccc::loadClass('Block_Core_Template');

class Block_Admin_Edit_Tab extends Block_Core_Template   
{
    protected $tabs = [];

    public function __construct()
    {
        $this->setTemplate('view/admin/edit/tab.php');
        $this->addTab([
            'title' => 'Personal Info',
            'block' => 'Admin_Edit_Tabs_Personal',
            'url' => $this->getUrl(null,null,['tab' => 'personal'])
        ],'personal');
    }

    /*public function setTabs($tabs)
    {
        $this->tabs = $tabs;
        return $this;
    }*/

    public function getTabs()
    {
        return $this->tabs;
    }

    public function addTab($tab, $key)
    {
        $this->tabs[$key] = $tab;
        return $this;
    }

    public function getTab($key)
    {
        if(array_key_exists($key,$this->tabs))
        {
            return $this->tabs[$key];
        }
        return null;

    }
    public function removeTab($tab)
    {
        if(array_key_exists($key,$this->tabs))
        {
            unset($this->tabs[$key]);
        }
        return $this;
    }
}
