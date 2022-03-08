<?php
Ccc::loadClass('Block_Core_Template');

class Block_Category_Edit extends Block_Core_Template   
{
    public function __construct()
    {
        $this->setTemplate('view/category/edit.php');
    }
    
    public function getCategories()
    {
        $categoryModel = Ccc::getModel('category');
        $categories = $categoryModel->fetchAll("SELECT * FROM `category` ORDER BY `path`");
        return $categories;
    }

    public function getCategory()
    {
        return $this->getData('category');
    }

    public function getPath($categoryId,$path)
    {
        $finalPath = NULL;
        $path = explode("/",$path);
        foreach ($path as $path1) {
            $load = Ccc::getModel('Category');
            $category = $load->load($path1);
            if($path1 != $categoryId){
                $finalPath .= $category->name."=>";
            }else{
                $finalPath .= $category->name;
            }
        }
        return $finalPath;
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
