<?php $salesmans = $this->getSalesmans(); ?>

<a href="<?php echo $this->getUrl('add') ?>">Add Salesman</a>
<h2>All Records</h2>
<table cellpadding="7px">
    <thead>
        <th>Salesman Id</th>
        <th>First Name</th>  
        <th>Last Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Discount</th>
        <th>Status</th>
        <th>Created Date</th>
        <th>Upadated Date</th>
        <th>Action</th>
    </thead>
    <tbody>
        <?php
            if(!$salesmans):?>
                <tr><td colspan="10">No Record available.</td></tr>
        <?php else:
            foreach ($salesmans as $salesman):?>
        <tr>
            <td><?php echo($salesman->salesmanId); ?></td>
            <td><?php echo($salesman->firstName); ?></td>
            <td><?php echo($salesman->lastName); ?></td>
            <td><?php echo($salesman->email); ?></td>
            <td><?php echo($salesman->mobile); ?></td>
            <td><?php echo $salesman->discount; ?></td>
            <td><?php echo($salesman->getStatus($salesman->status));?></td>
            <td><?php echo($salesman->createdDate); ?></td>
            <td><?php echo($salesman->updatedDate); ?></td>
            <td>
                <a href="<?php echo $this->getUrl('edit','salesman',['id'=>$salesman->salesmanId],true) ?>">Edit</a>
                <a href="<?php echo $this->getUrl('delete','salesman',['id'=>$salesman->salesmanId],true) ?>">Delete</a>
                <a href="<?php echo $this->getUrl('grid','salesman_customer',['id'=>$salesman->salesmanId],true) ?>">Manage Customer</a>
            </td>
        </tr>
        <?php endforeach;
        endif; ?>
</tbody>
</table>
