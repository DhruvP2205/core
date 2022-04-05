<?php Ccc::loadClass('Block_Core_Edit_Tab');

class Block_Salesman_Edit_Tab extends Block_Core_Edit_Tab
{
    public function __construct()
    {
        parent::__construct();
        $this->setCurrentTab('salesman');
    }

    public function prepareTabs()
    {
        $this->addTab([
            'title' => 'Salesman Info',
            'block' => 'Salesman_Edit_Tabs_Salesman',
            'url' => $this->getUrl(null,null,['tab' => 'salesman'])
        ],'salesman');
    }
}
