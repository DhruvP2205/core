<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add Category</title>
</head>
<body>
    <h2>Add Category</h2>

    <form action="category-save.php" method="post">
        <label>Name</label>
        <input type="text" name="categoryName" required />
        <br>
        <br>
        <label>Status</label>
        <select name="categoryStatus">
            <option value="1" selected>Active</option>
            <option value="2">Inactive</option>
        </select>
        <br>
        <br>
        <input class="submit" type="submit" name='submit' id='submit' value="Save"  />
    </form>
</body>
</html>
