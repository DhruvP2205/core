<?php Ccc::loadClass('Model_Core_Table');

class Model_Core_Table_Resource
{
    protected $data = [];
    protected $resourceClassName;

    public function getResourceClassName()
    {
        return $this->resourceClassName;
    }

    public function setResourceClassName($resourceClassName)
    {
        $this->resourceClassName = $resourceClassName;
        return $this;
    }

    public function getTableObj()
    {
        Ccc::loadClass('Model_Core_Table');
        return new Model_Core_Table();
    }

    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function resetData()
    {
        $this->data = [];
        return $this;
    }

    public function __set($key, $value)
    {
        $this->data[$key] = $value;
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
        unset($this->data[$key]);
    }

    public function getResource()
    {
        return Ccc::getModel($this->getResourceClassName());
    }

    public function save()
    {
        if(array_key_exists($this->getTable()->getPrimaryKey(), $this->data))
        {
            $id = $this->data[$this->getTable()->getPrimaryKey()];
            $this->getTable()->update($this->data, $id);
        }
        else
        {
            $id = $this->getTable()->insert($this->data);
            return $id;
        }
        return $this;
    }

    public function load($id)
    {
        $rowData = $this->getTableObj()->fetchRow("SELECT * FROM {$this->getTableName()} WHERE {$this->getPrimaryKey()} = {$id}");
        if(!$rowData)
        {
            return false;
        }
        $row = $this->getRow();
        $row->setData($rowData);
        return $row;
    }

    public function fetchAll($query)
    {
        $customers = $this->getTableObj()->fetchAll($query);
        if(!$customers)
        {
            return $customers;
        }
        $customerObj = [];
        foreach ($customers as &$customer) 
        {
            $customer = (new $this())->setData($customer);  
        }
        return $customers;
    }
}
