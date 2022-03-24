<?php Ccc::loadClass('Model_Core_Row');

class Model_Product extends Model_Core_Row
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;
    const STATUS_DISABLED_DEFAULT = 1;
    const STATUS_ENABLED_LBL = 'Active';
    const STATUS_DISABLED_LBL = 'Inactive';

    protected $media = null;

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
        if(!$categoryIds || !array_key_exists('exists', $categoryIds))
        {
            $categoryIds['exists'] = [];
        }

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

    public function setMedia($media)
    {
        $this->media = $media;
        return $this;
    }

    public function getMedia($reload = false)
    {
        $mediaModel = Ccc::getModel('Product_Media');
        if(!$this->media)
        {
            return $mediaModel;
        }
        if($this->media && !$reload)
        {
            return $this->media;
        }

        $media = $mediaModel->fetchRow("SELECT * FROM `product_media` WHERE `productId` = {$this->productId}");
        if(!$media)
        {
            return $mediaModel;
        }
        $this->setMedia($media);
        return $this->media;
    }

    public function setBase($base)
    {
        $this->base = $base;
        return $this;
    }

    public function getBase()
    {
        $mediaModel = Ccc::getModel('Product_Media'); 
        if(!$this->base)
        {
            return $mediaModel;
        }
        $base = $mediaModel->fetchRow("SELECT * FROM `product_media` WHERE `mediaId` = {$this->base}");
        if(!$base)
        {
            return $mediaModel;
        }
        return $base;
    }
    
    public function setSmall($small)
    {
        $this->small = $small;
        return $this;
    }

    public function getSmall()
    {
        $mediaModel = Ccc::getModel('Product_Media'); 
        if(!$this->small)
        {
            return $mediaModel;
        }
        $small = $mediaModel->fetchRow("SELECT * FROM `product_media` WHERE `mediaId` = {$this->small}");
        if(!$small)
        {
            return $mediaModel;
        }
        return $small;
    }

    public function setThumb($thumb)
    {
        $this->thumb = $thumb;
        return $this;
    }

    public function getThumb()
    {
        $mediaModel = Ccc::getModel('Product_Media'); 
        if(!$this->thumb)
        {
            return $mediaModel;
        }
        $thumb = $mediaModel->fetchRow("SELECT * FROM `product_media` WHERE `mediaId` = {$this->thumb}");
        if(!$thumb)
        {
            return $mediaModel;
        }
        return $thumb;
    }
}
