<form id="indexForm" action="<?php echo $this->getUrl('grid1','admin'); ?>" method="POST">
    <div id="indexContent">
    
    </div>
</form>

<script type="text/javascript">
    admin.setForm(jQuery('#indexForm'));
    admin.load();
</script>
