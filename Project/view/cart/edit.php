<?php $customers = $this->getCustomers(); 
$cart = $this->getCart();
$customer = $cart->getCustomer(); ?>
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Cart Information</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Select Customer</label>
                    <select class="form-control" id="cartChange" onchange="changeCustomer()">
                        <option value="none">Select</option>
                        <?php foreach($customers as $cust): 
                            print_r($cust->customerId); ?>
                            <option value="<?php echo $cust->customerId ?>">Id: <?php echo $cust->customerId ?>&nbsp;&nbsp;&nbsp; Name: <?php echo $cust->firstName?>&nbsp;&nbsp;&nbsp; Email: <?php echo $cust->email; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div id="customerDetails">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $customer->firstName; ?></td>
                        <td><?php echo $customer->lastName; ?></td>
                        <td><?php echo $customer->email; ?></td>
                        <td><?php echo $customer->mobile; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-body">
        <div id="cartAddress">
        </div>
    </div>

    <div class="card-body">
        <div id="paymentShipping">
        </div>
    </div>
    
    <div class="card-body">
        <div id="cartProduct">
        </div>
    </div>

    <div class="card-body">
        <div id="cartSubTotal">
        </div>
    </div>
</div>


<script type="text/javascript">
    function changeCustomer() 
    {
        const val = document.getElementById('selectcustomer').selectedOptions[0].value;
        window.location = "<?php echo $this->getUrl('addCart','cart',['id'=>null]);?>&id="+val;
    }

    function sameAddress()
    {
        var checkedBox = document.getElementById("copyAddress");
        
        if(checkedBox.checked == true)
        {
            document.getElementById("shippingAddress[firstName]").value = document.getElementById("billingAddress[firstName]").value; 
            document.getElementById("shippingAddress[lastName]").value = document.getElementById("billingAddress[lastName]").value; 
            document.getElementById("shippingAddress[address]").value = document.getElementById("billingAddress[address]").value; 
            document.getElementById("shippingAddress[zipcode]").value = document.getElementById("billingAddress[zipcode]").value; 
            document.getElementById("shippingAddress[city]").value = document.getElementById("billingAddress[city]").value; 
            document.getElementById("shippingAddress[state]").value = document.getElementById("billingAddress[state]").value; 
            document.getElementById("shippingAddress[country]").value = document.getElementById("billingAddress[country]").value; 
        }
        else
        {
            document.getElementById("shippingAddress[firstName]").value = null; 
            document.getElementById("shippingAddress[lastName]").value = null; 
            document.getElementById("shippingAddress[address]").value = null; 
            document.getElementById("shippingAddress[zipcode]").value = null; 
            document.getElementById("shippingAddress[city]").value = null; 
            document.getElementById("shippingAddress[state]").value = null; 
            document.getElementById("shippingAddress[country]").value = null; 
        }
    }
</script>
<script>
    $(document).ready(function(){
        $("#productTable").hide();
        $("#showProduct").click(function(){
            $("#productTable").show();
        });
        $("#hideProduct").click(function(){
            $("#productTable").hide();
        });
    });
</script>
<script>
    $(document).ready(function(){
        admin.setUrl("<?php echo $this->getUrl('indexBlock'); ?>");
        admin.load();

        $("#cartChange").change(function(){
            admin.setData({'id' : $(this).val()});
            admin.setUrl("<?php echo $this->getUrl('addCart',null,['id'=>null]);?>");
            admin.load();
        });
    });
</script>
