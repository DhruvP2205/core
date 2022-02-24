<?php $configs = $this->getConfigs(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Product</title>
    <link rel="stylesheet" href="./src/css/style.css">
</head>
<body>
    <a href="<?php echo $this->getUrl('product','add') ?>">Add Config</a>
            <h2>All Records</h2>
            <table cellpadding="7px">
                <thead>
                    <th>Config ID</th>
                    <th>Name</th>  
                    <th>Code</th>
                    <th>Value</th>  
                    <th>Status</th>
                    <th>Created Date</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
                        if(!$configs):?>
                            <tr><td colspan="10">No Record available.</td></tr>
                    
                <?php else:
                    foreach ($configs as $config):
                ?>
                <tr>
                    <td><?php echo($config->configId); ?></td>
                    <td><?php echo($config->name); ?></td>
                    <td><?php echo($config->code); ?></td>
                    <td><?php echo($config->value); ?></td>
                    <td>
                        <?php 
                            if($config->status == 1){
                                echo("Active");
                            } 
                            else{
                                echo("Inactive");
                            } ?>
                    </td>
                    <td><?php echo($config->createdDate); ?></td>
                    <td>
                        <a href="index.php?c=config&a=edit&id=<?php echo $config->configId; ?>">Edit</a>
                        <a href="index.php?c=config&a=delete&id=<?php echo $config->configId; ?>">Delete</a>
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
