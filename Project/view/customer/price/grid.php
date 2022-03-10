<?php $products = $this->getProducts(); ?>

<form action="<?php echo $this->getUrl('save','customer_price') ?>" method="post">
    <input type="submit" value="save">
    <button><a href="<?php echo $this->getUrl('grid','Customer'); ?>">Cancel</a></button>
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
                <td colspacing = "6">No Product Found</td>
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
</form>