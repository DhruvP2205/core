<?php $cart = $this->getCart();
$billingAddress = $cart->getBillingAddress();
$shippingAddress = $cart->getShippingAddress(); ?>

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
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="billingAddress[firstName]" class="col-sm-2 form-check-label">First Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="billingAddress[firstName]" value="<?php echo $billingAddress->firstName ?>" class="form-control" id="billingAddress[firstName]" placeholder="First Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-check-label" for="billingAddress[lastName]">Last Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="billingAddress[lastName]" value="<?php echo $billingAddress->lastName ?>" class="form-control" id="billingAddress[lastName]" placeholder="Last Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-check-label" for="billingAddress[address]">Address</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="billingAddress[address]" id="billingAddress[address]" rows="3" placeholder="Address"><?php echo $billingAddress->address; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-check-label" for="billingAddress[zipcode]">Zip Code</label>
                                <div class="col-sm-10">
                                    <input type="number" name="billingAddress[zipcode]" value="<?php echo $billingAddress->zipcode ?>" class="form-control" id="billingAddress[zipcode]" placeholder="Zipcode">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-check-label" for="billingAddress[city]">City</label>
                                <div class="col-sm-10">
                                    <input type="text" name="billingAddress[city]" value="<?php echo $billingAddress->city ?>" class="form-control" id="billingAddress[city]" placeholder="City">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-check-label" for="billingAddress[state]">State</label>
                                <div class="col-sm-10">
                                    <input type="text" name="billingAddress[state]" value="<?php echo $billingAddress->state ?>" class="form-control" id="billingAddress[state]" placeholder="State">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-check-label" for="billingAddress[country]">Country</label>
                                <div class="col-sm-10">
                                    <input type="text" name="billingAddress[country]" value="<?php echo $billingAddress->country ?>" class="form-control" id="billingAddress[country]" placeholder="Country">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="copyAddress" id="copyAddress" onchange="sameAddress()">
                                    <label class="form-check-label" for="copyAddress" class="form-check-label">Same as Shiping Address</label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="saveInBilingBook" >
                                    <label class="form-check-label" for="saveInBilingBook" class="form-check-label">Save to Address Book</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="button" id="customerAddressSubmitBtn" class="col-sm-12 btn btn-primary" name="submit" value="Save">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Shipping Address</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 form-check-label" for="shippingAddress[firstName]">First Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="shippingAddress[firstName]" value="<?php echo $shippingAddress->firstName ?>" class="form-control" id="shippingAddress[firstName]" placeholder="First Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-check-label" for="shippingAddress[lastName]">Last Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="shippingAddress[lastName]" value="<?php echo $shippingAddress->lastName ?>" class="form-control" id="shippingAddress[lastName]" placeholder="Last Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-check-label" for="shippingAddress[address]">Address</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="shippingAddress[address]" id="shippingAddress[address]" rows="3" placeholder="Address"><?php echo $shippingAddress->address; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-check-label" for="shippingAddress[zipcode]">Zip Code</label>
                                <div class="col-sm-10">
                                    <input type="number" name="shippingAddress[zipcode]" value="<?php echo $shippingAddress->zipcode ?>" class="form-control" id="shippingAddress[zipcode]" placeholder="Pincode">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-check-label" for="shippingAddress[city]">City</label>
                                <div class="col-sm-10">
                                    <input type="text" name="shippingAddress[city]" value="<?php echo $shippingAddress->city ?>" class="form-control" id="shippingAddress[city]" placeholder="City">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-check-label" for="shippingAddress[state]">State</label>
                                <div class="col-sm-10">
                                    <input type="text" name="shippingAddress[state]" value="<?php echo $shippingAddress->state ?>" class="form-control" id="shippingAddress[state]" placeholder="State">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-check-label" for="shippingAddress[country]">Country</label>
                                <div class="col-sm-10">
                                    <input type="text" name="shippingAddress[country]" value="<?php echo $shippingAddress->country ?>" class="form-control" id="shippingAddress[country]" placeholder="Country">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="saveInShipingBook">
                                    <label class="form-check-label" for="saveInShipingBook" class="form-check-label">Save to Address Book</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#customerAddressSubmitBtn").click(function(){
        admin.setForm(jQuery("#indexForm"));
        admin.setUrl("<?php echo $this->getUrl('saveCartAddress') ?>");
        admin.load();
    });

</script>
