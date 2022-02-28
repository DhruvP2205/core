<?php $medias = $this->getMedias(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Media</title>
    <link rel="stylesheet" href="./src/css/style.css">
</head>
<body>
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
    
</body>
</html>