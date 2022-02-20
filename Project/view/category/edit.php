<?php
    $categories = $this->getCategories();
    $category = $this->getCategory();
    $result = $this->pathAction();
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
    <form action="<?php echo $this->getUrl('category','save',['id'=>$category['categoryID']],true) ?>" method="post">
        <table border="1" cellspacing="4">
            <input type="text" name="category[parentID]" value="<?php echo $category['parentID']; ?>" hidden />
            <input type="text" name="category[categoryID]" value="<?php echo $category['categoryID']; ?>" hidden />
            <tr>
                <td>Name</td>
                <td><input type="text" name="category[name]" value="<?php echo $category['name']; ?>" required/></td>
            </tr>
            <tr>
                <td>Sub-Category</td>
                <td>
                    <select name="category[root]">
                    <option value="" <?php echo ($category['parentID']==NULL) ? "selected" : ''; ?>>Root Category</option>
                    <?php foreach ($categories as $value) { ?>
                        <option value="<?php echo $value['categoryID']; ?>" <?php echo ($value['categoryID']==$category['parentID']) ? "selected" : ''; ?>>
                            <?php echo $result[$value['categoryID']]; ?>
                        </option>
                    <?php }?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    <select name="category[status]">
                        <?php if($categories['status']==1): ?>
                        <option value="1" selected>Active</option>
                        <option value="2">Inactive</option>
                        <?php else: ?>
                        <option value="1">Active</option>
                        <option value="2" selected>Inactive</option>                
                        <?php endif; ?>
                    </select>
                </td>
            </tr>   
        <input type='submit' name='Update' id='submit' value='update'/>
    </table>
    </form>
</body>
</html>
