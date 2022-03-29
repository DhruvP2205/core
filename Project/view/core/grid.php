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
        <?php if($action['title'] == 'delete'): ?>
            <?php $key = $columns['id']['key']; ?>
            <td><button type="button" class="delete" value="<?php echo $collection->$key; ?>"><?php echo $action['title']; ?></button></td>
        <?php else: ?>
            <?php $method = $action['method']; ?>
            <td><a href="<?php echo $collection->$method(); ?>"><button><?php echo $action['title'] ?></button></a></td>
        <?php endif; ?>
        <?php endforeach; ?>
    </tr>
    <?php endforeach; ?>
</table>


<script type="text/javascript">
    admin.setForm('form-customer');
    $(document).ready(function(){
        $(".delete").click(function(){
            var data = $(this).val();
            admin.setData({'id' : data});
            admin.callDeleteAjax();
        });
    });
</script>
