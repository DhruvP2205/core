<?php $product = $this->getProduct(); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit Product</title>
</head>
<body>
    <h2>Edit Product</h2>
    <form action="<?php echo $this->getUrl('product','save',['id'=>$product['productID']],true) ?>" method="post">
        <table border="1" cellspacing="4">
            <input type="text" name="product[productID]" value="<?php echo $product['productID'] ?>" hidden>
            <tr>
                <td>Name</td>
                <td><input type="text" name="product[name]" value="<?php echo $product['name']; ?>" required/></td>
            </tr>
            <tr>
                <td>Price</td>
                <td><input type="text" name="product[price]" value="<?php echo $product['price']; ?>" required/></td>
            </tr>
            <tr>
                <td>Quantity</td>
                <td><input type="text" name="product[quantity]" value="<?php echo $product['quantity']; ?>" required/></td>
            </tr>
        
            <tr>
                <td>Status</td>
                <td>
                    <select name="product[status]">
                        <?php if($product['status']==1): ?>
                        <option value="1" selected>Active</option>
                        <option value="2">Inactive</option>
                        <?php else: ?>
                        <option value="1">Active</option>
                        <option value="2" selected>Inactive</option>                
                        <?php endif; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="10%">&nbsp;</td>
                <td>
                    <input type='submit' name='Update' value='update'/>
                    <button type="button"><a href="<?php echo $this->getUrl('product','grid') ?>">Cancel</a></button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
