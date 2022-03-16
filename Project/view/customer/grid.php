<?php  $customers = $this->getCustomers(); ?>

<a href="<?php echo $this->getUrl('add','customer') ?>">Add Customer</a>
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
    <tr>
        <th>customer Id</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Status</th>
        <th>Created Date</th>
        <th>Updated Date</th>
        <th>Billing Address</th>
        <th>Shipping Address</th>
        <th>Action</th>
    </tr>
    <?php if(!$customers):  ?>
        <tr><td colspan="10">No Record available.</td></tr>
    <?php else:  ?>
        <?php foreach ($customers as $customer): ?>            
        <tr>
            <td><?php echo $customer->customerId ?></td>
            <td><?php echo $customer->firstName ?></td>
            <td><?php echo $customer->lastName ?></td>
            <td><?php echo $customer->email ?></td>
            <td><?php echo $customer->mobile ?></td>
            <td><?php echo $customer->getStatus($customer->status)?></td>
            <td><?php echo $customer->createdDate ?></td>
            <td><?php echo $customer->updatedDate ?></td>
            <td>
                <?php $billingAddress = $customer->getBillingAddress();?>
                <?php echo $billingAddress->address.", ".$billingAddress->city.", ".$billingAddress->state.", ".$billingAddress->country.", ".$billingAddress->zipcode."<br>"  ?>
                
            </td>
            <td>
                <?php $ShippingAddress = $customer->getShippingAddress()  ?>
                <?php echo $ShippingAddress->address.", ".$ShippingAddress->city.", ".$ShippingAddress->state.", ".$ShippingAddress->country.", ".$ShippingAddress->zipcode."<br>" ?>
            </td>
            <td>
                <a href="<?php echo $this->getUrl('edit','customer',['id'=>$customer->customerId],true) ?>">Edit</a>
                <a href="<?php echo $this->getUrl('delete','customer',['id'=>$customer->customerId],true) ?>">Delete</a>
                <a href="<?php echo $this->getUrl('grid','customer_price',['id' => $customer->customerId],true); ?>">Manage Price</a>
            </td>
        </tr>
    <?php endforeach;   ?>
    <?php endif;  ?>   
</table>
