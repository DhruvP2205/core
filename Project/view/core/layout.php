<?php echo $this->getHead()->toHtml(); ?>
<body>
    <table border="1" width="100%">
        <tr>
            <th><?php echo $this->getHeader()->toHtml(); ?></th>
        </tr>
        <tr>
            <td><?php echo $this->getContent()->toHtml(); ?></td>
        </tr>
        <tr>
            <td><?php echo $this->getFooter()->toHtml(); ?></td>
        </tr>
    </table>
</body>
