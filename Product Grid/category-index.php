<?php require_once('Adapter.php'); ?>
<?php

class Category{

    public function gridAction()
    {
        require_once('category-grid.php');
    }

    public function saveAction()
    {
        try {
            if($_SERVER['REQUEST_METHOD']=='POST')
            {
                $adapter = new Adapter();

                $categoryName = $_POST['category']['name'];
                $categoryStatus = $_POST['category']['status'];
                $createdDate = date("Y-m-d H:i:s");
                $updatedDate = date("Y-m-d H:i:s");


                if($_POST["submit"] == "Save")
                {
                    $result = $adapter->insert("insert into category(name,status,createdDate) values ('{$categoryName}','{$categoryStatus}','{$createdDate}')");

                    if(!$result)
                    {
                        throw new Exception("System is unable to save record.",1);
                    }
                    $this->redirect('category-index.php?a=gridAction');
                }
                
                if($_POST["Update"] == "update")
                {
                    if(!isset($_GET['id'])){
                        throw new Exception("Invalid Request.", 1);
                    }
                    if(!(int)$_GET['id']){
                        throw new Exception("Invalid Request.", 1);
                    }
                    $adapter = new Adapter();
                    $categoryID = $_GET['id'];

                    $result = $adapter->update("update category set name ='$categoryName', status ='$categoryStatus', updatedDate='$updatedDate' where categoryID = $categoryID");
                    if(!$result)
                    {
                        throw new Exception("System is unable to update record.",1);
                    }
                    $this->redirect('category-index.php?a=gridAction');
                }
            }
        }
        catch (Exception $e) {
            /*echo $e->getMessage();*/
            $this->redirect('category-index.php?a=gridAction');
        }
    }

    public function editAction()
    {
        require_once('category-edit.php');
    }

    public function addAction()
    {
        require_once('category-add.php');
    }

    public function deleteAction()
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
                $adapter = new Adapter();
                $result = $adapter->delete("DELETE FROM category WHERE categoryID = '$categoryID'");
                if(!$result)
                {
                    throw new Exception("System is unable to delete record.",1);
                }
                $this->redirect('category-index.php?a=gridAction');
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            $this->redirect('category-index.php?a=gridAction');
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

$action = ($_GET['a']) ? $_GET['a'] : 'errorAction';
$category = new Category();
$category->$action();
?>
