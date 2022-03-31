<?php $admin = $this->getAdmin();?>
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
    <?php if(!$admin->adminId):?>
        <tr>
            <td width="10%">Password</td>
            <td><input type="password" name="admin[password]" value="<?php echo $admin->password ?>"></td>
        </tr>
    <?php endif; ?>
    
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
            <button type="button" id="adminSubmitBtn">Save</button>
            <button type="button" id="adminCancelBtn">Cancel</button>
        </td>
    </tr>
</table>

<script>
    $("#adminSubmitBtn").click(function(){
        admin.setForm($("#indexForm"));
        admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
        admin.load();
    });

    $("#adminCancelBtn").click(function(){
        admin.setUrl("<?php echo $this->getUrl('gridBlock','admin'); ?>");
        admin.load();
    });
</script>
