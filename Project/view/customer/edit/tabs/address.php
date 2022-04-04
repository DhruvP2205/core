<?php $billingAddress = $this->getBillingAddress();?>
<?php $shippingAddress = $this->getShippingAddress();?>

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Billing Address</h3>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <label for="Address" class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="billingAddress[address]" id="billingAddress[address]" rows="3" placeholder="Address"><?php echo $billingAddress->address; ?></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="Zip code" class="col-sm-2 col-form-label">Zip code</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="billingAddress[zipcode]" id="billingAddress[zipcode]" value="<?php echo $billingAddress->zipcode; ?>" placeholder="Zip code">
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">City</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="billingAddress[city]" id="billingAddress[city]" value="<?php echo $billingAddress->city; ?>" placeholder="City">
            </div>
        </div>
        <div class="form-group row">
            <label for="state" class="col-sm-2 col-form-label">State</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="billingAddress[state]" id="billingAddress[state]" value="<?php echo $billingAddress->state; ?>" placeholder="State">
            </div>
        </div>
        <div class="form-group row">
            <label for="country" class="col-sm-2 col-form-label">Country</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="billingAddress[country]" id="billingAddress[country]" value="<?php echo $billingAddress->country; ?>" placeholder="Country">
            </div>
        </div>
    </div>
    <div class="card-header">
        <h3 class="card-title">Shiping Address</h3>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <label for="Address" class="col-sm-2 col-form-label">&nbsp;</label>
            <div class="col-sm-10">
                 <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="copyAddress" id="copyAddress" value="option1" onchange="sameAddress()">
                    <label for="copyAddress" class="form-check-label">Same as Billing Address</label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="Address" class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="shippingAddress[address]" id="shippingAddress[address]" rows="3" placeholder="Address"><?php echo $shippingAddress->address; ?></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="Zip code" class="col-sm-2 col-form-label">Zip code</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="shippingAddress[zipcode]" id="shippingAddress[zipcode]" value="<?php echo $shippingAddress->zipcode; ?>" placeholder="Zip code">
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">City</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="shippingAddress[city]" id="shippingAddress[city]" value="<?php echo $shippingAddress->city; ?>" placeholder="City">
            </div>
        </div>
        <div class="form-group row">
            <label for="state" class="col-sm-2 col-form-label">State</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="shippingAddress[state]" id="shippingAddress[state]" value="<?php echo $shippingAddress->state; ?>" placeholder="State">
            </div>
        </div>
        <div class="form-group row">
            <label for="country" class="col-sm-2 col-form-label">Country</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="shippingAddress[country]" id="shippingAddress[country]" value="<?php echo $shippingAddress->country; ?>" placeholder="Country">
            </div>
        </div>
        
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="button" class="btn btn-info" id="customerSubmitBtn">Save</button>
            <button type="button" class="btn btn-default" id="customerCancelBtn">Cancel</button>
        </div>
        <!-- /.card-footer -->
    </div>
</div>

<script type="text/javascript">
    function sameAddress()
    {
        var checkedBox = document.getElementById("copyAddress");
        
        if(checkedBox.checked == true){
            document.getElementById("shippingAddress[address]").value = document.getElementById("billingAddress[address]").value; 
            document.getElementById("shippingAddress[zipcode]").value = document.getElementById("billingAddress[zipcode]").value; 
            document.getElementById("shippingAddress[city]").value = document.getElementById("billingAddress[city]").value; 
            document.getElementById("shippingAddress[state]").value = document.getElementById("billingAddress[state]").value; 
            document.getElementById("shippingAddress[country]").value = document.getElementById("billingAddress[country]").value; 
        }
        else
        {
                document.getElementById("shippingAddress[address]").value = null; 
                document.getElementById("shippingAddress[zipcode]").value = null; 
                document.getElementById("shippingAddress[city]").value = null; 
                document.getElementById("shippingAddress[state]").value = null; 
                document.getElementById("shippingAddress[country]").value = null; 
        }
    }
</script>
<script>
    $("#customerSubmitBtn").click(function(){
        admin.setForm($("#indexForm"));
        admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
        admin.load();
    });

    $("#customerCancelBtn").click(function(){
        admin.setUrl("<?php echo $this->getUrl('gridBlock','customer'); ?>");
        admin.load();
    });
</script>
