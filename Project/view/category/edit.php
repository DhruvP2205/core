<?php 
$categoryData =  $this->getCategory();  
$categories = $this->getCategories();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
</head>

<body>
    <h2>Category</h2>
        <form action="<?php echo $this->getUrl('save','category',['id'=>$categoryData->categoryId],true) ?>" method="POST" enctype="multipart/form-data">
            <table border="1" cellspacing="4">
                <tr>
                    <td>Category Name</td>
                    <td><input type="text" name="category[name]" value= "<?php echo $categoryData->name; ?>"> </td>
                </tr>
                <tr>
                    <td>Subcategory</td>
                    <td>
                        <select name="category[parentId]" id="parentId">
                            <option value="<?php echo null; ?>" <?php echo ($categoryData->parentId == NULL) ? 'selected' : ''; ?>>Root Category</option>
                        <?php foreach($categories as $category): ?>
                            <?php if($categoryData->categoryId != $category->categoryId):  ?>
                            <option value="<?php echo $category->categoryId; ?>" <?php echo ($categoryData->parentId == $category->categoryId) ? 'selected' : ''; ?>><?php echo $this->getPath($category->categoryId,$category->path); ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="category[status]" id="status">
                            <?php if($categoryData->status == 1):?>
                            <option value="1" selected>Active</option>
                            <option value="2">Inactive</option>
                        <?php else: ?>
                            <option value="1">Active</option>
                            <option value="2" selected>Inactive</option>
                        <?php endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" value="Save">
                        <button><a href="<?php echo $this->getUrl('grid','category'); ?>">Cancel</a></button>
                    </td>
                </tr>
            </table>   
        </form>
    </div>
</body>
</html>
