<?php Ccc::loadClass('Block_Core_Grid');
Ccc::loadClass('Block_Customer_Grid_Collection'); 

class Block_Customer_Grid extends Block_Core_Grid
{
    public function __construct()
    {
        parent::__construct();
    }
}
