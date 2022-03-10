<form action="<?php echo $this->getUrl('loginPost','admin_login') ?>" method="POST">
    <h2>Login</h2>
    <table border="1" width="100%" cellspacing="4">
        <tr>
            <td width="10%">Email</td>
            <td><input type="email" name="admin[email]"></td>
        </tr>
        <tr>
            <td width="10%">Password</td>
            <td><input type="password" name="admin[password]"></td>
        </tr>
        <tr>
            <td width="10%">&nbsp;</td>
            <td><input type="submit" value="Login"></td>
        </tr>
    </table>
</form>
