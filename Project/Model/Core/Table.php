<?php

class Model_Core_Table
{
    protected $tableName = null;
    protected $primaryKey = null;
    protected $rowClassName = null;

    public function getTableName()
    {
        return $this->tableName;
    }

    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
        return $this;
    }

    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    public function setPrimaryKey($primaryKey)
    {
        $this->primaryKey = $primaryKey;
        return $this;
    }

    public function getRowClassName()
    {
        return $this->rowClassName;
    }

    public function setRowClassName($rowClassName)
    {
        $this->rowClassName = $rowClassName;
        return $this;
    }

    public function getRow()
    {
        return Ccc::getModel($this->getRowClassName());
    }

    public function insert(array $data=null)
    {
        global $adapter;
        $arrayData = array();
        foreach($data as $key => $value )
        {
            $arrayData[''.$key] = "'".$value."'";
        }


        $insertQuery = ("INSERT INTO {$this->getTableName()} (" . implode(',',array_keys($data)) . 
            ") VALUES ( ". implode(',', array_values($arrayData)) . ")");
        /*if($this->getTableName() == 'address'){
            print_r($insertQuery);
            exit();
        }*/
        $insertId = $adapter->insert($insertQuery);
        return $insertId;
    }


    public function update(array $data=null,$primaryKey=null)
    {
        global $adapter;
        $stringData = "";

        foreach($data as $key => $value )
        {
            $arrayData[''.$key] = "'".$value."'";
            $stringData.= $key."=".$arrayData[''.$key].",";
        }

        $stringData = rtrim($stringData,',');
        $updateQuery = "UPDATE {$this->getTableName()} SET $stringData WHERE {$this->getTableName()}.{$this->getPrimaryKey()} = $primaryKey";
        /*if($this->tableName == 'address')
        {
            print_r($updateQuery);
            exit;
        }*/

        $update = $adapter->update($updateQuery);
        /*if(!$update)
        {
            throw new Exception("Error Processing Request", 1);
        }*/
    }


    public function delete($primaryKey = null,array $data = null)
    {
        $deleteQuery = "DELETE FROM {$this->getTableName()} WHERE {$this->getPrimaryKey()} = $primaryKey";
        global $adapter;
    
        $delete = $adapter->delete($deleteQuery);
        if(!$delete)
        {
            throw new Exception("Error Processing Request", 1);
        }
    }


    public function fetchAll($query)
    {
        global $adapter;
        $fetchAll = $adapter->fetchAll($query);
        if(!$fetchAll)
        {
            throw new Exception("Error Processing Request", 1);
        } 
        return $fetchAll;
    }


    public function fetchRow($query)
    {
        global $adapter;
        
        $fetchRow = $adapter->fetchRow($query);
        if(!$fetchRow)
        {
            return null;
        }
        return $fetchRow;
    }

    public function load($id)
    {
        $rowData = $this->fetchRow("SELECT * FROM {$this->getTableName()} WHERE {$this->getPrimaryKey()} = {$id}");

        if(!$rowData)
        {
            return false;
        }
        
        $row = $this->getRow();
        $row->setData($rowData);
        return $row;
    }
}
?>
