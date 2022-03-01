<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layout</title>
</head>
<body>
    <br>
    <table border="1" width="95%" align="center" cellpadding="15">
        <tr>
            <td colspan="3" align="center"><?php print_r($this->getHeader()->getData('name')); ?></td>
        </tr>
        <tr>
            <td align="center">Left Panel</td>
            <td align="center"><?php print_r($this->getContent()->getData('name')); ?></td>
            <!-- <td><?php $this->getContent()->toHtml(); ?></td> -->
            <td align="center">Right Panel</td>
        </tr>
        <tr>
            <td colspan="3" align="center"><?php print_r($this->getFooter()->getData('name')); ?></td>
        </tr>
    </table>
</body>
</html>
