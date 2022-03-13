<?php $admins = $this->getAdmins(); ?>

<a href="<?php echo $this->getUrl('add') ?>">Add Admin</a>
<h2>All Records</h2>
<table>
    <tr>
        <script type="text/javascript">
            function pprFunction()
            {
                const pprValue = document.getElementById('ppr').selectedOptions[0].value;
                let url = window.location.href;
                
                if(!url.includes('ppr'))
                {
                    url+='&ppr=20';
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
        
        <select id="ppr" onchange="pprFunction()">
            <option selected>select</option>
            <?php foreach ($this->pager->perPageCountOption as $pageCount):?>
                <option value="<?php echo $pageCount?>"><?php echo $pageCount?></option>
            <?php endforeach; ?>
        </select>
        
        <button style="margin: 0px 20px 0px 40%;"><a href="<?php echo ($this->pager->getStart()==NULL) ? '#' : $this->getUrl(null,null,['p' => $this->getPager()->getStart()]) ?>">Start</a></button>

        <button style="margin: 0px 20px 0px 10px;"><a href="<?php echo ($this->pager->getPrev()==NULL) ? '#' : $this->getUrl(null,null,['p' => $this->getPager()->getPrev()]) ?>">Prev</a></button>

        <button style="margin: 0px 20px 0px 10px;" disabled="true"><?php echo $this->pager->getCurrent();?></button>

        <button style="margin: 0px 20px 0px 10px;"><a href="<?php echo ($this->pager->getNext()==NULL) ? '#' : $this->getUrl(null,null,['p' => $this->getPager()->getNext()]) ?>">Next</a></button>

        <button style="margin: 0px 20px 0px 10px;"><a href="<?php echo ($this->pager->getEnd()==NULL) ? '#' : $this->getUrl(null,null,['p' => $this->getPager()->getEnd()]) ?>">End</a></button>
    </tr>
</table>
<br>
<table cellpadding="7px">
    <thead>
        <th>Admin Id</th>
        <th>First Name</th>  
        <th>Last Name</th>
        <th>Email</th>
        <th>Status</th>
        <th>Created Date</th>
        <th>Upadated Date</th>
        <th>Action</th>
    </thead>
    <tbody>
        <?php
            if(!$admins):?>
                <tr><td colspan="10">No Record available.</td></tr>
        <?php else:
            foreach ($admins as $admin):?>
        <tr>
            <td><?php echo($admin->adminId); ?></td>
            <td><?php echo($admin->firstName); ?></td>
            <td><?php echo($admin->lastName); ?></td>
            <td><?php echo($admin->email); ?></td>
            <td><?php echo($admin->getStatus($admin->status));?></td>
            <td><?php echo($admin->createdDate); ?></td>
            <td><?php echo($admin->updatedDate); ?></td>
            <td>
                <a href="<?php echo $this->getUrl('edit','admin',['id'=>$admin->adminId],true) ?>">Edit</a>
                <a href="<?php echo $this->getUrl('delete','admin',['id'=>$admin->adminId],true) ?>">Delete</a>
            </td>
        </tr>
        <?php
            endforeach;
        endif;
        ?>
    </tbody>
</table>

