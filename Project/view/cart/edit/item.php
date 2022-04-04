<?php
$cart = $this->getCart();
$products = $this->getProducts();
$items = $cart->getItem();
?>

<input type="button" id="cartItemAdd" class="btn btn-primary" name="submit" id="submit" value="Add Item">
        <button type="button" id="hideProduct">Cancel</button>
        <table border="1" id="productTable">
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <!-- <th>Total</th> -->
                <th>Action</th>
            </tr>
            <?php if(!$products): ?>
            <tr>
                <td colspan="6">Products not available!</td>
            </tr>
            <?php else: ?>
            <?php $i = 0; ?>
            <?php foreach($products as $product): ?>
            <tr>
                <?php if($product->base): ?>
                <td><img src="<?php  echo $product->getBase()->getImgPath();?>" alt="No Image Found" width="50" height="50"></td>
                <?php else: ?>
                <td>No Base Image</td>
                <?php endif; ?>
                <td><?php echo $product->name; ?></td>
                <td><input type="number" name="cartProduct[<?php echo $i ?>][quantity]" min="1"></td>
                <td><?php echo $product->price; ?></td>
                <!-- <td>200</td> -->
                <td><input type="checkbox" name="cartProduct[<?php echo $i ?>][productId]" value="<?php echo $product->productId ?>"></td>
            </tr>
            <?php $i++; ?>
            <?php endforeach; ?>
            <?php endif; ?>
        </table>

<input type="button" id="cartItemUpdate" class="btn btn-primary" name="submit" id="submit" value="Update">
        <button type="button" value="" id="showProduct">New Item</button>
        <table border="1">
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Row Total</th>
                <th>Delete</th>
            </tr>
            <?php if(!$items): ?>
            <tr>
                <td colspan="6">no item found</td>
            </tr>
            <?php else: ?>
            <?php $i = 0; ?>
            <?php foreach($items as $item): ?>
            <tr>
                <input type="hidden" name="cartItem[<?php echo $i ?>][itemId]" value="<?php echo $item->itemId ?>">
                <input type="hidden" name="cartItem[<?php echo $i ?>][productId]" value="<?php echo $item->productId ?>">
                <td><img src="<?php echo $item->getProduct()->getBase()->getImgPath(); ?>" alt="No Image Found" width="50" height="50"></td>
                <td><?php echo $item->getProduct()->name; ?></td>
                <td><input type="number" name="cartItem[<?php echo $i ?>][quantity]" value="<?php echo $item->quantity; ?>" min="1"></td>
                <td><?php echo $item->getProduct()->price; ?></td>
                <td align="right"><?php echo $item->itemTotal; ?></td>
                <td align="center"><button type="button" class="removeCartItem btn btn-primary" value="<?php echo $item->itemId; ?>">Remove</button></td>
            </tr>
            <?php $i++; ?>
            <?php endforeach; ?>
            <?php endif;?>
            <tr>
                <td colspan="5" align="right"><?php echo $this->getTotal(); ?></td>
            </tr>
        </table>


<script>
    $(document).ready(function(){
        $("#productTable").hide();
        $("#showProduct").click(function(){
            $("#productTable").show();
        });
        $("#hideProduct").click(function(){
            $("#productTable").hide();
        });

        $("#cartItemAdd").click(function(){
            admin.setForm(jQuery("#indexForm"));
            admin.setUrl("<?php echo $this->getUrl('addCartItem') ?>");
            admin.load();
        });

        $("#cartItemUpdate").click(function(){
            admin.setForm(jQuery("#indexForm"));
            admin.setUrl("<?php echo $this->getUrl('cartItemUpdate') ?>");
            admin.load();
        });

        $(".removeCartItem").click(function(){
            var data = $(this).val();
            admin.setData({'id' : data});
            admin.setUrl("<?php echo $this->getUrl('deleteCartItem') ?>");
            admin.load();
        });
    });
</script>
