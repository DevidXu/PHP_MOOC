<?php
/**
 * Created by PhpStorm.
 * User: 86937
 * Date: 2019/1/12
 * Time: 23:47
 */

require_once "../include.php";

$id = $_REQUEST["id"];
$sql = "select * from admin where id = {$id}";
$row = fetchOne($db_link, $sql);
?>

</<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang=">">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Delete Admin</title>
</head>
<body>
<h3>Delete Admin</h3>
<form action="doAdminAction.php?act=delAdmin&id=<?php echo $id; ?>" method="post">
    <table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
        <tr>
            <td align="right">Admin Name</td>
            <td><input type="text" name="username" placeholder=<?php echo $row["username"]; ?>></td>
        </tr>
        <tr>
            <td align="right">Admin Password</td>
            <td><input type="password" name="password" placeholder=<?php echo $row["password"]; ?>></td>
        </tr>
        <tr>
            <td align="right">Admin Email</td>
            <td><input type="text" name="email" placeholder=<?php echo $row["email"]; ?>></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="Delete Admin"> </td>
        </tr>
    </table>

</form>
</body>
</html>
