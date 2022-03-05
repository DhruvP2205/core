<?php $pages = $this->getPages(); ?>

    <a href="<?php echo $this->getUrl('add','page') ?>">Add Page</a>
            <h2>All Records</h2>
            <table cellpadding="7px">
                <thead>
                    <th>Page ID</th>
                    <th>Name</th>  
                    <th>Code</th>
                    <th>Content</th>  
                    <th>Status</th>
                    <th>Created Date</th>
                    <th>Updated Date</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php if(!$pages):?>
                            <tr><td colspan="10">No Record available.</td></tr>
                    <?php else:
                        foreach ($pages as $page):
                    ?>
                <tr>
                    <td><?php echo($page->pageId); ?></td>
                    <td><?php echo($page->name); ?></td>
                    <td><?php echo($page->code); ?></td>
                    <td><?php echo($page->content); ?></td>
                    <td><?php echo $this->getStatus($page->status)?></td>
                    <td><?php echo($page->createdDate); ?></td>
                    <td><?php echo($page->updatedDate); ?></td>
                    <td>
                        <a href="<?php echo $this->getUrl('edit','page',['id'=>$page->pageId],true) ?>">Edit</a>
                        <a href="<?php echo $this->getUrl('delete','page',['id'=>$page->pageId],true) ?>">Delete</a>
                    </td>
                </tr>
                <?php endforeach;
                    endif; ?>
        </tbody>
    </table>
