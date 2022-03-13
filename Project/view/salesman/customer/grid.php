<?php $customers = $this->getCustomers(); ?>


<h3>Avalilabel Customer</h3>
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
<form action="<?php echo $this->getUrl('save','Salesman_Customer',['id'=> $this->getSalesmanId()],true) ?>" method="post">
    <input type="submit" value="save">
    <button><a href="<?php echo $this->getUrl('grid','Salesman'); ?>">Cancel</a></button>
    <table border="1" width="100%">
        <tr>
            <th>Select</th>
            <th>Customer Id</th>
            <th>First Name</th>
            <th>Last Name</th>
        </tr>
        <?php if(!$customers): ?>
                <tr>
                    <td colspan="4">No Recored Found</td>
                </tr>
            <?php else: ?>
            <?php foreach ($customers as $customer): ?>
            <tr>
                <td><input type="checkbox" name="customer[]" value='<?php echo $customer->customerId; ?>' <?php echo $this->selected($customer->customerId); ?> ></td>
                <td><?php echo $customer->customerId; ?></td>
                <td><?php echo $customer->firstName; ?></td>
                <td><?php echo $customer->lastName; ?></td>
            </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </table>
</form>
