<?php
try {
    require_once('Adapter.php');
    if(!isset($_GET['id'])){
        throw new Exception("Invalid Request.", 1);
    }
    if(!(int)$_GET['id']){
        throw new Exception("Invalid Request.", 1);
    }

    $categoryID = $_GET['id'];

    $adapter = new Adapter();
    $category = $adapter->fetchRow("select * from category where categoryID = $categoryID");
    
} catch (Exception $e) {
    /*echo $e->getMessage();*/
    $this->redirect('customer-index.php?a=gridAction');
}    
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit Category</title>
</head>
<body>
    <h2>Edit Category</h2>
    <form action="category-index.php?a=saveAction&id=<?php echo $categoryID ?>" method="post">
        <label>Name</label>
        <input type="text" name="category[name]" value="<?php echo $category['name']; ?>" required/>
        <br>
        <br>
        <label>Status</label>
        <select name="category[status]">
            <?php if($category['status']==1): ?>
            <option value="1" selected>Active</option>
            <option value="2">Inactive</option>
            <?php else: ?>
            <option value="1">Active</option>
            <option value="2" selected>Inactive</option>                
            <?php endif; ?>
        </select>
        <br>
        <br>        
        <input type='submit' name='Update' id='submit' value='update'/>
    </form>
</body>
</html>
