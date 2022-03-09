<?php $medias = $this->getMedias(); ?>

<form action="<?php echo $this->getUrl('save','product_media') ?>" method="POST">
    <input type="submit" value="Update">
    <button><a href="<?php echo $this->getUrl('grid','product',[],true); ?>">Cancel</a></button>
    <br>
    <br>
    <table border="1" cellspacing="7px">
        <thead>
            <th>Image Id</th>
            <th>Product Id</th>
            <th>Name</th>
            <th>Base</th>
            <th>Thumb</th>
            <th>Small</th>
            <th>Gallery</th>
            <th>Remove</th>
        </thead>
        <?php if(!$medias): ?>
            <tr>
                <td colspan=8>No Recored Found</td>
            </tr>
        <?php else: ?>
        <?php foreach ($medias as $media): ?>
        <tr>
            <td><?php echo $media->mediaId ?></td>
            <td><?php echo $media->productId ?></td>
            <td><img src="<?php echo 'Media/Product/'.$media->name; ?>" alt="No Image found" width=50 height=50></td>
            
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
        <?php  endforeach; ?>
        <?php  endif; ?>
    </table>
</form>
<br>
<form action="<?php echo $this->getUrl('save','product_media') ?>" method="POST" enctype="multipart/form-data">
    <input type="file" name="name" style="border:1px solid black;">
    <input type="submit" value="Upload">
</form>
