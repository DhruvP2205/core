<?php
try {
    if(!isset($_GET['id'])){
        throw new Exception("Invalid Request.", 1);
    }
    if(!(int)$_GET['id']){
        throw new Exception("Invalid Request.", 1);
    }

    $categoryID = $_GET['id'];

    $adapter = new Model_Core_Adapter();
    $category = $adapter->fetchRow("SELECT * FROM category WHERE categoryID = $categoryID");  
    
} catch (Exception $e) {
    echo $e->getMessage();
    $this->redirect('index.php?c=category&a=grid');
} 

$adapter = new Model_Core_Adapter();
$categories = $adapter->fetchAll("SELECT * FROM category");

function path($categoryID,$array){
    $len = count($array);

    for($i = 0;$i< $len-1;$i++){

        if($categoryID == $array[$i]["categoryID"]){
            if($array[$i]["parentID"] == null){
                return $array[$i]["name"];
            }
            return path($array[$i]["parentID"],$array)." => ".$array[$i]["name"];
        }
    }
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
    <form action="index.php?c=category&a=save&id=<?php echo $category['categoryID']?>" method="post">
        <label>Name</label>
        <input type="text" name="category[name]" value="<?php echo $category['name']; ?>" required/>
        <br>
        <br>

        <label>Sub-Category</label>
        <select name="category[parentID]">
            <option value="<?php echo $category['categoryID']; ?>"><?php echo path($category['categoryID'],$categories); ?></option>
        </select>
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
