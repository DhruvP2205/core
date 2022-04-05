<?php $cart = $this->getCart();
$shippingMethods = $this->getShippingMethod();
$paymentMethods = $this->getPaymentMethod(); ?>


<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Payment & Shipping Information</h3>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Payment Method</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <?php foreach($paymentMethods as $paymentMethod): ?>
                                        <tr>
                                            <td>
                                                <input type="radio" name="paymentMethod" value="<?php echo $paymentMethod->methodId ?>" <?php echo ($cart->paymentMethod == $paymentMethod->methodId) ? 'checked': ''; ?>> &nbsp;<?php echo $paymentMethod->name?>
                                            </td>
                                        </tr>
                                        <?php endforeach;?>
                                        <tr>
                                            <td><input type="button" id="cartPaymentMethodSubmitBtn" class="col-sm-12 btn btn-success" name="submit" value="Update"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Shipping Charge</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <?php foreach($shippingMethods as $shippingMethod): ?>
                                        <tr>
                                            <td>
                                                <input type="radio" name="shippingMethod" value="<?php echo $shippingMethod->methodId ?>" <?php echo ($cart->shippingMethod == $shippingMethod->methodId) ? 'checked': ''; ?>> &nbsp;<?php echo $shippingMethod->name?>
                                            </td>
                                            <td>
                                                <?php echo $shippingMethod->charge ?>
                                            </td>
                                        </tr>
                                        <?php endforeach;?>
                                        <tr>
                                            <td colspan="2"><input type="button" id="cartShipingMethodSubmitBtn" class="col-sm-12 btn btn-success" name="submit" value="Update"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#cartPaymentMethodSubmitBtn").click(function(){
        admin.setForm(jQuery("#indexForm"));
        admin.setUrl("<?php echo $this->getUrl('savePaymentMethod') ?>");
        admin.load();
    });

    $("#cartShipingMethodSubmitBtn").click(function(){
        admin.setForm(jQuery("#indexForm"));
        admin.setUrl("<?php echo $this->getUrl('saveShipingMethod') ?>");
        admin.load();
    });
</script>
