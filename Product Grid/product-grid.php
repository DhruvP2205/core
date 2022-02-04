<?php
    require_once('Adapter.php');

    $adapter = new Adapter();
    $products = $adapter->fetchAll("select * FROM product");
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
    <a href='product-index.php?a=addAction'>Add Product</a>
            <h2>All Records</h2>
            <table cellpadding="7px">
                <thead>
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
                        if(!$products):?>
                            <tr><td colspan="10">No Record available.</td></tr>
                    
                <?php else:
                    foreach ($products as $product):
                ?>
                <tr>
                    <td><?php echo($product['productID']); ?></td>
                    <td><?php echo($product['name']); ?></td>
                    <td><?php echo($product['price']); ?></td>
                    <td><?php echo($product['quantity']); ?></td>
                    <td><?php echo($product['status']); ?></td>
                    <td><?php echo($product['createdDate']); ?></td>
                    <td><?php echo($product['updatedDate']); ?></td>
                    <td>
                        <a href="product-index.php?a=editAction&id=<?php echo $product['productID'] ?>">Edit</a>
                        <a href="product-index.php?a=deleteAction&id=<?php echo $product['productID'] ?>">Delete</a>
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
