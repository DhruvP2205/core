<?php
    $customers = $this->getCustomers();
    $addresses = $this->getAddresses();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Customer</title>
    <link rel="stylesheet" href="./src/css/style.css">
</head>
<body>
    <a href="<?php echo $this->getUrl('customer','add') ?>">Add Customer</a>
        <h2>All Records</h2>
        <table cellpadding="7px">
            <thead>
                <th>User ID</th>
                <th>First Name</th>  
                <th>Last Name</th>
                <th>Email</th>  
                <th>Mobile</th>
                <th>Status</th>
                <th>AddressID</th>
                <th>Address</th>
                <th>Zipcode</th>
                <th>City</th>
                <th>State</th>
                <th>Country</th>
                <th>Billing Address</th>
                <th>Shiping Address</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php
                    if(!$customers):?>
                        <tr><td colspan="10">No Record available.</td></tr>
                
            <?php else:
                foreach ($customers as $customer):
            ?>
            <tr>
                <td><?php echo($customer['customerID']); ?></td>
                <td><?php echo($customer['firstName']); ?></td>
                <td><?php echo($customer['lastName']); ?></td>
                <td><?php echo($customer['email']); ?></td>
                <td><?php echo($customer['mobile']); ?></td>
                <td>
                    <?php 
                        if($customer['status'] == 1){
                            echo("Active");
                        } 
                        else{
                            echo("Inactive");
                        } ?>
                </td>
                <?php foreach ($addresses as $address): ?>
                    <?php if($address['customerID']==$customer['customerID']): ?>
                        <td><?php echo($address['addressID']); ?></td>
                        <td><?php echo($address['address']); ?></td>
                        <td><?php echo($address['zipcode']); ?></td>
                        <td><?php echo($address['city']); ?></td>
                        <td><?php echo($address['state']); ?></td>
                        <td><?php echo($address['country']); ?></td>
                        <td>
                        
                            <?php 
                                if($address['billingAddress'] == 1):{
                                    echo("Yes");
                                } 
                                else:{
                                    echo("No");
                                }
                                endif; ?>
                        </td>
                        <td>
                            <?php 
                                if($address['shipingAddress'] == 1):
                                {
                                    echo("Yes");
                                } 
                                else:{
                                    echo("No");
                                }
                                endif; ?>
                        </td>
                    <?php endif; ?>

                <?php endforeach;   ?>
                <td>
                    <a href="<?php echo $this->getUrl('customer','edit',['id'=>$customer['customerID']],true) ?>">Edit</a>
                    <a href="<?php echo $this->getUrl('customer','delete',['id'=>$customer['customerID']],true) ?>">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php endif;?>
        </tbody>
    </table>
</body>
</html>
