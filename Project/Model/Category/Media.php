<?php Ccc::loadClass('Model_Core_Row');

class Model_Category_Media extends Model_Core_Row
{
    protected $mediaPath = 'Media/Category/';
    public function __construct()
    {
        $this->setResourceClassName('Category_Media_Resource');
        parent::__construct();
    }

    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    public function getCategory($reload = false)
    {
        $categoryModel = Ccc::getModel('Category');
        if(!$this->categoryId)
        {
            return $categoryModel;
        }
        if($this->category && !$reload)
        {
            return $this->category;
        }
        $category = $categoryModel->fetchRow("SELECT * FROM `category` WHERE `categoryId` = {$this->categoryId}");
        if(!$category)
        {
            return $categoryModel;
        }
        $this->setCategory($category);
        return $this->category;
    }

    public function getImgPath()
    {
        return Ccc::getBaseUrl($this->mediaPath.$this->name);
    }
}
