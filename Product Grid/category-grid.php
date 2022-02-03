<?php
    include 'Adapter.php';

    $adapter = new Adapter();
    $result = $adapter->fetchAll("select * from category");
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
    <a href='category-add.php'>Add Category</a>
    <?php
        if($result)
        {
    ?>
            <h2>All Records</h2>
            <table cellpadding="7px">
                <thead>
                    <th>Sr No.</th>
                    <th>Category ID</th>
                    <th>Name</th> 
                    <th>Status</th>
                    <th>Created Date</th>
                    <th>Updated Date</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
                        for ($i=0; $i < count($result); $i++){
                    ?>
                        <tr>
                            <td><?php echo($i+1); ?></td>
                            <td><?php echo($result[$i]['categoryID']); ?></td>
                            <td><?php echo($result[$i]['name']); ?></td>
                            <td><?php echo($result[$i]['status']); ?></td>
                            <td><?php echo($result[$i]['createdDate']); ?></td>
                            <td><?php echo($result[$i]['updatedDate']); ?></td>
                            <td>
                            <a href="category-edit.php?id=<?php echo($result[$i]['categoryID']);?>">Edit</a>
                            <a href="category-delete.php?id=<?php echo($result[$i]['categoryID']);?>">Delete</a>
                            </td>
                        </tr>
                    <?php
                        }
                    }
                    else{
                        echo("<h2>No record found!</h2>");
                    }
                ?>
                </tbody>
            </table>
</body>
</html>
