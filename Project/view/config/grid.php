<?php $configs = $this->getConfigs(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Config</title>
    <link rel="stylesheet" href="./src/css/style.css">
</head>
<body>
    <a href="<?php echo $this->getUrl('add','config') ?>">Add Config</a>
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
                    <td><?php echo $config->getStatus($config->status)?></td>
                    <td><?php echo($config->createdDate); ?></td>
                    <td>
                        <a href="<?php echo $this->getUrl('edit','config',['id'=>$config->configId],true) ?>">Edit</a>
                        <a href="<?php echo $this->getUrl('delete','config',['id'=>$config->configId],true) ?>">Delete</a>
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
