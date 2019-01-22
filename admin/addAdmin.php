<?php
/**
 * Created by PhpStorm.
 * User: 86937
 * Date: 2019/1/10
 * Time: 16:32
 */
?>

</<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang=">">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Add Admin</title>
</head>
<body>
<h3>Add New Admin to System</h3>
<form action="doAdminAction.php?act=addAdmin" method="post">
    <table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
        <tr>
            <td align="right">Admin Name</td>
            <td><input type="text" name="username" placeholder="Please input username"></td>
        </tr>
        <tr>
            <td align="right">Admin Password</td>
            <td><input type="password" name="password" placeholder="Please input password"></td>
        </tr>
        <tr>
            <td align="right">Admin Email</td>
            <td><input type="text" name="email" placeholder="Please input email"></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="Add Admin"> </td>
        </tr>
    </table>

</form>
</body>
</html>