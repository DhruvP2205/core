<?php $products = $this->getProducts();    ?>

<a href="<?php echo $this->getUrl('add','product') ?>">Add Product</a>
<h2>All Records</h2>
<table border="1" cellpadding="7px">
    <tr>
        <th>Product Id</th>
        <th>Name</th>
        <th>Base Image</th>
        <th>Thumb Image</th>
        <th>Image</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Status</th>
        <th>Created Date</th>
        <th>Updated Date</th>
        <th>Action</th>
    </tr>
    <?php if(!$products):  ?>
        <tr><td colspan="12">No Record available.</td></tr>
    <?php else:  ?>
        <?php foreach ($products as $product): ?>
        <tr>
            <td><?php echo $product->productId ?></td>
            <td><?php echo $product->name ?></td>
            
            <?php if($product->base): ?>
            <td><img src="<?php echo "Media/Product/".$this->getMedia($product->base)['name']  ?>" alt="No Image Found" width="50" height="50"></td>
            <?php else: ?>
            <td>No Base Image</td>
            <?php endif; ?> 
            
            <?php if($product->thumb): ?>
            <td><img src="<?php echo "Media/Product/".$this->getMedia($product->thumb)['name']  ?>" alt="No Image Found" width="50" height="50"></td>
            <?php else: ?>
            <td>No Thumb Image</td>
            <?php endif; ?> 
            
            <?php if($product->small): ?>
            <td><img src="<?php echo "Media/Product/".$this->getMedia($product->small)['name']  ?>" alt="No Image Found" width="50" height="50"></td>
            <?php else: ?>
            <td>No Small Image</td>
            <?php endif; ?> 
            
            <td><?php echo $product->price ?></td>
            
            <td><?php echo $product->quantity ?></td>
            
            <td><?php echo $product->getStatus($product->status)?></td>
            
            <td><?php echo $product->createdDate ?></td>
            
            <td><?php echo $product->updatedDate ?></td>
            
            <td>
                <a href="<?php echo $this->getUrl('edit','product',['id'=>$product->productId],true) ?>">Edit</a>
                <a href="<?php echo $this->getUrl('delete','product',['id'=>$product->productId],true) ?>">Delete</a>
                <a href="<?php echo $this->getUrl('grid','product_media',['id'=>$product->productId],true) ?>">Edit Galary</a>
            </td>
        </tr>
        <?php endforeach;   ?>
    <?php endif;  ?>
    
</table>
