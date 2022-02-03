<?php
    include 'Adapter.php';

    $categoryID = $_GET['id'];

    $adapter = new Adapter();
    $result = $adapter->fetchRow("select * from category where categoryID = $categoryID");
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
    <form action="category-save.php" method="post">
        <label>Name</label>
        <input type="hidden" name="categoryID" value="<?php echo $categoryID; ?>" required/>
        <input type="text" name="categoryName" value="<?php echo $result['name']; ?>" required/>
        <br>
        <br>
        <label>Status</label>
        <select name="categoryStatus">
            <option value="1" selected>Active</option>
            <option value="2">Inactive</option>
        </select>
        <br>
        <br>        
        <input type='submit' name='Update' id='submit' value='update'/>
    </form>
</body>
</html>
