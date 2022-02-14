<?php
Ccc::loadClass('Controller_Core_Action');

class Controller_Category extends Controller_Core_Action{

    public function gridAction()
    {
        $adapter = new Model_Core_Adapter();
        $categories = $adapter->fetchAll("SELECT * FROM category ORDER BY `path`");

        
        $view = $this->getView();
        $view->setTemplate('view/category/grid.php');
        $view->addData('categories',$categories);
        $view->toHtml();
    }

    public function pathAction()
    {
        $adapter = new Model_Core_Adapter();
        $categoryName = $adapter->fetchPair('SELECT `categoryID`, `name` FROM `category`');
        $categoryPath = $adapter->fetchPair('SELECT `categoryID`, `path` FROM `category`');
        $categories=[];
        foreach ($categoryPath as $key => $value) {
                $explodeArray=explode('/', $value);
                $tempArray = [];

                foreach ($explodeArray as $keys => $value) {
                    if(array_key_exists($value,$categoryName)){
                        array_push($tempArray,$categoryName[$value]);
                    }
                }

                $implodeArray = implode('/', $tempArray);
                $categories[$key]= $implodeArray;
        }
        return $categories;
    }


    protected function saveCategory(){
        try {
            if(!isset($_POST['category']))
            {
                throw new Exception("Request Invalid.",1);
            }
            
            $adapter = new Model_Core_Adapter();

            $row = $_POST['category'];
            
            $categoryName = $_POST['category']['name'];
            $categoryParentID = $_POST['category']['parentID'];
            $categoryStatus = $_POST['category']['status'];
            $createdDate = date('y-m-d h:m:s');
            $updatedDate = date('y-m-d h:m:s');

            if(isset($_GET['id']))
            {
                if(!(int)$_GET['id']){
                    throw new Exception("Invalid Request.", 1);
                }
                $categoryID = $_GET['id'];

                $result = $adapter->update("UPDATE category SET name ='$categoryName', status ='$categoryStatus', updatedDate ='$updatedDate' where categoryID = $categoryID");
                if(!$result)
                {
                    throw new Exception("System is unable to update record.",1);
                }
            }
            else
            {
                if(empty($categoryParentID))
                {
                    $result = $adapter->insert("INSERT INTO `category` (`name`,`status`,`createdDate`) VALUE ('$categoryName','$categoryStatus','$createdDate')");
                    if(!$result){
                        throw new Exception("System is unabel to insert data", 1);                          
                    }
                    $path = $adapter->update("UPDATE `category` SET `path` = '$result' WHERE `categoryID` = '$result' ");
                }
                
                else
                {
                    $result = $adapter->insert("INSERT INTO `category` (`parentID`,`name`,`status`,`createdDate`) VALUE ('$categoryParentID','$categoryName','$categoryStatus','$createdDate')");
                    if(!$result)
                    {
                        throw new Exception("System is unabel to insert data", 1);                          
                    }
                    $path = $adapter->fetchRow("SELECT * FROM `category` WHERE `categoryID` = '$categoryParentID' ");
                    $path = $path['path']."/".$result;
                    $newPath = $adapter->update("UPDATE `category` SET `path` = '$path' WHERE `categoryID` = '$result' ");
                }
                if(!$result)
                {
                    throw new Exception("Sysetm is unable to save your data", 1);   
                }
                
                return $result;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit();
            $this->redirect('index.php?c=category&a=grid');
        }
    }


    public function saveAction()
    {
        try
        {
            $this->saveCategory();
            $this->redirect('index.php?c=category&a=grid');
        }
        catch (Exception $e) 
        {
            $this->redirect('index.php?c=category&a=grid');
        }
    }


    public function editAction()
    {
        try {
            if(!isset($_GET['id'])){
                throw new Exception("Invalid Request.", 1);
            }
            if(!(int)$_GET['id']){
                throw new Exception("Invalid Request.", 1);
            }

            $categoryID = $_GET['id'];

            $adapter = new Model_Core_Adapter();
            $row = $adapter->fetchRow("SELECT * FROM category WHERE categoryID = $categoryID");
            $categories = $adapter->fetchAll("SELECT * FROM category ORDER BY `path`");

            $view = $this->getView();
            $view->addData('categories',$categories);
            $view->addData('row',$row);
            $view->setTemplate('view/category/edit.php');
            $view->toHtml();
            
        } catch (Exception $e) {
            echo $e->getMessage();
            $this->redirect('index.php?c=category&a=grid');
        }
    }


    public function addAction()
    {
        $adapter = new Model_Core_Adapter();
        $categories = $adapter->fetchAll("SELECT * FROM `category` ORDER BY `parentID`");
        

        $view = $this->getView();
        $view->addData('categories',$categories);
        $view->setTemplate('view/category/add.php');
        $view->toHtml();
    }

    protected function deleteCategory()
    {
        try {
            if($_SERVER['REQUEST_METHOD']=='GET')
            {
                if(!isset($_GET['id'])){
                    throw new Exception("Invalid Request.", 1);
                }
                if(!(int)$_GET['id']){
                    throw new Exception("Invalid Request.", 1);
                }
                $categoryID = $_GET['id'];
                $adapter = new Model_Core_Adapter();
                $result = $adapter->delete("DELETE FROM category WHERE categoryID = '$categoryID'");
                if(!$result)
                {
                    throw new Exception("System is unable to delete record.",1);
                }
                $this->redirect('index.php?c=category&a=grid');
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            $this->redirect('category-index.php?a=gridAction');
        }
    }

    public function deleteAction()
    {
        try
        {
            $this->deleteCategory();
            $this->redirect('index.php?c=category&a=grid');
        }
        catch (Exception $e) 
        {
            $this->redirect('index.php?c=category&a=grid');
        }
    }


    public function redirect($url)
    {
        header("Location: $url");
        exit();
    }


    public function errorAction()
    {
        echo "404<br>Not Found.";
    }
}

?>
