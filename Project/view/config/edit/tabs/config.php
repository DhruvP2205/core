<?php $config = $this->getConfig();?>

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Config Information</h3>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <label for="configName" class="col-sm-2 col-form-label">Config Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="config[configId]" id="configId" value="<?php echo $config->configId; ?>" hidden>
                <input type="text" class="form-control" name="config[name]" id="configName" value="<?php echo $config->name; ?>" placeholder="Config Name">
            </div>
        </div>
        <div class="form-group row">
            <label for="code" class="col-sm-2 col-form-label">Code</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  name="config[code]" id="code" value="<?php echo $config->code; ?>" placeholder="Code">
            </div>
        </div>
        <div class="form-group row">
            <label for="code" class="col-sm-2 col-form-label">Value</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  name="config[value]" id="code" value="<?php echo $config->value; ?>" placeholder="Value">
            </div>
        </div>
        <div class="form-group row">
            <label for="status" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
                <select class="form-control" name="config[status]">
                    <option value="1" <?php echo($config->getStatus($config->status)=='Active')?'selected':'' ?>>Active</option>
                    <option value="2" <?php echo($config->getStatus($config->status)=='Inactive')?'selected':'' ?>>Inactive</option>
                </select>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="button" class="btn btn-info" id="configSubmitBtn">Save</button>
            <button type="button" class="btn btn-default" id="configCancelBtn">Cancel</button>
        </div>
        <!-- /.card-footer -->
    </div>
</div>

<script>
    $("#configSubmitBtn").click(function(){
        admin.setForm($("#indexForm"));
        admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
        admin.load();
    });

    $("#configCancelBtn").click(function(){
        admin.setUrl("<?php echo $this->getUrl('gridBlock','config'); ?>");
        admin.load();
    });
</script>
