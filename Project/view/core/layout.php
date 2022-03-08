<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/css/style.css">
    <title>QuestCom</title>
</head>
<body>
    <table border="1" width="100%">
        <tr>
            <th><?php $this->getHeader()->toHtml(); ?></th>
        </tr>
        <tr>
            <td><?php $this->getContent()->toHtml(); ?></td>
        </tr>
        <tr>
            <td><?php $this->getFooter()->toHtml(); ?></td>
        </tr>
    </table>
</body>
</html>
