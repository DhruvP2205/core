<?php Ccc::loadClass('Block_Core_Template');
Ccc::loadClass('Block_Core_Grid_Collection');

class Block_Core_Grid extends Block_Core_Template  
{
    protected $collection = []; 
    
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('view/core/grid.php');
    }

    public function getEditUrl()
    {
        return $this->getUrl('save');
    }

    public function getCollection()
    {
        if($this->collection)
        {
            return $this->collection;
        }

        $className =  get_class($this).'_Collection';
        $object = new $className();
        $object->setGrid($this);
        $this->setCollection($object);

        return $object;
    }

    public function setCollection($collection)
    {
        $this->collection = $collection;
        return $this;
    }

    public function getCollectionContent()
    {
        $collections = $this->getCollection()->getCollections()[$this->getCollection()->getCurrentCollection()];
        $object = Ccc::getBlock($collections['block']);
        return $object;
    }

    public function getActionUrl($title, $id = null)
    {
        return $this->getUrl($title, null, ['id'=> $id], true);
    }
}
