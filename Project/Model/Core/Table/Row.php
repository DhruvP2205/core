<?php
class Model_Core_Table_Row
{
    protected $data = [];
    protected $tableClassName;

    public function getTableClassName()
    {
        return $this->tableClassName;
    }

    public function setTableClassName($tableClassName)
    {
        $this->tableClassName = $tableClassName;
        return $this;
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

    public function getTable()
    {
        return Ccc::getModel($this->getTableClassName());
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
}
