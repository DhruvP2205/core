<?php Ccc::loadClass('Model_Core_Row');

class Model_Product_Media extends Model_Core_Row
{
    public function __construct()
    {
        $this->setResourceClassName('Product_Media_Resource');
        parent::__construct();
    }

    public function setProduct(Mode_Product $product)
    {
        $this->product = $product;
        return $this;
    }

    public function getProduct($reload = false)
    {
        $productModal = Ccc::getModel('Product');
        if(!$this->productId)
        {
            return null;
        }
        if($this->product && !$reload)
        {
            return $this->product;
        }

        $product = $productModal->fetchRow("SELECT * FROM `product` WHERE `productId` = {$this->productId}");
        if(!$product)
        {
            return $productModal;
        }
        $this->setProduct($product);
        return $this->product;
    }
}
