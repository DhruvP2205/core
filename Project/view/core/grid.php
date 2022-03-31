<?php $collections = $this->getCollection();
$columns = $this->getColumns();
$actions =  $this->getActions();
$pager = $this->getPager(); ?>

<h2>All Records</h2>
<table>
    <tr>
        <select id="pageSelect" style="margin: 0px 20px 0px 35%; width: 70px;" >
            <option selected>select</option>
            <?php foreach ($pager->perPageCountOption as $pageCount):?>
                <option value="<?php echo $pageCount?>"><?php echo $pageCount?></option>
            <?php endforeach; ?>
        </select>
        <button type="button" class="pagerBtn" value="<?php echo $this->getUrl('gridBlock',null,['p' => $pager->getStart()]) ?>" style="margin: 0px 20px 0px 10px;" <?php echo (!$this->getPager()->getStart()) ? 'disabled' : ''?>>Start</button>
        
        <button type="button" class="pagerBtn" value="<?php echo $this->getUrl('gridBlock',null,['p' => $pager->getPrev()]) ?>" style="margin: 0px 20px 0px 10px;" <?php echo (!$this->getPager()->getPrev()) ? 'disabled' : ''?>>Previous</button>
        
        <button type="button" class="pagerBtn" value="<?php echo $this->getUrl('gridBlock',null,['p' => $pager->getCurrent()]) ?>" style="margin: 0px 20px 0px 10px;" <?php echo (!$this->getPager()->getCurrent()) ? 'disabled' : ''?>><?php echo $pager->getCurrent(); ?></button>
        
        <button type="button" class="pagerBtn" value="<?php echo $this->getUrl('gridBlock',null,['p' => $pager->getNext()]) ?>" style="margin: 0px 20px 0px 10px;" <?php echo (!$this->getPager()->getNext()) ? 'disabled' : ''?>>Next</button>
        
        <button type="button" class="pagerBtn" value="<?php echo $this->getUrl('gridBlock',null,['p' => $pager->getEnd()]) ?>" style="margin: 0px 20px 0px 10px;" <?php echo (!$this->getPager()->getEnd()) ? 'disabled' : ''?>>End</button>
    </tr>
</table>
<br>
<br>
<button type="button" id="addNew">Add</button>
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


<script type="text/javascript">
    $("#addNew").click(function(){
        admin.setData({'id' : null});
        admin.setUrl("<?php echo $this->getUrl('addBlock'); ?>");
        admin.load();
    });

    $(".delete").click(function(){
        var data = $(this).val();
        admin.setData({'id' : data});
        admin.setUrl("<?php echo $this->getUrl('delete'); ?>");
        admin.setType('GET');
        admin.load();
    });

    $(".edit").click(function(){
        var data = $(this).val();
        admin.setData({'id' : data});
        admin.setUrl("<?php echo $this->getUrl('editBlock'); ?>");
        admin.setType('GET');
        admin.load();
    });

    $(".price").click(function(){
        var data = $(this).val();
        admin.setData({'id' : data});
        admin.setUrl("<?php echo $this->getUrl('gridBlock','customer_price'); ?>");
        admin.setType('GET');
        admin.load();
    });
    $(".pagerBtn").click(function(){
        var data = $(this).val();
        admin.setUrl(data);
        admin.setType('GET');
        admin.load();
    });
     $("#pageSelect").change(function(){
        var data = $(this).val();
        admin.setUrl("<?php echo $this->getUrl('gridBlock',null,['p'=>1,'ppr'=>null]); ?>&ppr="+data);
        admin.setType('GET');
        admin.load();
    });
</script>
