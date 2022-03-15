<?php $customer = $this->getCustomer(); 
$billingAddress = $customer->getBillingAddress();
$shippingAddress = $customer->getShippingAddress(); ?>

<h2>Customer</h2>
<form action="<?php echo $this->getUrl('save','customer',['id'=>$customer->customerId],true) ?>" method="POST">
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
            <td colspan="2"><h3>Billing Address:</h3></td>
        </tr>
        <tr>
            <input type="text" name="billingAddress[customerId]" value="<?php echo $billingAddress->customerId ?>" hidden>
            <input type="text" name="billingAddress[addressId]" value="<?php echo $billingAddress->addressId ?>" hidden>
            <td>Address</td>
            <td><textarea name="billingAddress[address]" rows="4" cols="50"><?php echo $billingAddress->address; ?></textarea></td>
        </tr>
        <tr>
            <td>Zip code</td>
            <td><input type="text" name="billingAddress[zipcode]" value="<?php echo $billingAddress->zipcode; ?>"></td>
        </tr>
        <tr>
            <td>City</td>
            <td><input type="text" name="billingAddress[city]" value="<?php echo $billingAddress->city; ?>"></td>
        </tr>
        <tr>
            <td>State</td>
            <td><input type="text" name="billingAddress[state]" value="<?php echo $billingAddress->state; ?>"></td>
        </tr>
        <tr>
            <td>Country</td>
            <td><input type="text" name="billingAddress[country]" value="<?php echo $billingAddress->country; ?>"></td>
        </tr>
        <input type="hidden" name="billingAddress[billingAddress]" value="1">
        <input type="hidden" name="billingAddress[shipingAddress]" value="2">
        <tr>
            <td colspan="2"><h3>Shiping Address:</h3></td>
        </tr>
        <tr>
            <input type="text" name="shippingAddress[customerId]" value="<?php echo $shippingAddress->customerId ?>" hidden>
            <input type="text" name="shippingAddress[addressId]" value="<?php echo $shippingAddress->addressId ?>" hidden>
            <td>Address</td>
            <td><textarea name="shippingAddress[address]" rows="4" cols="50"><?php echo $shippingAddress->address; ?></textarea></td>
        </tr>
        <tr>
            <td>Zip code</td>
            <td><input type="text" name="shippingAddress[zipcode]" value="<?php echo $shippingAddress->zipcode; ?>"></td>
        </tr>
        <tr>
            <td>City</td>
            <td><input type="text" name="shippingAddress[city]" value="<?php echo $shippingAddress->city; ?>"></td>
        </tr>
        <tr>
            <td>State</td>
            <td><input type="text" name="shippingAddress[state]" value="<?php echo $shippingAddress->state; ?>"></td>
        </tr>
        <tr>
            <td>Country</td>
            <td><input type="text" name="shippingAddress[country]" value="<?php echo $shippingAddress->country; ?>"></td>
        </tr>
        <input type="hidden" name="shippingAddress[billingAddress]" value="2">
        <input type="hidden" name="shippingAddress[shipingAddress]" value="1">
        <tr>
            <td>&nbsp;</td>
            <td>
                <input type="submit" name="submit" value="Save">
                <button type="button"><a href="<?php echo $this->getUrl('grid','customer',[],true) ?>">Cancel</a></button>
            </td>
        </tr>
        
    </table>    
</form>
