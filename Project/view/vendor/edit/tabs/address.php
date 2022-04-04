<?php $address = $this->getAddress(); ?>

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Address</h3>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <label for="Address" class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="address[address]" id="address[address]" rows="3" placeholder="Address"><?php echo $address->address; ?></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="Zip code" class="col-sm-2 col-form-label">Zip code</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="address[zipcode]" id="address[zipcode]" value="<?php echo $address->zipcode; ?>" placeholder="Zip code">
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">City</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="address[city]" id="address[city]" value="<?php echo $address->city; ?>" placeholder="City">
            </div>
        </div>
        <div class="form-group row">
            <label for="state" class="col-sm-2 col-form-label">State</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="address[state]" id="address[state]" value="<?php echo $address->state; ?>" placeholder="State">
            </div>
        </div>
        <div class="form-group row">
            <label for="country" class="col-sm-2 col-form-label">Country</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="address[country]" id="address[country]" value="<?php echo $address->country; ?>" placeholder="Country">
            </div>
        </div>        
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="button" class="btn btn-info" id="vendorSubmitBtn">Save</button>
            <button type="button" class="btn btn-default" id="vendorCancelBtn">Cancel</button>
        </div>
        <!-- /.card-footer -->
    </div>
</div>


<script>
    $("#vendorSubmitBtn").click(function(){
        admin.setForm($("#indexForm"));
        admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
        admin.load();
    });

    $("#vendorCancelBtn").click(function(){
        admin.setUrl("<?php echo $this->getUrl('gridBlock','customer'); ?>");
        admin.load();
    });
</script>
