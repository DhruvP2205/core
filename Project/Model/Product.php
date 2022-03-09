<?php Ccc::loadClass('Model_Core_Row');

class Model_Product extends Model_Core_Row
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;
    const STATUS_DISABLED_DEFAULT = 1;
    const STATUS_ENABLED_LBL = 'Active';
    const STATUS_DISABLED_LBL = 'Inactive';

    public function __construct()
    {
        $this->setResourceClassName('Product_Resource');
        parent::__construct();
    }

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

        if(array_key_exists($key, $statuses))
        {
            return $statuses[$key];
        }
        return self::STATUS_DISABLED_DEFAULT;
    }

    public function saveCategories(array $categoryIds)
    {
        $productCategoryModel = Ccc::getModel('Product_Category');
        $categoryProduct = $productCategoryModel->fetchAll("SELECT * FROM `category_product` WHERE `productId` = {$this->productId} ");
        
        foreach($categoryProduct as $category)
        {
            if(!in_array($category->categoryId, $categoryIds['exists']))
            {
                $productCategoryModel->load($category->entityId)->delete();
            }
        }

        foreach($categoryIds['new'] as $categoryId)
        {
            $productCategoryModel = Ccc::getModel('Product_Category');
            $productCategoryModel->productId = $this->productId;
            $productCategoryModel->categoryId = $categoryId;
            $productCategoryModel->save();
        }
    }
}

