<?php 
$cart = $this->getCart();
$items = $this->getItems();
$disabled = (!$items) ? 'disabled' : "";
?>

<form action="<?php echo $this->getUrl('placeOrder') ?>" method="POST">
    <table>
        <tr>
            <td width="70%" align="right">Subtotal</td>
            <td><?php echo (!$this->getTotal()) ? '0' : $this->getTotal(); ?></td>
        </tr>
        <tr>
            <td width="70%" align="right">Shipping</td>
            <td><?php echo (!$cart->shippingCharge) ? '0' : $cart->shippingCharge;?></td>
        </tr>
        <tr>
            <td width="70%" align="right">Tax</td>
            <td><?php echo (!$this->getTax($cart->cartId)) ? '0' : $this->getTax($cart->cartId); ?></td>
        </tr>
        <tr>
            <td width="70%" align="right">Discount</td>
            <td><?php echo $cart->discount; ?></td>
        </tr>
        <tr>
            <td width="70%" align="right">Grand Total</td>
            <input type="hidden" name="grandTotal" value="<?php echo $this->getTotal() + ($cart->shippingCharge) + $this->getTax($cart->cartId) - ($cart->discount); ?>">
            <input type="hidden" name="discount" value="<?php echo $cart->discount;?>">
            <input type="hidden" name="taxAmount" value="<?php echo $this->getTax($cart->cartId); ?>">
            <td><?php echo $this->getTotal() + ($cart->shippingCharge) + $this->getTax($cart->cartId) - ($cart->discount); ?></td>
        </tr>
        <tr>
            <td width="70%" align="right"></td>
            <td><input type="button" class="btn btn-primary" id="placeOrderBtn" value="Place Order" <?php echo $disabled; ?>></td>
        </tr>
    </table>
</form>
