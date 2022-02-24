<?php 
class Model_Core_Row
{
    protected $data = [];
    protected $resourceClassName = null;
    

    public function __construct()
    {
        
    }

    public function getResourceClassName()
    {
        return $this->resourceClassName;
    }

    public function setResourceClassName($resourceClassName)
    {
        $this->resourceClassName = $resourceClassName;
        return $this;
    }

    
    public function getData()
    {
        return $this->data;
    }

    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }

    public function resetData()
    {
        $this->data = [];
        return $this;
    }

    public function __set($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }

    public function __get($key)
    {
        if(!array_key_exists($key, $this->data))
        {
            return null;
        }
        return $this->data[$key];
    }

    public function __unset($key)
    {
        if(array_key_exists($key, $this->data))
        {
            unset($this->data[$key]);
        }
        return $this;
    }

    public function getResource()
    {
        return Ccc::getModel($this->getResourceClassName());
    }

    public function save()
    {
        if(array_key_exists($this->getResource()->getPrimaryKey(), $this->data))
        {
            $id = $this->data[$this->getResource()->getPrimaryKey()];
            unset($this->data[$this->getResource()->getPrimaryKey()]);
            
            $this->getResource()->update($this->data,$id);
        }
        else
        {
            $id = $this->getResource()->insert($this->data);
        }
        return $id;
    }

    public function delete()
    {
        if(!array_key_exists($this->getResource()->getPrimaryKey(), $this->data))
        {
            return false;
        }
        $key = $this->getResource()->getPrimaryKey();
        $value = $this->data[$this->getResource()->getPrimaryKey()];
        $result = $this->getResource()->delete([$key=>$value]);
        return $result;
    }

    public function load($id, $column = null)
    {
        if($column == null){
            $column = $this->getResource()->getPrimaryKey();
        }
        $tableName = $this->getResource()->getResourceName();
        $query = "SELECT * FROM $tableName WHERE $column = $id";
        
        return $this->fetchRow($query);
    }

    public function fetchRow($query)
    {
        $result = $this->getResource()->fetchRow($query);
        if(!$result){
            return $result;
        }
        return (new $this())->setData($result);
    }

    // new fetchall method
    public function fetchAll($query)
    {
        $results = $this->getResource()->fetchAll($query);
        if(!$results)
        {
            return $results;
        }
        foreach ($results as &$result) 
        {
            $result = (new $this())->setData($result);
        }
        return $results;
    }
}

