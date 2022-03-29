<?php $collections = $this->getCollection();
    $columns = $this->getColumns();
    $actions =  $this->getActions();
    $pager = $this->getPager(); ?>

<h2>All Records</h2>

<table>
    <tr>
        <select id="pageSelect" onchange="pprFunction()" style="margin: 0px 20px 0px 35%; width: 70px;" >
            <option selected>select</option>
            <?php foreach ($pager->perPageCountOption as $pageCount):?>
                <option value="<?php echo $pageCount?>"><?php echo $pageCount?></option>
            <?php endforeach; ?>
        </select>
        
        <button style="margin: 0px 20px 0px 10px;"><a href="<?php echo ($pager->getStart()==NULL) ? '#' : $this->getUrl(null,null,['p' => $pager->getStart()]) ?>">Start</a></button>

        <button style="margin: 0px 20px 0px 10px;"><a href="<?php echo ($pager->getPrev()==NULL) ? '#' : $this->getUrl(null,null,['p' => $pager->getPrev()]) ?>">Prev</a></button>

        <button style="margin: 0px 20px 0px 10px;" disabled="true"><?php echo $pager->getCurrent();?></button>

        <button style="margin: 0px 20px 0px 10px;"><a href="<?php echo ($pager->getNext()==NULL) ? '#' : $this->getUrl(null,null,['p' => $pager->getNext()]) ?>">Next</a></button>

        <button style="margin: 0px 20px 0px 10px;"><a href="<?php echo ($pager->getEnd()==NULL) ? '#' : $this->getUrl(null,null,['p' => $pager->getEnd()]) ?>">End</a></button>
    </tr>
</table>
<br>
<br>
<a href="<?php echo $this->getUrl('add'); ?>">Add</a>
<br>
<br>
<table>
    <tr>
        <?php foreach ($columns as $key => $column) :?>
            <th><?php echo $column['title'] ?></th>
        <?php endforeach; ?>
        <?php foreach ($actions as $key => $action) :?>
            <th><?php echo $key ?></th>
        <?php endforeach; ?>
    </tr>

    <?php foreach ($collections as $collection) :?>
    <tr>
        <?php foreach ($columns as $key => $column):?>
            <td><?php echo $this->getColumnData($column,$collection); ?></td>
        <?php endforeach; ?>
        <?php foreach ($actions as $action) : ?>
            <td><a href="<?php echo $collection->getActionUrl($action) ?>"><?php echo $action['title'] ?></td>
        <?php endforeach; ?>
    </tr>
    <?php endforeach; ?>
</table>

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
