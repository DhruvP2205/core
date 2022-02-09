<?php

    $adapter = new Model_Core_Adapter();
    $categories = $adapter->fetchAll("SELECT * FROM category");

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
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Category</title>
    <link rel="stylesheet" href="./src/css/style.css">
</head>
<body>
    <a href='index.php?c=category&a=add'>Add Category</a>
            <h2>All Records</h2>
            <table cellpadding="7px">
                <thead>
                    <th>Category ID</th>
                    <th>Name</th> 
                    <th>Status</th>
                    <th>Created Date</th>
                    <th>Updated Date</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
                        if(!$categories):?>
                            <tr><td colspan="10">No Record available.</td></tr>
                    
                <?php else:
                    foreach ($categories as $category):
                ?>
                <tr>
                    <td><?php echo($category['categoryID']); ?></td>
                    <!-- <td><?php echo($category['name']); ?></td> -->
                    <td><?php echo path($category['categoryID'],$categories); ?></td>
                    <td>
                        <?php 
                            if($category['status'] == 1){
                                echo("Active");
                            } 
                            else{
                                echo("Inactive");
                            } ?>
                    </td>
                    <td><?php echo($category['createdDate']); ?></td>
                    <td><?php echo($category['updatedDate']); ?></td>
                    <td>
                        <a href="index.php?c=category&a=edit&id=<?php echo $category['categoryID'] ?>">Edit</a>
                        <a href="index.php?c=category&a=delete&id=<?php echo $category['categoryID'] ?>">Delete</a>
                    </td>
                </tr>
                <?php
                        endforeach;
                    endif;
                ?>
        </tbody>
    </table>
</body>
</html>
