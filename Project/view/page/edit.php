<?php
    $page = $this->getPage();
?>

    <h2>Page</h2>
    <form action="<?php echo $this->getUrl('save','page',['id'=>$page->pageId],true) ?>" method="POST">
        <table border="1" cellspacing="7">
            
            <input type="text" name="page[pageId]" value="<?php echo $page->pageId ?>" hidden>
            <tr>
                <td>Page Name</td>
                <td><input type="text" name="page[name]" value="<?php echo $page->name ?>"></td>
            </tr>
            <tr>
                <td>Code</td>
                <td><input type="text" name="page[code]" value="<?php echo $page->code ?>"></td>
            </tr>
            <tr>
                <td>Content</td>
                <td><textarea name="page[content]" rows="4" cols="50"><?php echo $page->content; ?></textarea></td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    <select name="page[status]">
                        <option value="1" <?php echo ($page->getStatus($page->status)=='Active')?'selected':'' ?>>Active</option>
                        <option value="2" <?php echo ($page->getStatus($page->status)=='Inactive')?'selected':'' ?>>Inactive</option>
                    </select>
                </td>
            </tr>
            
            <tr>
                <td>&nbsp;</td>
                <td>
                    <input type="submit" name="submit" value="Save">
                    <button type="button"><a href="<?php echo $this->getUrl('grid','page',[],true) ?>">Cancel</a></button>
                </td>
            </tr>
            
        </table>    
    </form>
