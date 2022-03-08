<?php Ccc::loadClass('Model_Core_Row');

class Model_Product_Category extends Model_Core_Row
{
    public function __construct()
    {
        $this->setResourceClassName('Product_Category_Resource');
        parent::__construct();
    }
}

?>
