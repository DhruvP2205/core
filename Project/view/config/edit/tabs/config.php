<?php $config = $this->getConfig();?>

<h2>config</h2>
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
            <input type="button" name="submit" id="submit" value="Save">
            <button type="button" id="cancel">Cancel</button>
        </td>
    </tr>
</table>


<script type="text/javascript">
    $("#submit").click(function(){
        admin.setForm($("#form-admin"));
        admin.callSaveAjax();
        admin.setUrl("<?php echo $this->getUrl('grid1'); ?>");
        admin.load();
    });
    $(document).on('click','#cancel',function () {
        event.preventDefault();
        $.ajax({
            type: 'GET',
            url: "<?php echo $this->getUrl('grid1'); ?>",
            success: function(data) {
                $('#content').html(data);
            },
            dataType : 'html'
        });
    });
</script>
