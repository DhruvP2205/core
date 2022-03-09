<?php $categories = $this->getCategories(); ?>

    <a href="<?php echo $this->getUrl('add','category') ?>">Add Category</a>
    <h2>All Records</h2>
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
                        <td><img src="<?php echo 'Media/Category/'.$this->getMedia($category->base)['name']; ?>" alt="No Image found" width=50 height=50></td>
                    <?php else: ?>
                        <td>No base image</td>
                    <?php endif; ?>

                    <?php if($category->thumb ): ?>
                        <td><img src="<?php echo 'Media/Category/'.$this->getMedia($category->thumb)['name']; ?>" alt="No Image found" width=50 height=50></td>
                    <?php else: ?>
                        <td>No thumb image</td>
                    <?php endif; ?>

                    <?php if($category->small ): ?>
                        <td><img src="<?php echo 'Media/Category/'.$this->getMedia($category->small)['name']; ?>" alt="No Image found" width=50 height=50></td>
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
