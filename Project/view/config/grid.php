<?php $configs = $this->getConfigs(); ?>

<a href="<?php echo $this->getUrl('add','config') ?>">Add Config</a>
<h2>All Records</h2>
<table>
    <tr>
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
<table cellpadding="7px">
    <thead>
        <th>Config ID</th>
        <th>Name</th>  
        <th>Code</th>
        <th>Value</th>  
        <th>Status</th>
        <th>Created Date</th>
        <th>Action</th>
    </thead>
    <tbody>
        <?php if(!$configs):?>
                <tr><td colspan="10">No Record available.</td></tr>
        <?php else:
            foreach ($configs as $config):
        ?>
    <tr>
        <td><?php echo($config->configId); ?></td>
        <td><?php echo($config->name); ?></td>
        <td><?php echo($config->code); ?></td>
        <td><?php echo($config->value); ?></td>
        <td><?php echo($config->getStatus($config->status));?></td>
        <td><?php echo($config->createdDate); ?></td>
        <td>
            <a href="<?php echo $this->getUrl('edit','config',['id'=>$config->configId],true) ?>">Edit</a>
            <a href="<?php echo $this->getUrl('delete','config',['id'=>$config->configId],true) ?>">Delete</a>
        </td>
    </tr>
    <?php endforeach;
        endif; ?>
    </tbody>
</table>
