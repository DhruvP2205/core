<?php
    require_once('Adapter.php');

    $adapter = new Adapter();
    $customers = $adapter->fetchAll("SELECT c.`customerID`, c.`firstName`, c.`lastName`, c.`email`, c.`mobile`, c.`status`, c.`createdDate`, c.`updatedDate`, a.`addressID`, a.`address`, a.`zipcode`, a.`city`, a.`state`, a.`country`, a.`billingAddress`,a.`shipingAddress`, a.`createdDate`, a.`updatedDate` FROM `customer` c LEFT JOIN `address` a ON c.customerID = a.customerID ORDER BY c.customerID ASC");
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
    <a href='customer-index.php?a=addAction'>Add Customer</a>
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
                    <td><?php echo($customer['addressID']); ?></td>
                    <td><?php echo($customer['address']); ?></td>
                    <td><?php echo($customer['zipcode']); ?></td>
                    <td><?php echo($customer['city']); ?></td>
                    <td><?php echo($customer['state']); ?></td>
                    <td><?php echo($customer['country']); ?></td>
                    <td>
                        <?php 
                            if($customer['billingAddress'] == 1){
                                echo("Yes");
                            } 
                            else{
                                echo("No");
                            } ?>
                    </td>
                    <td>
                        <?php 
                            if($customer['shipingAddress'] == 1){
                                echo("Yes");
                            } 
                            else{
                                echo("No");
                            } ?>
                    </td>
                    <!-- <td><?php echo($customer['createdDate']); ?></td>
                    <td><?php echo($customer['updatedDate']); ?></td> -->
                    <td>
                        <a href="customer-index.php?a=editAction&id=<?php echo $customer['customerID'] ?>">Edit</a>
                        <a href="customer-index.php?a=deleteAction&id=<?php echo $customer['customerID'] ?>">Delete</a>
                    </td>
                </tr>
                <?php
                        endforeach;
                    endif;
                ?>
        </tbody>
    </table>
</body>
</html>
