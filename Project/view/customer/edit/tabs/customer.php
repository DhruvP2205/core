<?php $customer = $this->getCustomer(); ?>
<table border="1" cellspacing="7">
    <tr>
        <td colspan="2"><h3>Personal Information:</h3></td>
        <input type="text" name="customer[customerId]" value="<?php echo $customer->customerId ?>" hidden>
    </tr>
    <tr>
        <td>First Name</td>
        <td><input type="text" name="customer[firstName]" value="<?php echo $customer->firstName; ?>"></td>
    </tr>
    <tr>
        <td>Last Name</td>
        <td><input type="text" name="customer[lastName]" value="<?php echo $customer->lastName; ?>"></td>
    </tr>
    <tr>
        <td>Email</td>
        <td><input type="text" name="customer[email]" value="<?php echo $customer->email; ?>"></td>
    </tr>
    <tr>
        <td>Mobile</td>
        <td><input type="text" name="customer[mobile]" value="<?php echo $customer->mobile; ?>"></td>
    </tr>
    <tr>
        <td>Status</td>
        <td>
            <select name="customer[status]">
                <option value="1" <?php echo ($customer->getStatus($customer->status)=='Active')?'selected':'' ?>>Active</option>
                <option value="2" <?php echo ($customer->getStatus($customer->status)=='Inactive')?'selected':'' ?>>Inactive</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>
            <input type="button" id="submit" name="submit" value="Save">
            <button type="button"><a href="<?php echo $this->getUrl('grid','customer',[],true) ?>">Cancel</a></button>
        </td>
    </tr>
</table>

