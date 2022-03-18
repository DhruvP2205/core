<?php $categories = $this->getCategories(); ?>

<a href="<?php echo $this->getUrl('add','category') ?>">Add Category</a>
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
<table cellpadding="7px">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Base Image</th>
        <th>Thumb Image</th>
        <th>Small Image</th>
        <th>Status</th>
        <th>Created Date</th>
        <th>Updated Date</th>
        <th>Action</th>
    </tr>
    
    <?php if(!$categories): ?>
    <tr><td colspan="7">No Recored Receive</td></tr>
    <?php else: ?>
        <?php foreach($categories as $category): ?>
        <tr>
            <td><?php  echo $category->categoryId; ?></td>
            <td><?php echo $this->getPath($category->categoryId,$category->path); ?></td>
            
            <?php if($category->base ): ?>
                <td><img src="<?php  echo $category->getBase()->getImgPath();?>" alt="No Image found" width=50 height=50></td>
            <?php else: ?>
                <td>No base image</td>
            <?php endif; ?>

            <?php if($category->thumb ): ?>
                <td><img src="<?php  echo $category->getThumb()->getImgPath();?>" alt="No Image found" width=50 height=50></td>
            <?php else: ?>
                <td>No thumb image</td>
            <?php endif; ?>

            <?php if($category->small ): ?>
                <td><img src="<?php  echo $category->getSmall()->getImgPath();?>" alt="No Image found" width=50 height=50></td>
            <?php else: ?>
                <td>No small image</td>
            <?php endif; ?>
            
            <td><?php echo $category->getStatus($category->status); ?></td>
            
            <td><?php echo $category->createdDate; ?></td>
            
            <td><?php echo $category->updatedDate; ?></td>
            <td>
                <a href='<?php echo $this->getUrl('edit','category',['id'=>$category->categoryId],true) ?>'>Edit</a>
                <a href='<?php echo $this->getUrl('delete','category',['id'=>$category->categoryId],true) ?>'>Delete</a>
                <a href="<?php echo $this->getUrl('grid','category_media',['id'=>$category->categoryId],true) ?>">Edit Gallary</a>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
        
</tabel>
