<?php
    $vendor = $this->getVendor();
    $address = $this->getAddress();
?>

    <h2>Vendor</h2>
    <form action="<?php echo $this->getUrl('save','vendor',['id'=>$vendor->vendorId],true) ?>" method="POST">
        <table border="1" cellspacing="7">
            <tr>
                <td colspan="2">Personal Information:</td>
                <input type="text" name="vendor[vendorId]" value="<?php echo $vendor->vendorId ?>" hidden>
            </tr>
            <tr>
                <td>First Name</td>
                <td><input type="text" name="vendor[firstName]" value="<?php echo $vendor->firstName; ?>"></td>
            </tr>
            <tr>
                <td>Last Name</td>
                <td><input type="text" name="vendor[lastName]" value="<?php echo $vendor->lastName; ?>"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="vendor[email]" value="<?php echo $vendor->email; ?>"></td>
            </tr>
            <tr>
                <td>Mobile</td>
                <td><input type="text" name="vendor[mobile]" value="<?php echo $vendor->mobile; ?>"></td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    <select name="vendor[status]">
                        <option value="1" <?php echo ($vendor->getStatus($vendor->status)=='Active')?'selected':'' ?>>Active</option>
                        <option value="2" <?php echo ($vendor->getStatus($vendor->status)=='Inactive')?'selected':'' ?>>Inactive</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">Address Information:</td>
            </tr>
            <tr>
                <input type="text" name="address[vendorId]" value="<?php echo $address->vendorId ?>" hidden>
                <input type="text" name="address[addressId]" value="<?php echo $address->addressId ?>" hidden>
                <td>Address</td>
                <td><textarea name="address[address]" rows="4" cols="50"><?php echo $address->address; ?></textarea></td>
            </tr>
            <tr>
                <td>Zip code</td>
                <td><input type="text" name="address[zipcode]" value="<?php echo $address->zipcode; ?>"></td>
            </tr>
            <tr>
                <td>City</td>
                <td><input type="text" name="address[city]" value="<?php echo $address->city; ?>"></td>
            </tr>
            <tr>
                <td>State</td>
                <td><input type="text" name="address[state]" value="<?php echo $address->state; ?>"></td>
            </tr>
            <tr>
                <td>Country</td>
                <td><input type="text" name="address[country]" value="<?php echo $address->country; ?>"></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <input type="submit" name="submit" value="Save">
                    <button type="button"><a href="<?php echo $this->getUrl('grid','vendor',[],true) ?>">Cancel</a></button>
                </td>
            </tr>
            
        </table>    
    </form>
