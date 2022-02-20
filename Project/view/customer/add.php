<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add Customer</title>
</head>
<body>
    <h2>Add Customer</h2>
    <form action="<?php echo $this->getUrl('customer','save') ?>" method="post">
        <table border="1" cellspacing="4">
        <tr>
            <td colspan="2"><b>Personal Information</b></td>
        </tr>
        <tr>
            <td>First Name</td>
            <td><input type="text" name="customer[firstName]"></td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td><input type="text" name="customer[lastName]"></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" name="customer[email]"></td>
        </tr>
        <tr>
            <td>Mobile</td>
            <td><input type="text" name="customer[mobile]"></td>
        </tr>
        <tr>
            <td>Status</td>
            <td>
                <select name="customer[status]">
                    <option value="1" selected>Active</option>
                    <option value="2">Inactive</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2"><b>Address Information</b></td>
        </tr>
        <tr>
            <td>Address</td>
            <td><textarea name="address[address]" rows="4" cols="50"></textarea></td>
        </tr>
        <tr>
            <td>Zip code</td>
            <td><input type="number" name="address[zipcode]" minlength="6" maxlength="7"></td>
        </tr>
        <tr>
            <td>City</td>
            <td><input type="text" name="address[city]"></td>
        </tr>
        <tr>
            <td>State</td>
            <td><input type="text" name="address[state]"></td>
        </tr>
        <tr>
            <td>Country</td>
            <td><input type="text" name="address[country]"></td>
        </tr>
        <tr>
            <td>Address type</td>
            <td>
                <input type="checkbox" name="address[billing]" value="1" checked>
                <label> Billing</label>
                <input type="checkbox" name="address[shiping]" value="1">
                <label> Shiping</label>
            </td>
        </tr>
        <tr>
            <td width="10%">&nbsp;</td>
            <td>
                <input class="submit" type="submit" name='submit' id='submit' value="Save"  />
                <button type="button"><a href="<?php echo $this->getUrl('customer','grid') ?>">Cancel</a></button>
            </td>
        </tr>
    </table>
    </form>
</body>
</html>
