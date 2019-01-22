<?php
/**
 * Created by PhpStorm.
 * User: 86937
 * Date: 2019/1/12
 * Time: 23:47
 */

require_once "../include.php";

$id = $_REQUEST["id"];
$sql = "select * from category where id = {$id}";
$row = fetchOne($db_link, $sql);
?>

</<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang=">">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Edit Category</title>
</head>
<body>
<h3>Edit Category Information</h3>
<form action="doAdminAction.php?act=editCate&id=<?php echo $id; ?>" method="post">
    <table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
        <tr>
            <td align="right">Category Name</td>
            <td><input type="text" name="cName" placeholder=<?php echo $row["cName"]; ?>></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="Edit Cate"> </td>
        </tr>
    </table>

</form>
</body>
</html>
