<?php Ccc::loadClass('Block_Core_Template');

class Block_Core_Grid_Collection extends Block_Core_Template   
{
    protected $collections = [];
    protected $currentCollection = null;
    protected $grid = null;
    protected $actions = [];
    protected $pagerModel = null;

    public function __construct()
    {
        $this->prepareCollections();
    }

    public function getGrid()
    {
        return $this->grid;
    }
    
    public function setGrid($grid)
    {
        $this->grid = $grid;
        return $this;
    }

    public function getColumns()
    {
        return $this->getCollections()[$this->getCurrentCollection()]['columns'];
    }

    public function setColumns(array $columns)
    {
        $this->setCollection($columns,'columns');
        return $this;
    }

    public function prepareCollections()
    {
        return $this;
    }

    public function getSelectedCollection()
    {
        $collectionKey = Ccc::getModel('Core_Request')->getRequest('collection');
        $collection = $this->getCollection($collectionKey);
        if(!$collection)
        {
            return $this->getCollection($this->currentCollection);
        }
        $this->setCurrentCollection($collection);
        return $collection;
    }

    public function setCurrentCollection($currentCollection = null)
    {
        $collectionKey = Ccc::getModel('Core_Request')->getRequest('collection');
        $collection = $this->getCollection($collectionKey);
        if(!$collection)
        {
            $this->currentCollection = $currentCollection;
        }
        else
        {
            $this->currentCollection = $collectionKey;
        }
        return $this;
    }

    public function getCurrentCollection()
    {
        return $this->currentCollection;
    }

    public function getCollections()
    {
        return $this->collections;
    }

    public function addCollection($collection, $key)
    {
        $this->collections[$key] = $collection;
       
        return $this;
    }
    public function setCollection($collection, $key)
    {
        $this->collections[$this->currentCollection][$key] = $collection;
        return $this; 
    }

    public function getCollection($key)
    {
        if(array_key_exists($key,$this->collections))
        {
            return $this->collections[$key];
        }
        return null;

    }
    public function removeCollection($collection)
    {
        if(array_key_exists($key,$this->collections))
        {
            unset($this->collections[$key]);
        }
        return $this;
    }

    public function getHeaders()
    {
        return $this->getCollections()[$this->getCurrentCollection()]['header'];
    }

    public function setHeaders(array $headers)
    {
        $this->setCollection($headers,'headers');
        return $this;
    }

    public function getActions()
    {
        if(!$this->actions)
        {
            $actions = [
                        'edit'=>['title'=> 'edit', 'method'=>'$this->getEditUrl()'],
                        'delete'=>['title'=> 'delete', 'method'=>'$this->getDeleteUrl()']
                        ];
            $this->setActions($actions);
        }
        return $this->actions;
    }

    public function setActions(array $actions)
    {
        $this->actions = $actions;
        return $this;
    }

    public function getPagerModel()
    {
        return $this->pagerModel;
    }

    public function setPagerModel($pagerModel)
    {
        $this->pagerModel = $pagerModel;
        return $this;
    }
}
