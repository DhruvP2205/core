<?php Ccc::loadClass('Block_Core_Edit_Tab');

class Block_Config_Edit_Tab extends Block_Core_Edit_Tab
{
    public function __construct()
    {
        parent::__construct();
        $this->setCurrentTab('config');
    }

    public function prepareTabs()
    {
        $this->addTab([
            'title' => 'Config Info',
            'block' => 'Config_Edit_Tabs_Config',
            'url' => $this->getUrl(null,null,['tab' => 'config'])
        ],'config');
    }
}
