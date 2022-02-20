<?php
    $categories = $this->getCategories();
    $result = $this->pathAction();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add Category</title>
</head>
<body>
    <h2>Add Category</h2>

    <form action="<?php echo $this->getUrl('category','save') ?>" method="post">
        <table border="1" cellspacing="4">
            <tr>
                <td>Name</td>
                <td><input type="text" name="category[name]" required /></td>
            </tr>
            <tr>
                <td>Sub-Category</td>
                <td>
                    <select name="category[parentID]">
                        <option value=<?php echo NULL; ?>>Root Category</option>
                        <?php foreach($categories as $category): ?>
                        <option value="<?php echo $category['categoryID']; ?>"><?php echo $result[$category['categoryID']];?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    <select name="category[status]">
                        <option value="1" selected>Active</option>
                        <option value="2">Inactive</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td width="10%">&nbsp;</td>
                <td>
                    <input class="submit" type="submit" name='submit' value="Save"  />
                    <button type="button"><a href="<?php echo $this->getUrl('category','grid') ?>">Cancel</a></button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
