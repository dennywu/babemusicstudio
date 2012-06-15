<?php
    ob_clean();
    session_start();
    if($_SESSION  != null)
    {
        header("Location:/rent-band/views/admin/home.php");
    }
?>
<html>
    <head></head>
    <body>
        <form action="/rent-band/Application/admin/login.php" method="POST">
        <table>
            <tr>
                <td colspan="2">Login Babe Music Studio</td>
            </tr>
            <tr>
                <td>Username</td>
                <td><input name="username" type="text" required/></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input name="password" type="password" required/></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Login"/></td>
            </tr>
        </table>
        </form>
    </body>
</html>