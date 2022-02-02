<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add Product</title>
</head>
<body>
    <h2>Add Product</h2>

    <form action="product-save.php" method="post">
        <label>Name</label>
        <input type="text" name="productName" required />
        <br>
        <br>
        <label>Price</label>
        <input type="number" name="productPrice" required/>
        <br>
        <br>
        <label>Quantity</label>
        <input type="number" name="productQunty" required/>
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
        <input type="datetime-local" name="createdDate" required/>
        <br>
        <br>
        <label>Updated Date</label>
        <input type="datetime-local" name="updatedDate" />
        <br>
        <br>
        <input class="submit" type="submit" value="Save"  />
    </form>
</body>
</html>
