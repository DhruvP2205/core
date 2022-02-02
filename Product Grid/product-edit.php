<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit Product</title>
</head>
<body>
    <h2>Edit Product</h2>

    <?php

        $conn = mysqli_connect('localhost:3308','root','1234','demodb') or die("Connection failed");
        $productID = $_GET['id'];

        $query = "select * from product where productID = {$productID}";

        $result = mysqli_query($conn,$query) or die("Unsuccessful!");  
        
        if (mysqli_num_rows($result)>0) 
        { 
            while($row = mysqli_fetch_assoc($result))
            {

        ?>

        <form action="product-update.php" method="post">
            <label>Name</label>
            <input type="hidden" name="productID" value="<?php echo $row['productID']; ?>" required/>
            <input type="text" name="productName" value="<?php echo $row['name']; ?>" required/>
            <br>
            <br>
            <label>Price</label>
            <input type="text" name="productPrice" value="<?php echo $row['price']; ?>" required/>
            <br>
            <br>
            <label>Quantity</label>
            <input type="text" name="productQunty" value="<?php echo $row['quantity']; ?>" required/>
            <br>
            <br>
            <label>Status</label>
            <select name="productStatus">
                <option value="1" selected>Active</option>
                <option value="0">Inactive</option>
            </select>
            <br>
            <br>
            <label>Created Date</label>
            <input type="datetime-local" name="createdDate" value="<?php echo $row['createdDate']; ?>" required/>
            <br>
            <br>
            <label>Updated Date</label>
            <input type="datetime-local" name="updatedDate" value="<?php echo $row['updatedDate']; ?>" required/>
            <br>
            <br>
            
            <input class="submit" type="submit" value="Update"/>
        </form>
        <?php 
            }
        } 
    ?>
</body>
</html>
