<?php
    $product = $this->getData('product');    
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit Product</title>
</head>
<body>
    <h2>Edit Product</h2>
    <form action="index.php?c=product&a=save&id=<?php echo $product['productID'] ?>" method="post">
        <input type="text" name="product[productID]" value="<?php echo $product['productID'] ?>" hidden>
        <label>Name</label>
        <input type="text" name="product[name]" value="<?php echo $product['name']; ?>" required/>
        <br>
        <br>
        <label>Price</label>
        <input type="text" name="product[price]" value="<?php echo $product['price']; ?>" required/>
        <br>
        <br>
        <label>Quantity</label>
        <input type="text" name="product[quantity]" value="<?php echo $product['quantity']; ?>" required/>
        <br>
        <br>
        <label>Status</label>
        <select name="product[status]">
            <?php if($product['status']==1): ?>
            <option value="1" selected>Active</option>
            <option value="2">Inactive</option>
            <?php else: ?>
            <option value="1">Active</option>
            <option value="2" selected>Inactive</option>                
            <?php endif; ?>
        </select>
        <br>
        <br>        
        <input type='submit' name='Update' id='submit' value='update'/>
    </form>
</body>
</html>
