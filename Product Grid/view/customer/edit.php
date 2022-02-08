<?php
try {
    if(!isset($_GET['id'])){
        throw new Exception("Invalid Request.", 1);
    }
    if(!(int)$_GET['id']){
        throw new Exception("Invalid Request.", 1);
    }

    $customerID = $_GET['id'];

    $adapter = new Model_Core_Adapter();
    $customer = $adapter->fetchRow("SELECT c.`customerID`, c.`firstName`, c.`lastName`, c.`email`, c.`mobile`, c.`status`, a.`addressID`, a.`address`, a.`zipcode`, a.`city`, a.`state`, a.`country`, a.`billingAddress`,a.`shipingAddress` FROM `customer` c LEFT JOIN `address` a ON c.customerID = a.customerID WHERE c.customerID = '$customerID' ORDER BY c.customerID ASC");
} catch (Exception $e) {
    /*echo $e->getMessage();*/
    $this->redirect('index.php?a=grid');
}
    
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
    <form action="index.php?c=customer&a=save&id=<?php echo $customerID ?>" method="POST">
        <table border="1" width="100%" cellspacing="4">
            <tr>
                <td colspan="2">Personal Information:</td>
            </tr>
            <tr>
                <td width="10%">First Name</td>
                <td><input type="text" name="customer[firstName]" value="<?php echo $customer['firstName'] ?>"></td>
            </tr>
            <tr>
                <td width="10%">Last Name</td>
                <td><input type="text" name="customer[lastName]" value="<?php echo $customer['lastName'] ?>"></td>
            </tr>
            <tr>
                <td width="10%">Email</td>
                <td><input type="text" name="customer[email]" value="<?php echo $customer['email'] ?>"></td>
            </tr>
            <tr>
                <td width="10%">Mobile</td>
                <td><input type="text" name="customer[mobile]" value="<?php echo $customer['mobile'] ?>"></td>
            </tr>
            <tr>
                <td width="10%">Status</td>
                <td>
                    <select name="customer[status]">
                        <?php if($customer['status']==1): ?>
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
                <td colspan="2">Address Information:</td>
            </tr>
            <tr>
                <td width="10%">Address</td>
                <td><textarea name="address[address]" rows="4" cols="50" required><?php echo $customer['address'] ?></textarea></td>
            </tr>
            <tr>
                <td width="10%">Zip code</td>
                <td><input type="text" name="address[zipcode]" value="<?php echo $customer['zipcode'] ?>"></td>
            </tr>
            <tr>
                <td width="10%">City</td>
                <td><input type="text" name="address[city]" value="<?php echo $customer['city'] ?>"></td>
            </tr>
            <tr>
                <td width="10%">State</td>
                <td><input type="text" name="address[state]" value="<?php echo $customer['state'] ?>"></td>
            </tr>
            <tr>
                <td width="10%">Country</td>
                <td><input type="text" name="address[country]" value="<?php echo $customer['country'] ?>"></td>
            </tr>
            <tr>
                <td width="10%">Address Type</td>
                <td>
                    <?php if($customer['billingAddress'] == 1): ?>
                    <input type="checkbox" name="address[billing]" value="1" checked>
                    <label> Billing</label>
                    <?php else: ?>
                    <input type="checkbox" name="address[billing]" value="1">
                    <label> Billing</label>
                    <?php endif; ?>
                    <?php if($customer['shipingAddress'] == 1): ?>
                    <input type="checkbox" name="address[shiping]" value="1" checked>
                    <label> Shiping</label>
                    <?php else: ?>
                    <input type="checkbox" name="address[shiping]" value="1">
                    <label> Shiping</label>
                    <?php endif; ?>
                    <br>
                    <br>
                </td>
            </tr>
            <tr>
                <td width="10%">&nbsp;</td>
                <td>
                    <input type="submit" name="submit" value="update">
                    <button type="button"><a href="index.php?c=customer&a=grid">Cancel</a></button>
                </td>
            </tr>
            
        </table>    
    </form>
</body>
</html>
