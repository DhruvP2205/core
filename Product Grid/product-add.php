<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add Product</title>
</head>
<body>
    <h2>Add Product</h2>

    <form action="product-index.php?a=saveAction" method="post">
        <label>Name</label>
        <input type="text" name="product[name]" required />
        <br>
        <br>
        <label>Price</label>
        <input type="number" name="product[price]" required/>
        <br>
        <br>
        <label>Quantity</label>
        <input type="number" name="product[quantity]" required/>
        <br>
        <br>
        <label>Status</label>
        <select name="product[status]">
            <option value="1" selected>Active</option>
            <option value="2">Inactive</option>
        </select>
        <br>
        <br>
        <input class="submit" type="submit" name='submit' value="Save"  />
    </form>
</body>
</html>
