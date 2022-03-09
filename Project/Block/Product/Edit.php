<?php
Ccc::loadClass('Block_Core_Template');
class Block_Product_Edit extends Block_Core_Template   
{ 
	public function __construct()
	{
		$this->setTemplate('view/product/edit.php');
	}

	public function getProduct()
	{
		return $this->getData('product');
	}

    public function getCategories()
    {
        $category = Ccc::getModel('Category');
        $categories = $category->fetchAll("SELECT * FROM `category` WHERE `status` = 1");
        if(!$categories)
        {
            return null;
        }
        return $categories;
    }

    public function getPath($categoryId,$path)
    {
        $finalPath = NULL;
        $path = explode("/",$path);
        foreach ($path as $path1)
         {
            $categoryModel = Ccc::getModel('Category');
            $category = $categoryModel->fetchRow("SELECT * FROM `category` WHERE `categoryId` = '$path1' ");
            if($path1 != $categoryId)
            {
                $finalPath .= $category->name ."=>";
            }
            else
            {
                $finalPath .= $category->name;
            }
        }
        return $finalPath;
    }

    public function selected($categoryId)
    {
        $request = Ccc::getFront()->getRequest();
        $productId = $request->getRequest('id');
        $categoryProductModel = Ccc::getModel('Product_Category');
        $select = $categoryProductModel->fetchAll("SELECT * FROM `category_product` WHERE `productId` = '$productId' AND `categoryId` = '$categoryId'");
        if($select)
        {
            return 'checked';
        }
        return null;
    }

   	const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;
    const STATUS_DEFAULT = 1;
    const STATUS_ENABLED_LBL = 'Active';
    const STATUS_DISABLED_LBL = 'Inactive';
    public function getStatus($key = null)
    {
        $statuses = [
            self::STATUS_ENABLED => self::STATUS_ENABLED_LBL,
            self::STATUS_DISABLED => self::STATUS_DISABLED_LBL
        ];
        if(!$key)
        {
            return $statuses;
        }

        if(array_key_exists($key, $statuses)) {
            return $statuses[$key];
        }
        return $statuses[self::STATUS_DEFAULT];
    }
}

?>
