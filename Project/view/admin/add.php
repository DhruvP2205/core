<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add Admin</title>
</head>
<body>
    <h2>Add Customer</h2>
    <form action="index.php?c=admin&a=save" method="post">
        <label>First Name</label>
        <input type="text" name="admin[firstName]" required />
        <br>
        <br>
        <label>Last Name</label>
        <input type="text" name="admin[lastName]" required />
        <br>
        <br>
        <label>Email</label>
        <input type="text" name="admin[email]" required />
        <br>
        <br>
        <label>Password</label>
        <input type="password" name="admin[password]" required />
        <br>
        <br>
        <label>Status</label>
        <select name="admin[status]">
            <option value="1" selected>Active</option>
            <option value="2">Inactive</option>
        </select>
        <br>
        <br>
        <input class="submit" type="submit" name='submit' id='submit' value="Save"  />
    </form>
</body>
</html>
