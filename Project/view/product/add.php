<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add Product</title>
</head>
<body>
    <h2>Add Product</h2>
    <form action="<?php echo $this->getUrl('product','save') ?>" method="post">
        <table border="1" cellspacing="4">
            <tr>
                <td colspan="2"><b>Product Information</b></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><input type="text" name="product[name]" required /></td>
            </tr>
            <tr>
                <td>Price</td>
                <td><input type="number" name="product[price]" required/></td>
            </tr>
            <tr>
                <td>Quantity</td>
                <td><input type="number" name="product[quantity]" required/></td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    <select name="product[status]">
                        <option value="1" selected>Active</option>
                        <option value="2">Inactive</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="10%">&nbsp;</td>
                <td>
                    <input type="submit" name='submit' value="Save"  />
                    <button type="button"><a href="<?php echo $this->getUrl('product','grid') ?>">Cancel</a></button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
