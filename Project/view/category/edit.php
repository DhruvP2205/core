<?php 
$categoryData =  $this->getCategory();  
$categories = $this->getCategories();
?>

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
                        <select name="category[status]">
                            <option value="1" <?php echo ($this->getStatus($category->status)=='Active')?'selected':'' ?>>Active</option>
                            <option value="2" <?php echo ($this->getStatus($category->status)=='Inactive')?'selected':'' ?>>Inactive</option>
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
