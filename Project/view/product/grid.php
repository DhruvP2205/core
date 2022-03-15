<?php $products = $this->getProducts();    ?>

<a href="<?php echo $this->getUrl('add','product',[],true) ?>">Add Product</a>
<h2>All Records</h2>
<table>
    <tr>
        <script type="text/javascript">
            function pprFunction()
            {
                const pprValue = document.getElementById('pageSelect').selectedOptions[0].value;
                let url = window.location.href;
                
                if(!url.includes('ppr'))
                {
                    url += '&ppr=20';
                }
                const urlArray = url.split("&");

                for (i = 0; i < urlArray.length; i++)
                {
                    if(urlArray[i].includes('p='))
                    {
                        urlArray[i] = 'p=1';
                    }
                    if(urlArray[i].includes('ppr='))
                    {
                        urlArray[i] = 'ppr=' + pprValue;
                    }
                }
                const finalUrl = urlArray.join("&");  
                location.replace(finalUrl);
            }
        </script>
        
        <select id="pageSelect" onchange="pprFunction()" style="margin: 0px 20px 0px 35%; width: 70px;" >
            <option selected>select</option>
            <?php foreach ($this->pager->perPageCountOption as $pageCount):?>
                <option value="<?php echo $pageCount?>"><?php echo $pageCount?></option>
            <?php endforeach; ?>
        </select>
        
        <button style="margin: 0px 20px 0px 10px;"><a href="<?php echo ($this->pager->getStart()==NULL) ? '#' : $this->getUrl(null,null,['p' => $this->getPager()->getStart()]) ?>">Start</a></button>

        <button style="margin: 0px 20px 0px 10px;"><a href="<?php echo ($this->pager->getPrev()==NULL) ? '#' : $this->getUrl(null,null,['p' => $this->getPager()->getPrev()]) ?>">Prev</a></button>

        <button style="margin: 0px 20px 0px 10px;" disabled="true"><?php echo $this->pager->getCurrent();?></button>

        <button style="margin: 0px 20px 0px 10px;"><a href="<?php echo ($this->pager->getNext()==NULL) ? '#' : $this->getUrl(null,null,['p' => $this->getPager()->getNext()]) ?>">Next</a></button>

        <button style="margin: 0px 20px 0px 10px;"><a href="<?php echo ($this->pager->getEnd()==NULL) ? '#' : $this->getUrl(null,null,['p' => $this->getPager()->getEnd()]) ?>">End</a></button>
    </tr>
</table>
<br>
<table border="1" cellpadding="7px">
    <tr>
        <th>Product Id</th>
        <th>Name</th>
        <th>Sku</th>
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
            <td><?php echo $product->sku ?></td>
            
            <?php if($product->base): ?>
            <td><img src="<?php echo "Media/Product/".$product->getBase();  ?>" alt="No Image Found" width="50" height="50"></td>
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
