<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add Customer</title>
</head>
<body>
    <h2>Add Customer</h2>
    <form action="customer-index.php?a=saveAction" method="post">
        <h3>Personal Information: </h3>
        <label>First Name</label>
        <input type="text" name="customer[firstName]" required />
        <br>
        <br>
        <label>Last Name</label>
        <input type="text" name="customer[lastName]" required />
        <br>
        <br>
        <label>Email</label>
        <input type="text" name="customer[email]" required />
        <br>
        <br>
        <label>Mobile</label>
        <input type="text" name="customer[mobile]" required />
        <br>
        <br>
        <label>Status</label>
        <select name="customer[status]">
            <option value="1" selected>Active</option>
            <option value="2">Inactive</option>
        </select>
        <br>
        <br>
        <h3>Address Information: </h3>
        <label>Address</label>
        <textarea name="address[address]" rows="4" cols="50" required></textarea>
        <br>
        <br>
        <label>Zip code</label>
        <input type="number" name="address[zipcode]" minlength="6" maxlength="7" required />
        <br>
        <br>
        <label>City</label>
        <input type="text" name="address[city]" required />
        <br>
        <br>
        <label>State</label>
        <input type="text" name="address[state]" required />
        <br>
        <br>
        <label>Country</label>
        <input type="text" name="address[country]" required />
        <br>
        <br>
        <label>Address type</label>
        <input type="checkbox" name="address[billing]" value="1" checked>
        <label> Billing</label>
        <input type="checkbox" name="address[shiping]" value="1">
        <label> Shiping</label>
        <br>
        <br>
        <input class="submit" type="submit" name='submit' id='submit' value="Save"  />
    </form>
</body>
</html>
