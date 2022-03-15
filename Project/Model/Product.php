<?php Ccc::loadClass('Model_Core_Row');

class Model_Product extends Model_Core_Row
{
    protected $media = null;
    protected $thumbName = null;
    protected $smallName = null;
    protected $baseName = null;
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
        if(!$this->productId)
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

    public function setBase($baseName)
    {
        $this->baseName = $baseName;
        return $this;
    }


    public function getBase($reload = false)
    {
        $mediaModel = Ccc::getModel('Product_Media'); 
        if(!$this->base)
        {
            return null;
        }
        if($this->baseName && !$reload)
        {
            return $this->baseName;
        }
        $base = $mediaModel->fetchRow("SELECT * FROM `product_media` WHERE `mediaId` = {$this->base}");
        $baseName = $base->name;
        if(!$baseName)
        {
            return null;
        }
        $this->setBase($baseName);

        return $this->baseName;
    }
    
    public function setSmall($smallName)
    {
        $this->smallName =$smallName;
        return $this;
    }

    public function getSmall($reload = false)
    {
        $mediaModel = Ccc::getModel('Product_Media'); 
        if(!$this->small)
        {
            return null;
        }
        if($this->smallName && !$reload)
        {
            return $this->smallName;
        }
        $small = $mediaModel->fetchRow("SELECT * FROM `product_media` WHERE `mediaId` = {$this->small}");
        $smallName = $small->name;
        if(!$smallName)
        {
            return null;
        }
        $this->setSmall($smallName);

        return $this->smallName;
    }

    public function setThumb($thumbName)
    {
        $this->thumbName =$thumbName;
        return $this;
    }

    public function getThumb($reload = false)
    {
        $mediaModel = Ccc::getModel('Product_Media'); 
        if(!$this->thumb)
        {
            return null;
        }
        if($this->thumbName && !$reload)
        {
            return $this->thumbName;
        }
        $thumb = $mediaModel->fetchRow("SELECT * FROM `product_media` WHERE `mediaId` = {$this->thumb}");
        $thumbName = $thumb->name;
        if(!$thumbName)
        {
            return null;
        }
        $this->setThumb($thumbName);

        return $this->thumbName;
    }
}

