<?php $cart = $this->getCart();
$products = $this->getProducts();
$items = $cart->getItems(); ?>

<div class="card card-info" id="productTable">
    <div class="card-header">
        <h3 class="card-title">Product</h3>
    </div>
    <div class="card-body">
        <input type="button" id="cartItemAdd" class="btn btn-success" name="submit" id="submit" value="Add Item">
        <button type="button" class="btn btn-primary" id="hideProduct">Cancel</button>
        <table class="table table-bordered table-striped">
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
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
                <td><input type="number" class="form-control" name="cartProduct[<?php echo $i ?>][quantity]" min="1"></td>
                <td><?php echo $product->price; ?></td>
                <td><input type="checkbox" name="cartProduct[<?php echo $i ?>][productId]" value="<?php echo $product->productId ?>"></td>
            </tr>
            <?php $i++; ?>
            <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
</div>

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Item</h3>
    </div>
    <div class="card-body">
        <input type="button" id="cartItemUpdate" class="btn btn-success" name="submit" id="submit" value="Update">
        <button type="button" class="btn btn-primary" value="" id="showProduct">New Item</button>
        <table class="table table-bordered table-striped">
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
                <td><input type="number" class="form-control" name="cartItem[<?php echo $i ?>][quantity]" value="<?php echo $item->quantity; ?>" min="1"></td>
                <td><?php echo $item->getProduct()->price; ?></td>
                <td align="right"><?php echo $item->itemTotal; ?></td>
                <td align="center"><button type="button" class="removeCartItem btn btn-primary" value="<?php echo $item->itemId; ?>">Remove</button></td>
            </tr>
            <?php $i++; ?>
            <?php endforeach; ?>
            <?php endif;?>
            <tr>
                <td colspan="4" align="right">Sub Total</td>
                <td colspan="2" align="center"><?php echo $this->getTotal(); ?></td>
            </tr>
        </table>
    </div>
</div>


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
