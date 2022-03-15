<?php Ccc::loadClass('Model_Core_Row');

class Model_Category_Media extends Model_Core_Row
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;
    const STATUS_DEFAULT = 1;
    const STATUS_ENABLED_LBL = 'Active';
    const STATUS_DISABLED_LBL = 'Inactive';
    
    public function __construct()
    {
        $this->setResourceClassName('Category_Media_Resource');
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
        return $statuses[self::STATUS_DEFAULT];
    }

    public function setCategory(Model_Category $category)
    {
        $this->category = $category;
        return $this;
    }

    public function getCategory($reload = false)
    {
        $categoryModal = Ccc::getModel('Category');
        if(!$this->categoryId)
        {
            return null;
        }
        if($this->category && !$reload)
        {
            return $this->category;
        }
        $category = $categoryModal->fetchRow("SELECT * FROM `category` WHERE `categoryId` = {$this->categoryId}");
        if(!$category)
        {
            return $categoryModal;
        }
        $this->setCategory($category);
        return $this->category;
    }
}
