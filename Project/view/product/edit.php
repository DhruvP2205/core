<?php $product=$this->getProduct(); ?>
<?php $categories = $this->getCategories(); ?>


<h2>Product</h2>
<form action="<?php echo $this->getUrl('save','product',['id'=>$product->productId],true) ?>" method="POST">
    <table border="1">
        <tr>
            <td colspan="2"><b>Product Information</b><input type="text" name="product[productId]" value="<?php echo $product->productId ?>" hidden></td>
        </tr>
        <tr>
            <td>Name</td>
            <td><input type="text" name="product[name]" value="<?php echo $product->name ?>"></td>
        </tr>
        
        <tr>
            <td>Price</td>
            <td><input type="text" name="product[price]" value="<?php echo $product->price ?>"></td>
        </tr>
        <tr>
            <td>MSP</td>
            <td><input type="text" name="product[msp]" value="<?php echo $product->msp ?>"></td>
        </tr>
        <tr>
            <td>Cost Price</td>
            <td><input type="text" name="product[costPrice]" value="<?php echo $product->costPrice ?>"></td>
        </tr>
        <tr>
            <td>Quantity</td>
            <td><input type="text" name="product[quantity]" value="<?php echo $product->quantity ?>"></td>
        </tr>
        <tr>
            <td>Status</td>
            <td>
                <select name="product[status]">
                    <option value="1" <?php echo ($product->getStatus($product->status)=='Active')?'selected':'' ?>>Active</option>
                    <option value="2" <?php echo ($product->getStatus($product->status)=='Inactive')?'selected':'' ?>>Inactive</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><h3>Select Categories:</h3></td>
            <td>
                <table border="1" width="100%">
                    <tr>
                        <th>Select</th>
                        <th>Category Id</th>
                        <th>Category</th>
                    </tr>
                    <?php if(!$categories): ?>
                    <tr>
                        <td colspan="3">No category Found</td>
                    </tr>
                    <?php else: ?>
                    <?php foreach($categories as $category): ?>
                    <?php $tag = ($this->selected($category->categoryId)=='checked')?'exists':'new' ?>
                    <tr>
                        <td> <input type="checkbox" name="category[<?php echo $tag ?>][]" value="<?php echo $category->categoryId ?>" <?php echo $this->selected($category->categoryId); ?>> </td>
                        <td><?php echo $category->categoryId; ?></td>
                        <td><?php echo $this->getPath($category->categoryId,$category->path) ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </table>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <input type="submit" name="submit" value="Update">
                <button type="button"><a href="<?php echo $this->getUrl('grid') ?>">Cancel</a></button>
            </td>
        </tr>
    </table>
</form>
