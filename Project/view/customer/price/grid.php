<?php $products = $this->getProducts(); ?>
    <button type="button" id="customerPriceSubmitBtn">Save</button>
    <button type="button" id="customerPriceCancelBtn">Cancel</button>
    <br>
    <br>
    <table border="1" width="100%">
        <tr>
            <th>Product Id</th>
            <th>Name</th>
            <th>SKU</th>
            <th>Price</th>
            <th>Salesman Price</th>
            <th>Customer Price</th>
        </tr>
        <?php if(!$products): ?>
            <tr>
                <td colspan = "6">No Product Found</td>
            </tr>
        <?php else: ?>
        <?php $i = 0; ?>
        <?php foreach($products as $product): ?>
        <tr>
            <input type="hidden" name="product[<?php echo $i ?>][productId]" value="<?php echo $product->productId; ?>">
            <input type="hidden" name="product[<?php echo $i ?>][salesmanPrice]" value="<?php echo $this->getSalesmanPrice($product->productId); ?>">
            <td><?php echo $product->productId ?></td>
            <td><?php echo $product->name ?></td>
            <td><?php echo $product->sku ?></td>
            <td><?php echo $product->price ?></td>
            <td><?php echo $this->getSalesmanPrice($product->productId); ?>
            <td><input type="text" name="product[<?php echo $i ?>][price]" value="<?php echo $this->getCustomerPrice($product->productId) ?>"></td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
        <?php endif; ?>
    </table>
<script>
    $("#customerPriceSubmitBtn").click(function(){
        admin.setForm($("#indexForm"));
        admin.setUrl("<?php echo $this->getUrl('save','customer_price'); ?>");
        admin.load();
    });

    $("#customerPriceCancelBtn").click(function(){
        admin.setUrl("<?php echo $this->getUrl('gridBlock','customer'); ?>");
        admin.load();
    });
</script>
