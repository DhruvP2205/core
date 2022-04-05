<?php $cart = $this->getCart();
$items = $this->getItems();
$disabled = (!$items) ? 'disabled' : ""; ?>

<div class="col-md-4 float-right">
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Bill</h3>
        </div>
        <div class="card-body">
            <form action="<?php echo $this->getUrl('placeOrder') ?>" method="POST">
                <table>
                    <tr>
                        <td align="center">Subtotal</td>
                        <td align="center"><?php echo (!$this->getTotal()) ? '0' : $this->getTotal(); ?></td>
                    </tr>
                    <tr>
                        <td align="center">Shipping</td>
                        <td align="center"><?php echo (!$cart->shippingCharge) ? '0' : $cart->shippingCharge;?></td>
                    </tr>
                    <tr>
                        <td align="center">Tax</td>
                        <td align="center"><?php echo (!$this->getTax($cart->cartId)) ? '0' : $this->getTax($cart->cartId); ?></td>
                    </tr>
                    <tr>
                        <td align="center">Discount</td>
                        <td align="center"><?php echo $cart->discount; ?></td>
                    </tr>
                    <tr>
                        <td align="center">Grand Total</td>
                        <input type="hidden" name="grandTotal" value="<?php echo $this->getTotal() + ($cart->shippingCharge) + $this->getTax($cart->cartId) - ($cart->discount); ?>">
                        <input type="hidden" name="discount" value="<?php echo $cart->discount;?>">
                        <input type="hidden" name="taxAmount" value="<?php echo $this->getTax($cart->cartId); ?>">
                        <td align="center"><?php echo $this->getTotal() + ($cart->shippingCharge) + $this->getTax($cart->cartId) - ($cart->discount); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="right"><input type="button" class="btn btn-success my-1" id="placeOrderBtn" value="Place Order" <?php echo $disabled; ?>></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
 
<script>
    $("#placeOrderBtn").click(function(){
        admin.setForm(jQuery("#indexForm"));
        admin.setData({
            'grandTotal' : <?php echo $this->getTotal() + ($cart->shippingCharge) + $this->getTax($cart->cartId) - ($cart->discount); ?>,
            'discount' : <?php echo $cart->discount;?>,
            'taxAmount' : <?php echo $this->getTax($cart->cartId); ?>,
            });
        admin.setDataType('POST');
        admin.setUrl("<?php echo $this->getUrl('placeOrder') ?>");
        admin.load();
    });
</script>
