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

        $media = $mediaModel->fetchAll("SELECT * FROM `product_media` WHERE `productId` = {$this->productId}");
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
            return null;
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
            return null;
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
            return null;
        }
        $thumb = $mediaModel->fetchRow("SELECT * FROM `product_media` WHERE `mediaId` = {$this->thumb}");
        if(!$thumb)
        {
            return $mediaModel;
        }
        return $thumb;
    }

    public function saveCategories(array $categoryIds)
    {
        $categoryProductModel = Ccc::getModel('Product_Category');
        $categoryProduct = $categoryProductModel->fetchAll("SELECT * FROM `category_product` WHERE `productId` = '$this->productId' "); 
        
        foreach($categoryProduct as $category)
        {
            if(!in_array($category->categoryId, $categoryIds['exists']))
            {
                $categoryProductModel->load($category->entityId)->delete();
            }
        }
        if(array_key_exists('new',$categoryIds))
        {
            foreach($categoryIds['new'] as $categoryId)
            {
                $categoryProductModel = Ccc::getModel('Product_Category');
                $categoryProductModel->productId = $this->productId;
                $categoryProductModel->categoryId = $categoryId;
                $categoryProductModel->save();
            }
        }
    }
}
