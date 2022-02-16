<?php
    $admin = $this->getData('admins');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit admin</title>
</head>
<body>
    <h2>Edit Admin</h2>
    <form action="index.php?c=admin&a=save&id=<?php echo $admin['adminID'] ?>" method="POST">
        <table border="1" width="100%" cellspacing="4">
            
            <input type="text" name="admin[adminID]" value="<?php echo $admin['adminID'] ?>" hidden>
            
            <tr>
                <td width="10%">First Name</td>
                <td><input type="text" name="admin[firstName]" value="<?php echo $admin['firstName'] ?>"></td>
            </tr>
            <tr>
                <td width="10%">Last Name</td>
                <td><input type="text" name="admin[lastName]" value="<?php echo $admin['lastName'] ?>"></td>
            </tr>
            <tr>
                <td width="10%">Email</td>
                <td><input type="text" name="admin[email]" value="<?php echo $admin['email'] ?>"></td>
            </tr>
            <tr>
                <td width="10%">Password</td>
                <td><input type="text" name="admin[password]" value="<?php echo $admin['password'] ?>"></td>
            </tr>
            <tr>
                <td width="10%">Status</td>
                <td>
                    <select name="admin[status]">
                        <?php if($admin['status']==1): ?>
                        <option value="1" selected>Active</option>
                        <option value="2">Inactive</option>
                        <?php else: ?>
                        <option value="1">Active</option>
                        <option value="2" selected>Inactive</option>                
                        <?php endif; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="10%">&nbsp;</td>
                <td>
                    <input type="submit" name="submit" value="update">
                    <button type="button"><a href="index.php?c=admin&a=grid">Cancel</a></button>
                </td>
            </tr>
            
        </table>    
    </form>
</body>
</html>
