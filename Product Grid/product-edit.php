<?php
    include 'Adapter.php';

    $productID = $_GET['id'];

    $adapter = new Adapter();
    $result = $adapter->fetchRow("select * FROM product WHERE productID = $productID");
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
    <form action="product-save.php" method="post">
        <label>Name</label>
        <input type="hidden" name="productID" value="<?php echo $productID; ?>" required/>
        <input type="text" name="productName" value="<?php echo $result['name']; ?>" required/>
        <br>
        <br>
        <label>Price</label>
        <input type="text" name="productPrice" value="<?php echo $result['price']; ?>" required/>
        <br>
        <br>
        <label>Quantity</label>
        <input type="text" name="productQunty" value="<?php echo $result['quantity']; ?>" required/>
        <br>
        <br>
        <label>Status</label>
        <select name="productStatus">
            <option value="1" selected>Active</option>
            <option value="2">Inactive</option>
        </select>
        <br>
        <br>        
        <input type='submit' name='Update' id='submit' value='update'/>
    </form>
</body>
</html>
