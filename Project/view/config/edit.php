<?php
    $config = $this->getConfig();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit config</title>
</head>
<body>
    <h2>config</h2>
    <form action="<?php echo $this->getUrl('save','config',['id'=>$config->configId],true) ?>" method="POST">
        <table border="1" cellspacing="7">
            
            <input type="text" name="config[configId]" value="<?php echo $config->configId ?>" hidden>
            <tr>
                <td>Config Name</td>
                <td><input type="text" name="config[name]" value="<?php echo $config->name ?>"></td>
            </tr>
            <tr>
                <td>Code</td>
                <td><input type="text" name="config[code]" value="<?php echo $config->code ?>"></td>
            </tr>
            <tr>
                <td>Value</td>
                <td><input type="text" name="config[value]" value="<?php echo $config->value ?>"></td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    <select name="config[status]">
                        <option value="1" <?php echo ($config->getStatus($config->status)=='Active')?'selected':'' ?>>Active</option>
                        <option value="2" <?php echo ($config->getStatus($config->status)=='Inactive')?'selected':'' ?>>Inactive</option>
                    </select>
                </td>
            </tr>
            
            <tr>
                <td>&nbsp;</td>
                <td>
                    <input type="submit" name="submit" value="Save">
                    <button type="button"><a href="<?php echo $this->getUrl('grid','config',[],true) ?>">Cancel</a></button>
                </td>
            </tr>
            
        </table>    
    </form>
</body>
</html>
