<?php Ccc::loadClass("Block_Core_Template");

class Block_Product_Media_Grid extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate("view/product/media/grid.php");
    }

    public function getMedias()
    {
        $mediaModel = Ccc::getModel('Product_Media');
        $request = Ccc::getFront()->getRequest();
        $productId = $request->getRequest('id');
        $medias = $mediaModel->fetchAll("SELECT * FROM `product_media` WHERE `productId` = {$productId}");
        return $medias;
    }
    
    public function selected($mediaId,$column)
    {
        $productModel = Ccc::getModel('Product');
        $request = Ccc::getFront()->getRequest();
        $productId = $request->getRequest('id');
        $select = $productModel->fetchAll("SELECT * FROM `product` WHERE {$column} = {$mediaId}");
        if($select)
        {
            return 'checked';
        }
    }
}
