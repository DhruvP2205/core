
<?php $product=$this->getProduct(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
</head>
<body>
    <h2>Product</h2>
    <form action="<?php echo $this->getUrl('save','product',['id'=>$product->productId],true) ?>" method="POST">
    <table border="1">
        <tr>
            <td colspan="2"><b>Product Information</b><input type="text" name="product[productId]" value="<?php echo $product->productId ?>" hidden></td>
        </tr>
        <tr>
            <td>Name</td>
            <td><input type="text" name="product[name]" value="<?php echo $product->name ?>"></td>
        </tr>
        
        <tr>
            <td>Price</td>
            <td><input type="text" name="product[price]" value="<?php echo $product->price ?>"></td>
        </tr>
        <tr>
            <td>Quantity</td>
            <td><input type="text" name="product[quantity]" value="<?php echo $product->quantity ?>"></td>
        </tr>
        <tr>
            <td>Status</td>
            <td>
                <select name="product[status]">
                    <option value="1" <?php echo ($product->getStatus($product->status)=='Active')?'selected':'' ?>>Active</option>
                    <option value="2" <?php echo ($product->getStatus($product->status)=='Inactive')?'selected':'' ?>>Inactive</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <input type="submit" name="submit" value="Update">
                <button type="button"><a href="<?php echo $this->getUrl('grid') ?>">Cancel</a></button>
            </td>
        </tr>
        
    </table>    
</form>
</body>
</html>
