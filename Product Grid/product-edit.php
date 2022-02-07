<?php
try {
    require_once('Adapter.php');
    if(!isset($_GET['id'])){
        throw new Exception("Invalid Request.", 1);
    }
    if(!(int)$_GET['id']){
        throw new Exception("Invalid Request.", 1);
    }

    $customerID = $_GET['id'];

    $productID = $_GET['id'];

    $adapter = new Adapter();
    $product = $adapter->fetchRow("select * FROM product WHERE productID = $productID");

} catch (Exception $e) {
    /*echo $e->getMessage();*/
    $this->redirect('customer-index.php?a=gridAction');
}    
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
    <form action="product-index.php?a=saveAction&id=<?php echo $productID ?>" method="post">
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
