<?php $admins = $this->getAdmins(); ?>

<a href="<?php echo $this->getUrl('add') ?>">Add Admin</a>
<h2>All Records</h2>
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

