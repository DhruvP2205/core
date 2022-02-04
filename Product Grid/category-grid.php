<?php
    require_once('Adapter.php');

    $adapter = new Adapter();
    $categories = $adapter->fetchAll("select * from category");
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
    <a href='category-index.php?a=addAction'>Add Product</a>
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
                    <td><?php echo($category['name']); ?></td>
                    <td><?php echo($category['status']); ?></td>
                    <td><?php echo($category['createdDate']); ?></td>
                    <td><?php echo($category['updatedDate']); ?></td>
                    <td>
                        <a href="category-index.php?a=editAction&id=<?php echo $category['categoryID'] ?>">Edit</a>
                        <a href="category-index.php?a=deleteAction&id=<?php echo $category['categoryID'] ?>">Delete</a>
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
