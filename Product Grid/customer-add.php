<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add Customer</title>
</head>
<body>
    <h2>Add Customer</h2>

    <form action="customer-index.php?a=saveAction" method="post">
        <label>First Name</label>
        <input type="text" name="customer[firstName]" required />
        <br>
        <br>
        <label>Last Name</label>
        <input type="text" name="customer[lastName]" required />
        <br>
        <br>
        <label>Email</label>
        <input type="text" name="customer[email]" required />
        <br>
        <br>
        <label>Mobile</label>
        <input type="text" name="customer[mobile]" required />
        <br>
        <br>
        <label>Status</label>
        <select name="customer[status]">
            <option value="1" selected>Active</option>
            <option value="2">Inactive</option>
        </select>
        <br>
        <br>
        <input class="submit" type="submit" name='submit' id='submit' value="Save"  />
    </form>
</body>
</html>
