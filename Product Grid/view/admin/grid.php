<?php
    $adapter = new Model_Core_Adapter();
    $admins = $this->getData('admins');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin</title>
    <link rel="stylesheet" href="./src/css/style.css">
</head>
<body>
    <a href='index.php?c=admin&a=add'>Add Admin</a>
            <h2>All Records</h2>
            <table cellpadding="7px">
                <thead>
                    <th>Admin ID</th>
                    <th>First Name</th>  
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Status</th>
                    <th>Created Date</th>
                    <th>Upadated Date</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
                        if(!$admins):?>
                            <tr><td colspan="10">No Record available.</td></tr>
                    
                <?php else:
                    foreach ($admins as $admin):
                ?>
                <tr>
                    <td><?php echo($admin['adminID']); ?></td>
                    <td><?php echo($admin['firstName']); ?></td>
                    <td><?php echo($admin['lastName']); ?></td>
                    <td><?php echo($admin['email']); ?></td>
                    <td><?php echo($admin['password']); ?></td>
                    <td>
                        <?php 
                            if($admin['status'] == 1){
                                echo("Active");
                            } 
                            else{
                                echo("Inactive");
                            } ?>
                    </td>
                    <td><?php echo($admin['createdDate']); ?></td>
                    <td><?php echo($admin['updatedDate']); ?></td>
                    <td>
                        <a href="index.php?c=admin&a=edit&id=<?php echo $admin['adminID'] ?>">Edit</a>
                        <a href="index.php?c=admin&a=delete&id=<?php echo $admin['adminID'] ?>">Delete</a>
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
