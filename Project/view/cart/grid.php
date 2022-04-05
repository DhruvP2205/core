<?php $orders = $this->getOrders(); ?>

<br>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <button class="btn btn-block btn-success col-sm-3" type="button" id="addNew">Add New Cart</button>
        </div>
    </div>
</div>
<div class="card card-info" id="productTable">
    <div class="card-header">
        <h3 class="card-title">Order</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tr>
                <th>Order Id</th>
                <th>Customer Id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Grand Total</th>
                <th>Action</th>
            </tr>
            <?php if(!$orders): ?>
            <tr>
                <td colspan="7">No order found</td>
            </tr>
            <?php else: ?>
            <?php foreach($orders as $order): ?>
            <tr>
                <td><?php echo $order->orderId ?></td>
                <td><?php echo $order->customerId ?></td>
                <td><?php echo $order->firstName ?></td>
                <td><?php echo $order->lastName ?></td>
                <td><?php echo $order->email ?></td>
                <td><?php echo $order->mobile ?></td>
                <td><?php echo $order->grandTotal ?></td>
                <td><button type="button" class="order btn btn-success" value="<?php echo $order->orderId; ?>">View Order</button></td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
</div>

<script type="text/javascript">
    $("#addNew").click(function(){
        admin.setData({'id' : null});
        admin.setUrl("<?php echo $this->getUrl('editBlock',null,['id' => null]); ?>");
        admin.load();
    });

    $(".order").click(function(){
        var data = $(this).val();
        admin.setData({'id' : data});
        admin.setUrl("<?php echo $this->getUrl('editBlock','order',['id' => null]); ?>");
        admin.setType('GET');
        admin.load();
    });
</script>
