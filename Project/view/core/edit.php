<form action="<?php echo $this->getEditUrl() ?>" method="POST">
<?php
    $this->getTab()->toHtml();
    $this->getTabContent()->toHtml();
?>
</form>
