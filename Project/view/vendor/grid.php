<?php $vendors = $this->getVendors();?>
<?php $addresses = $this->getAddresses();?>

<a href="<?php echo $this->getUrl('add','vendor') ?>">Add Vendor</a>
<h2>All Records</h2>
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
