<?php

class Model_Core_Table
{
    protected $tableName = null;
    protected $primaryKey = null;

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

    public function insert(array $data=null)
    {
        global $adapter;
        $arrayData = array();
        foreach($data as $key => $value )
        {
            $arrayData[''.$key] = "'".$value."'";
        }

        $insertQuery = ("INSERT INTO $this->tableName (" . implode(',',array_keys($data)) . 
            ") VALUES ( ". implode(',', array_values($arrayData)) . ")");

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
        $updateQuery = "UPDATE $this->tableName SET $stringData WHERE $this->tableName.$this->primaryKey = $primaryKey";
        if($this->tableName == 'address')
        {
            print_r($updateQuery);
            exit;
        }

        $update = $adapter->update($updateQuery);
        /*if(!$update)
        {
            throw new Exception("Error Processing Request", 1);
        }*/
    }


    public function delete($primaryKey = null,array $data = null)
    {
        $deleteQuery = "DELETE FROM $this->tableName WHERE $this->primaryKey = $primaryKey";
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
}
?>
