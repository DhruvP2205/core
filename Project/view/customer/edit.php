<?php
    $customer = $this->getCustomer();
    $address = $this->getAddress();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit customer</title>
</head>
<body>
    <h2>Edit customer</h2>
    <form action="<?php echo $this->getUrl('save','customer',['id'=>$customer->customerId],true) ?>" method="POST">
        <table border="1" width="100%" cellspacing="4">

            <tr>
                <td colspan="2">Personal Information:</td>
                <td><input type="text" name="customer[customerId]" value="<?php echo $customer->customerId ?>" hidden></td>
            </tr>
            <tr>
                <td width="10%">First Name</td>
                <td><input type="text" name="customer[firstName]" value="<?php echo $customer->firstName; ?>"></td>
            </tr>
            <tr>
                <td width="10%">Last Name</td>
                <td><input type="text" name="customer[lastName]" value="<?php echo $customer->lastName; ?>"></td>
            </tr>
            <tr>
                <td width="10%">Email</td>
                <td><input type="text" name="customer[email]" value="<?php echo $customer->email; ?>"></td>
            </tr>
            <tr>
                <td width="10%">Mobile</td>
                <td><input type="text" name="customer[mobile]" value="<?php echo $customer->mobile; ?>"></td>
            </tr>
            <tr>
                <td width="10%">Status</td>
                <td>
                    <select name="customer[status]">
                        <option value="1" <?php echo ($customer->getStatus($customer->status)==1)?'selected':'' ?>>Active</option>
                        <option value="2" <?php echo ($customer->getStatus($customer->status)==2)?'selected':'' ?>>Inactive</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">Address Information:</td>
            </tr>
            <tr>
                <input type="text" name="address[customerId]" value="<?php echo $address->customerId ?>" hidden>
                <input type="text" name="address[addressId]" value="<?php echo $address->addressId ?>" hidden>
                <td width="10%">Address</td>
                <td><textarea name="address[address]" rows="4" cols="50"><?php echo $address->address; ?></textarea></td>
            </tr>
            <tr>
                <td width="10%">Zip code</td>
                <td><input type="text" name="address[zipcode]" value="<?php echo $address->zipcode; ?>"></td>
            </tr>
            <tr>
                <td width="10%">City</td>
                <td><input type="text" name="address[city]" value="<?php echo $address->city; ?>"></td>
            </tr>
            <tr>
                <td width="10%">State</td>
                <td><input type="text" name="address[state]" value="<?php echo $address->state; ?>"></td>
            </tr>
            <tr>
                <td width="10%">Country</td>
                <td><input type="text" name="address[country]" value="<?php echo $address->country; ?>"></td>
            </tr>
            <tr>
                <td width="10%">Address Type</td>
                <td>
                    <input type="checkbox" name="address[billingAddress]" value="1" <?php echo ($address->getStatus($address->billingAddress)=='Active')?'checked':'' ?>>
                    <label> Billing</label>
                    <input type="checkbox" name="address[shipingAddress]" value="1" <?php echo ($address->getStatus($address->shipingAddress)=='Active')?'checked':'' ?>>
                    <label> Shiping</label>
                </td>
            </tr>
            <tr>
                <td width="10%">&nbsp;</td>
                <td>
                    <input type="submit" name="submit" value="update">
                    <button type="button"><a href="<?php echo $this->getUrl('grid','customer',[],true) ?>">Cancel</a></button>
                </td>
            </tr>
            
        </table>    
    </form>
</body>
</html>
