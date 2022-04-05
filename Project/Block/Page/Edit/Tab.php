<?php Ccc::loadClass('Block_Core_Edit_Tab');

class Block_Page_Edit_Tab extends Block_Core_Edit_Tab
{
    public function __construct()
    {
        parent::__construct();
        $this->setCurrentTab('page');
    }

    public function prepareTabs()
    {
        $this->addTab([
            'title' => 'Page Info',
            'block' => 'Page_Edit_Tabs_Page',
            'url' => $this->getUrl(null,null,['tab' => 'page'])
        ],'page');
    }
}
