<?php $headers = $this->getCollection()->getHeaders(); ?>
<?php $columns = $this->getCollection()->getColumns(); ?>
<?php $actions = $this->getCollection()->getActions(); ?>
<?php $pager = $this->getCollection()->getPagerModel(); ?>
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
<a href="<?php echo $this->getActionUrl('add'); ?>">Add</a>
<br>
<br>
<table>
    <tr>
        <?php foreach ($headers as $header) :?>
            <th><?php echo $header ?></th>
        <?php endforeach; ?>

        <?php foreach ($actions as $title => $action) :?>
            <th><?php echo $title ?></th>
        <?php endforeach; ?>
    </tr>

    <?php foreach ($columns as $columnData) :?>
    <tr>
        <?php foreach ($columnData as $column):?>
            <td><?php echo $column ?></td>
        <?php endforeach; ?>

        <?php foreach ($actions as $action) :?>
            <td><a href="<?php echo $this->getActionUrl($action['title'],$columnData[0]); ?>"><?php echo $action['title'] ?> </a></td>
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
