<?php $billingAddress = $this->getBillingAddress();?>
<?php $shippingAddress = $this->getShippingAddress();?>

<table>
    <tr>
        <td colspan="2"><h3>Billing Address:</h3></td>
    </tr>
    <tr>
        <td>Address</td>
        <td><textarea name="billingAddress[address]" id="billingAddress[address]" rows="4" cols="50"><?php echo $billingAddress->address; ?></textarea></td>
    </tr>
    <tr>
        <td>Zip code</td>
        <td><input type="text" name="billingAddress[zipcode]" id="billingAddress[zipcode]" value="<?php echo $billingAddress->zipcode; ?>"></td>
    </tr>
    <tr>
        <td>City</td>
        <td><input type="text" name="billingAddress[city]" id="billingAddress[city]" value="<?php echo $billingAddress->city; ?>"></td>
    </tr>
    <tr>
        <td>State</td>
        <td><input type="text" name="billingAddress[state]" id="billingAddress[state]" value="<?php echo $billingAddress->state; ?>"></td>
    </tr>
    <tr>
        <td>Country</td>
        <td><input type="text" name="billingAddress[country]" id="billingAddress[country]" value="<?php echo $billingAddress->country; ?>"></td>
    </tr>
    <tr>
        <td colspan="2"><h3>Shiping Address:</h3></td>
    </tr>
    <tr><td colspan="2"><input type="checkbox" name="copyAddress" id="copyAddress" onchange="sameAddress()" /> Same as Billing Address</td></tr>
    <tr>
        <td>Address</td>
        <td><textarea name="shippingAddress[address]" id="shippingAddress[address]" rows="4" cols="50"><?php echo $shippingAddress->address; ?></textarea></td>
    </tr>
    <tr>
        <td>Zip code</td>
        <td><input type="text" name="shippingAddress[zipcode]" id="shippingAddress[zipcode]" value="<?php echo $shippingAddress->zipcode; ?>"></td>
    </tr>
    <tr>
        <td>City</td>
        <td><input type="text" name="shippingAddress[city]" id="shippingAddress[city]" value="<?php echo $shippingAddress->city; ?>"></td>
    </tr>
    <tr>
        <td>State</td>
        <td><input type="text" name="shippingAddress[state]" id="shippingAddress[state]" value="<?php echo $shippingAddress->state; ?>"></td>
    </tr>
    <tr>
        <td>Country</td>
        <td><input type="text" name="shippingAddress[country]" id="shippingAddress[country]" value="<?php echo $shippingAddress->country; ?>"></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>
            <input type="button" id="submit" name="submit" value="Save">
            <button type="button"><a href="<?php echo $this->getUrl('grid','customer',[],true) ?>">Cancel</a></button>
        </td>
    </tr>
</table> 

<script type="text/javascript">
    function sameAddress()
    {
        var checkedBox = document.getElementById("copyAddress");
        
        if(checkedBox.checked == true){
            document.getElementById("shippingAddress[address]").value = document.getElementById("billingAddress[address]").value; 
            document.getElementById("shippingAddress[zipcode]").value = document.getElementById("billingAddress[zipcode]").value; 
            document.getElementById("shippingAddress[city]").value = document.getElementById("billingAddress[city]").value; 
            document.getElementById("shippingAddress[state]").value = document.getElementById("billingAddress[state]").value; 
            document.getElementById("shippingAddress[country]").value = document.getElementById("billingAddress[country]").value; 
        }
        else
        {
                document.getElementById("shippingAddress[address]").value = null; 
                document.getElementById("shippingAddress[zipcode]").value = null; 
                document.getElementById("shippingAddress[city]").value = null; 
                document.getElementById("shippingAddress[state]").value = null; 
                document.getElementById("shippingAddress[country]").value = null; 
        }
    }
</script>
