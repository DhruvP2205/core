<?php $vendors = $this->getVendors();?>
<?php $addresses = $this->getAddresses();?>

<a href="<?php echo $this->getUrl('add','vendor') ?>">Add Vendor</a>
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
    <tr>
        <th>Vendor Id</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Status</th>
        <th>Created Date</th>
        <th>Updated Date</th>
        <th>Address</th>
        <th>Zipcode</th>
        <th>City</th>
        <th>State</th>
        <th>Country</th>
        <th>Action</th>
    </tr>
    <?php if(!$vendors):  ?>
        <tr><td colspan="14">No Record available.</td></tr>
    <?php else:  ?>
        <?php foreach ($vendors as $vendor): ?>
            
        <tr>
            <td><?php echo $vendor->vendorId ?></td>
            <td><?php echo $vendor->firstName ?></td>
            <td><?php echo $vendor->lastName ?></td>
            <td><?php echo $vendor->email ?></td>
            <td><?php echo $vendor->mobile ?></td>
            <td><?php if($vendor->status==1):echo "Active";else : echo "Inactive"; endif;?></td>
            <td><?php echo $vendor->createdDate ?></td>
            <td><?php echo $vendor->updatedDate ?></td>
            <?php foreach ($addresses as $address): ?>
                <?php if($address->vendorId==$vendor->vendorId):?>
                        <td><?php echo $address->address?></td>
                        <td><?php echo $address->zipcode?></td>
                        <td><?php echo $address->city?></td>
                        <td><?php echo $address->state?></td>
                        <td><?php echo $address->country?></td>
                <?php endif; ?>
                <?php endforeach;   ?>
            </td>
            <td>
                <a href="<?php echo $this->getUrl('edit','vendor',['id'=>$vendor->vendorId],true) ?>">Edit</a>
                <a href="<?php echo $this->getUrl('delete','vendor',['id'=>$vendor->vendorId],true) ?>">Delete</a>
            </td>
        
        </tr>
        
    <?php endforeach;   ?>
    <?php endif;  ?>
    
</table>
