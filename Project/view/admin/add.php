<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add Admin</title>
</head>
<body>
    <h2>Add Customer</h2>
    <form action="<?php echo $this->getUrl('admin','save') ?>" method="post">
        <table border="1" cellspacing="4">
            <tr>
                <td colspan="2"><b>Personal Information</b></td>
            </tr>
            <tr>
                <td>First Name</td>
                <td><input type="text" name="admin[firstName]" required /></td>
            </tr>
            <tr>
                <td>Last Name</td>
                <td><input type="text" name="admin[lastName]" required /></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="admin[email]" required /></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="admin[password]" required /></td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    <select name="admin[status]">
                        <option value="1" selected>Active</option>
                        <option value="2">Inactive</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="10%">&nbsp;</td>
                <td>
                    <input type="submit" name='submit' value="Save"  />
                    <button type="button"><a href="<?php echo $this->getUrl('admin','grid') ?>">Cancel</a></button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
