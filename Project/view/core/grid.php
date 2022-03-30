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
<button id="addNew">Add</button>
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
            <?php $key = $columns['id']['key']; ?>
            <td><button type="button" class="<?php echo $action['title'] ?>" value="<?php echo $collection->$key; ?>"><?php echo $action['title']; ?></button></td>
        <?php endforeach; ?>
    </tr>
    <?php endforeach; ?>
</table>


<script>
    $("#addNew").click(function(){
        var url = "<?php echo $this->getUrl('add'); ?>";
        admin.setUrl(url);
        admin.setType('POST');
        admin.setData($(this).val());
        admin.load();
    });

    $(".delete").click(function(){
        var data = $(this).val();
        admin.setData({'id' : data});
        admin.setUrl("<?php echo $this->getUrl('delete'); ?>");
        admin.callDeleteAjax();
        admin.setUrl("<?php echo $this->getUrl('grid1'); ?>");
        admin.setData({});
        admin.load();
    });

    $(".edit").click(function(){
        var data = $(this).val();
        admin.setData({'id' : data});
        admin.setUrl("<?php echo $this->getUrl('edit'); ?>");
        admin.setType('GET');
        admin.load();
    });

</script>
