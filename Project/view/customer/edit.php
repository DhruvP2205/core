<?php
    $customer = $this->getCustomer();
    $address = $this->getAddress();
?>

    <h2>Customer</h2>
    <form action="<?php echo $this->getUrl('save','customer',['id'=>$customer->customerId],true) ?>" method="POST">
        <table border="1" cellspacing="7">
            <tr>
                <td colspan="2">Personal Information:</td>
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
                <td colspan="2">Address Information:</td>
            </tr>
            <tr>
                <input type="text" name="address[customerId]" value="<?php echo $address->customerId ?>" hidden>
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
                <td>Address Type</td>
                <td>
                    <input type="checkbox" name="address[billingAddress]" value="1" <?php echo ($address->getStatus($address->billingAddress)=='Active')?'checked':'' ?>>
                    <label> Billing</label>
                    <input type="checkbox" name="address[shipingAddress]" value="1" <?php echo ($address->getStatus($address->shipingAddress)=='Active')?'checked':'' ?>>
                    <label> Shiping</label>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <input type="submit" name="submit" value="Save">
                    <button type="button"><a href="<?php echo $this->getUrl('grid','customer',[],true) ?>">Cancel</a></button>
                </td>
            </tr>
            
        </table>    
    </form>
