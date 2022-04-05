<?php $order = $this->getOrder();
$billingAddress = $order->getBillingAddress();
$shippingAddress = $order->getShippingAddress();
$items = $order->getItems();
$comment = $order->getComment(); ?>

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Address Information</h3>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Billing Address</h3>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tr>
                                <td>First Name</td>
                                <td><?php echo $billingAddress->firstName; ?></td>
                            </tr>
                            <tr>
                                <td>Last Name</td>
                                <td><?php echo $billingAddress->lastName; ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><?php echo $billingAddress->email; ?></td>
                            </tr>
                            <tr>
                                <td>Mobile</td>
                                <td><?php echo $billingAddress->mobile; ?></td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td><?php echo $billingAddress->address; ?></td>
                            </tr>
                            <tr>
                                <td>ZipCode</td>
                                <td><?php echo $billingAddress->zipcode; ?></td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td><?php echo $billingAddress->city; ?></td>
                            </tr>
                            <tr>
                                <td>State</td>
                                <td><?php echo $billingAddress->state; ?></td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                <td><?php echo $billingAddress->country; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Shipping Address</h3>
                        </div>
                        <table class="table table-bordered table-striped">
                                <tr>
                                    <td>First Name</td>
                                    <td><?php echo $shippingAddress->firstName; ?></td>
                                </tr>
                                <tr>
                                    <td>Last Name</td>
                                    <td><?php echo $shippingAddress->lastName; ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><?php echo $shippingAddress->email; ?></td>
                                </tr>
                                <tr>
                                    <td>Mobile</td>
                                    <td><?php echo $shippingAddress->mobile; ?></td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td><?php echo $shippingAddress->address; ?></td>
                                </tr>
                                <tr>
                                    <td>Zip Code</td>
                                    <td><?php echo $shippingAddress->zipcode; ?></td>
                                </tr>
                                <tr>
                                    <td>City</td>
                                    <td><?php echo $shippingAddress->city; ?></td>
                                </tr>
                                <tr>
                                    <td>State</td>
                                    <td><?php echo $shippingAddress->state; ?></td>
                                </tr>
                                <tr>
                                    <td>Country</td>
                                    <td><?php echo $shippingAddress->country; ?></td>
                                </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Product Information</h3>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Item Id</th>
                                <th>Order Id</th>
                                <th>Product Id</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Tax</th>
                                <th>Tax Amount</th>
                                <th>Discount</th>
                            </tr>
                            <?php if(!$items): ?>
                            <tr>
                                <td colspan="6">no item found</td>
                            </tr>
                            <?php else: ?>
                            <?php $i = 0; ?>
                            <?php foreach($items as $item): ?>
                            <tr>
                                <td><?php echo $item->itemId ?></td>
                                <td><?php echo $item->orderId ?></td>
                                <td><?php echo $item->productId ?></td>
                                <td><img src="Media/Product/<?php echo $item->getProduct()->getBase()->name; ?>" alt="image not found" width="50" hight="50"></td>
                                <td><?php echo $item->name; ?></td>
                                <td><?php echo $item->quantity; ?></td>
                                <td><?php echo $item->price; ?></td>
                                <td><?php echo $item->tax; ?></td>
                                <td><?php echo $item->taxAmount; ?></td>
                                <td><?php echo $item->discount; ?></td>
                            </tr>
                            <?php $i++; ?>
                            <?php endforeach; ?>
                            <?php endif;?>
                            <tr>
                                <td colspan="9" align="right">Shiping Charge</td>
                                <td align="center"><?php echo $order->shippingCharge; ?></td>
                            </tr>
                            <tr>
                                <td colspan="9" align="right">Grand Total</td>
                                <td align="center" colspan="9"><?php echo $order->grandTotal; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Order Track</h3>
    </div>
    <div class="card-body" id="orderStatus">
        <div class="form-group row">
            <label for="note" class="col-sm-2 col-form-label">Note</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="order[note]" value="<?php echo $comment->note ?>" class="form-control" id="note" placeholder="Note">
            </div>
        </div>
        <div class="form-group row">
            <label for="order[status]" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
                <select class="form-control" name="order[status]">
                    <option value="1" <?php echo ($order->getStatus($order->status) == 'Pending')?'selected':'' ?>>Pending</option>
                    <option value="2" <?php echo ($order->getStatus($order->status) == 'Processing')?'selected':'' ?>>Processing</option>
                    <option value="3" <?php echo ($order->getStatus($order->status) == 'Completed')?'selected':'' ?>>Completed</option>
                    <option value="4" <?php echo ($order->getStatus($order->status) == 'Cancelled')?'selected':'' ?>>Cancelled</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="order[state]" class="col-sm-2 col-form-label">State</label>
            <div class="col-sm-10">
                <select class="form-control" name="order[state]">
                    <option value="1" <?php echo ($order->getState($order->state) == 'Pending')?'selected':'' ?>>Pending</option>
                    <option value="2" <?php echo ($order->getState($order->state) == 'Packaging')?'selected':'' ?>>Packaging</option>
                    <option value="3" <?php echo ($order->getState($order->state) == 'Shipped')?'selected':'' ?>>Shipped</option>
                    <option value="4" <?php echo ($order->getState($order->state) == 'Delivery')?'selected':'' ?>>Delivery</option>
                    <option value="5" <?php echo ($order->getState($order->state) == 'Dispatched')?'selected':'' ?>>Dispatched</option>
                    <option value="6" <?php echo ($order->getState($order->state) == 'Completed')?'selected':'' ?>>Completed</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="order[customerNotified]" class="col-sm-2 col-form-label">Send Customer Notification?</label>
            <div class="col-sm-10">
                <select class="form-control" name="order[customerNotified]">
                    <option value="1" <?php echo ($comment->customerNotified == 1)?'selected':'' ?>>Yes</option>
                    <option value="2" <?php echo ($comment->customerNotified == 2)?'selected':'' ?>>No</option>
                </select>
            </div>
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-primary" id="orderStatusUpdateBtn">Save</button>
            <button type="button" class="btn btn-primary" id="orderCancelBtn">Cancel</button>
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#orderStatusUpdateBtn").click(function(){
        admin.setForm(jQuery("#indexForm"));
        admin.setUrl("<?php echo $this->getUrl('statusUpdate','order'); ?>");
        admin.setType('POST');
        admin.load();
    });

    $("#orderCancelBtn").click(function(){
        admin.setUrl("<?php echo $this->getUrl('gridBlock','cart',['id' => null]); ?>");
        admin.load();
    })
</script>
