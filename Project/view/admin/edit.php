<?php
    $admin = $this->getAdmin();
?>

<h2>Admin</h2>
<form action="<?php echo $this->getUrl('save','admin',['id'=>$admin->adminId],true) ?>" method="POST">
    <table border="1" cellspacing="4">
        <input type="text" name="admin[adminId]" value="<?php echo $admin->adminId ?>" hidden>
        <tr>
            <td width="10%">First Name</td>
            <td><input type="text" name="admin[firstName]" value="<?php echo $admin->firstName ?>"></td>
        </tr>
        <tr>
            <td width="10%">Last Name</td>
            <td><input type="text" name="admin[lastName]" value="<?php echo $admin->lastName ?>"></td>
        </tr>
        <tr>
            <td width="10%">Email</td>
            <td><input type="text" name="admin[email]" value="<?php echo $admin->email ?>"></td>
        </tr>
        <tr>
            <td width="10%">Password</td>
            <td><input type="password" name="admin[password]" value="<?php echo $admin->password ?>"></td>
        </tr>
        <tr>
            <td width="10%">Status</td>
            <td>
                <select name="admin[status]">
                    <option value="1" <?php echo($admin->getStatus($admin->status)=='Active')?'selected':'' ?>>Active</option>
                    <option value="2" <?php echo($admin->getStatus($admin->status)=='Inactive')?'selected':'' ?>>Inactive</option>
                </select>
            </td>
        </tr>
        <tr>
            <td width="10%">&nbsp;</td>
            <td>
                <input type="submit" name="submit" value="Save">
                <button type="button"><a href="<?php echo $this->getUrl('grid','admin') ?>">Cancel</a></button>
            </td>
        </tr>
    </table>    
</form>
