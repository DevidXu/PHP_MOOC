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
    <title>Add Category</title>
</head>
<body>
<h3>Add New Category to System</h3>
<form action="doAdminAction.php?act=addCate" method="post">
    <table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
        <tr>
            <td align="right">Category Name</td>
            <td><input type="text" name="cName" placeholder="Please input category name"></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="Add Category"> </td>
        </tr>
    </table>

</form>
</body>
</html>