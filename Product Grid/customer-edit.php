<?php
    require_once('Adapter.php');

    $customerID = $_GET['id'];

    $adapter = new Adapter();
    $customer = $adapter->fetchRow("select * FROM customer WHERE customerID = '$customerID'");
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
    <form action="customer-index.php?a=saveAction&id=<?php echo $customerID ?>" method="POST">
        <table border="1" width="100%" cellspacing="4">
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
                <td width="10%">&nbsp;</td>
                <td>
                    <input type="submit" name="submit" value="update">
                    <button type="button"><a href="customer-index.php?a=gridAction">Cancel</a></button>
                </td>
            </tr>
            
        </table>    
    </form>
</body>
</html>
