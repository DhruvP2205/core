<?php
    include 'Adapter.php';

    $adapter = new Adapter();
    $result = $adapter->fetchAll("select * FROM product");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Product</title>
    <link rel="stylesheet" href="./src/css/style.css">
</head>
<body>
    <a href='product-add.php'>Add Product</a>
    <?php
        if($result)
        {
    ?>
            <h2>All Records</h2>
            <table cellpadding="7px">
                <thead>
                    <th>Sr No.</th>
                    <th>Product ID</th>
                    <th>Name</th>  
                    <th>Price</th>
                    <th>Quantity</th>  
                    <th>Status</th>
                    <th>Created Date</th>
                    <th>Updated Date</th>
                    <th>Action</th>
                </thead>
                <tbody>
                <?php 
                    for($i=0; $i < count($result); $i++){
                ?>
                <tr>
                    <td><?php echo($i+1); ?></td>
                    <td><?php echo($result[$i]['productID']); ?></td>
                    <td><?php echo($result[$i]['name']); ?></td>
                    <td><?php echo($result[$i]['price']); ?></td>
                    <td><?php echo($result[$i]['quantity']); ?></td>
                    <td><?php echo($result[$i]['status']); ?></td>
                    <td><?php echo($result[$i]['createdDate']); ?></td>
                    <td><?php echo($result[$i]['updatedDate']); ?></td>
                    <td>
                        <a href="product-edit.php?id=<?php echo($result[$i]['productID']);?>">Edit</a>
                        <a href="product-delete.php?id=<?php echo($result[$i]['productID']);?>">Delete</a>
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
