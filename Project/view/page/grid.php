<?php $pages = $this->getPages(); ?>

<a href="<?php echo $this->getUrl('add','page') ?>">Add Page</a>
<br>
<h2>All Records</h2>
<table>
    <tr>
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
<form action="<?php echo $this->getUrl('delete','page',[],true); ?>" method="POST">
    <table>
        <tbody>
            <tr>
                <td><h3>Manage Pages</h3></td>
                <td><button><a href="<?php echo $this->getUrl('add','page',[],true) ?>">Add New</a></button></td>
                <td><input type="submit" name="submit" value="Delete Selected Record"></td>
            </tr>
        </tbody>
    </table>

    <hr>
<table cellpadding="7px">
    <thead>
        <th><input type="checkbox" name="select" id="selectaction"></th>
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
        <td align="center"><input type="checkbox" name="page[]" id="deleteact" value="<?php echo $page->pageId; ?>"></td>
        <td><?php echo($page->pageId); ?></td>
        <td><?php echo($page->name); ?></td>
        <td><?php echo($page->code); ?></td>
        <td><?php echo($page->content); ?></td>
        <td><?php echo($page->getStatus($page->status));?></td>
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
</form>
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

    document.getElementById('selectaction').onclick = function()
    {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var checkbox of checkboxes)
        {
            checkbox.checked = this.checked;
        }
    }

    document.getElementById('deleteact').onclick = function()
    {
        var checkbox =  document.getElementById('selectaction');
        if(!this.checked)
        {
            checkbox.checked = false;   
        }
    }
</script>
