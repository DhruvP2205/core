<?php $medias = $this->getMedias(); ?>
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
<form action="<?php echo $this->getUrl('save','category_media') ?>" method="POST">
    <input type="submit" value="Update">
    <button><a href="<?php echo $this->getUrl('grid','category',[],true); ?>">Cancel</a></button>
    <br>
    <br>
    <table cellpadding="7px">
        <thead>
            <th>Image Id</th>
            <th>Category Id</th>
            <th>Name</th>
            <th>Base</th>
            <th>Thumb</th>
            <th>Small</th>
            <th>Gallery</th>
            <th>Remove</th>
        </thead>
        <?php if(!$medias): ?>
            <tr>
                <td colspan=8>No Records Found</td>
            </tr>
        <?php else: ?>
        <?php foreach ($medias as $media): ?>
        <tr>
            <td><?php echo $media->mediaId ?></td>
            <td><?php echo $media->categoryId ?></td>
            <td><img src="<?php echo 'Media/Category/'.$media->name; ?>" alt="No Image found" width=50 height=50></td>
            
            <td>
                <input type="radio" name="media[base]" value = "<?php echo $media->mediaId ?>" <?php echo $this->selected($media->mediaId,'base'); ?> >
            </td>
            
            <td>
                <input type="radio" name="media[thumb]" value = "<?php echo $media->mediaId ?>" <?php echo $this->selected($media->mediaId,'thumb'); ?> >
            </td>
            
            <td>
                <input type="radio" name="media[small]" value = "<?php echo $media->mediaId ?>" <?php echo $this->selected($media->mediaId,'small'); ?> >
            </td>
            
            <td>
                <input type="checkbox" name="media[gallery][]" value = "<?php echo $media->mediaId ?>" <?php echo $media->gallery == 1 ? 'checked' : ''; ?>>
            </td>
            
            <td>
                <input type="checkbox" name="media[remove][]" value = "<?php echo $media->mediaId ?>" >
            </td>
        </tr>
        <?php endforeach; ?>
        <?php  endif; ?>
    </table>
</form>
<br>
<form action="<?php echo $this->getUrl('save','category_media') ?>" method="POST" enctype="multipart/form-data">
    <input type="file" name="name" style="border:1px solid black;">
    <input type="submit" value="Upload">
</form>
