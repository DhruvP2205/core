<?php
    $Controller_Category = new Controller_Category();
    $categories = $this->getData('categories');
    $row = $this->getData('row');
    $result = $Controller_Category->pathAction();
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
    <form action="index.php?c=category&a=save&id=<?php echo $row['categoryID']?>" method="post">
        <label>Name</label>
        <input type="text" name="category[name]" value="<?php echo $row['name']; ?>" required/>
        <br>
        <br>

        <label>Sub-Category</label>
        <select name="category[parentID]" id="parentId">
            <?php foreach($categories as $category): ?>
            <option value="<?php echo $category['categoryID']; ?>"><?php echo $result[$category['categoryID']];?></option>
            <?php endforeach; ?>
        </select>


        <br>
        <br>
        
        <label>Status</label>
        <select name="category[status]">
            <?php if($row['status']==1): ?>
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
