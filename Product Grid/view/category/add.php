<?php
try {
    $adapter = new Model_Core_Adapter();
    $categories = $adapter->fetchAll("SELECT * FROM category ORDER BY `path`");

    function path($categoryID,$array){
        $len = count($array);

        for($i = 0;$i< $len;$i++){
            if($categoryID == $array[$i]["categoryID"]){
                if($array[$i]["parentID"] == null){
                    return $array[$i]["name"];
                }
                return path($array[$i]["parentID"],$array)." => ".$array[$i]["name"];
            }
        }
    }
    
} catch (Exception $e) {
    echo $e->getMessage();
    exit();
    //$this->redirect('index.php?c=category&a=grid');
} 

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

    <form action="index.php?c=category&a=save" method="post">
        <label>Name</label>
        <input type="text" name="category[name]" required />
        <br>
        <br>

        <label>Sub-Category</label>
        <select name="category[parentID]">
            <option value=<?php echo NULL; ?>>Root Category</option>
            <?php foreach($categories as $category): ?>
            <option value="<?php echo $category['categoryID']; ?>"><?php echo path($category['categoryID'],$categories); ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <br>


        <label>Status</label>
        <select name="category[status]">
            <option value="1" selected>Active</option>
            <option value="2">Inactive</option>
        </select>
        <br>
        <br>
        <input class="submit" type="submit" name='submit' value="Save"  />
    </form>
</body>
</html>
