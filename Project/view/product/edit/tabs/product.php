<?php $product = $this->getProduct(); ?>

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Product Information</h3>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <label for="Name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="hidden" name="product[productId]" value="<?php echo $product->productId ?>" class="form-control" id="productId">
                <input type="text" name="product[name]" value="<?php echo $product->name ?>" class="form-control" id="Name" placeholder="Name">
            </div>
        </div>
        <div class="form-group row">
            <label for="sku" class="col-sm-2 col-form-label">sku</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="product[sku]" value="<?php echo $product->sku ?>" id="sku" placeholder="Sku">
            </div>
        </div>
        <div class="form-group row">
            <label for="price" class="col-sm-2 col-form-label">Price</label>
            <div class="col-sm-10">
                <input type="float" name="product[price]" value="<?php echo $product->price ?>" class="form-control" id="price" placeholder="Price">
            </div>
        </div>
        <div class="form-group row">
            <label for="costPrice" class="col-sm-2 col-form-label">Cost Price</label>
            <div class="col-sm-10">
                <input type="float" name="product[costPrice]" value="<?php echo $product->costPrice ?>" class="form-control" id="costPrice" placeholder="Cost Price">
            </div>
        </div>
        <div class="form-group row">
            <label for="msp" class="col-sm-2 col-form-label">MSP</label>
            <div class="col-sm-10">
                <input type="float" name="product[msp]" value="<?php echo $product->msp ?>" class="form-control" id="msp" placeholder="MSP">
            </div>
        </div>
        <div class="form-group row">
            <label for="discount" class="col-sm-2 col-form-label">Discount</label>
            <div class="col-sm-10">
                <input type="float" name="product[discount]" value="<?php echo $product->discount ?>" class="form-control" id="discount" placeholder="Discount">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3">
            </div>
            <div class="col-sm-4">
                <input type="radio" class="form-check-input" name="discountMethod" value="1">
                <label class="form-check-label">In Percentage</label>
            </div>
            <div class="col-sm-5">
                <input type="radio" class="form-check-input" name="discountMethod" value="2" checked>
                <label class="form-check-label">In Money</label>
            </div>
        </div>
        <div class="form-group row">
            <label for="tax" class="col-sm-2 col-form-label">Tax</label>
            <div class="col-sm-10">
                <input type="float" name="product[tax]" value="<?php echo $product->tax ?>" class="form-control" id="tax" placeholder="Tax">
            </div>
        </div>
        <div class="form-group row">
            <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
            <div class="col-sm-10">
                <input type="number" name="product[quantity]" value="<?php echo $product->quantity ?>" class="form-control" id="quantity" placeholder="Quantity">
            </div>
        </div>
        <div class="form-group row">
            <label for="status" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
                <select class="form-control" name="product[status]" id="pageSelect">
                    <option value="1" <?php echo($product->getStatus($product->status)=='Active')?'selected':'' ?>>Active</option>
                    <option value="2" <?php echo($product->getStatus($product->status)=='Inactive')?'selected':'' ?>>Inactive</option>
                </select>
            </div>
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-info" id="productFormSubmitBtn">Save</button>
            <button type="button" class="btn btn-default" id="productFromCancelBtn">Cancel</button>
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#productFormSubmitBtn").click(function(){
        admin.setForm($("#indexForm"));
        admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
        admin.load();
    });

    $("#productFromCancelBtn").click(function(){
        admin.setUrl("<?php echo $this->getUrl('gridBlock','product',['id' => null]); ?>");
        admin.load();
    });
</script>

