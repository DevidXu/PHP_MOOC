<?php
/**
 * Created by PhpStorm.
 * User: 86937
 * Date: 2019/1/10
 * Time: 14:19
 */

require_once "../include.php";

$mes = "";
if (isset($_REQUEST["act"])) {
    if ($_REQUEST["act"] == "logout") {
        logout();
    }
    else if ($_REQUEST["act"] == "addAdmin") {
        $mes = addAdmin($db_link);
    }
    else if ($_REQUEST["act"] == "editAdmin") {
        $id = $_REQUEST["id"];
        $mes = editAdmin($db_link, $id);
    }
    else if ($_REQUEST["act"] == "delAdmin") {
        $id = $_REQUEST["id"];
        $mes = delAdmin($db_link, $id);
    }
    else if ($_REQUEST["act"] == "addCate") {
        $mes = addCate($db_link);
    }
    else if ($_REQUEST["act"] == "editCate") {
        $id = $_REQUEST["id"];
        $mes = editCate($db_link, $id);
    }
    else if ($_REQUEST["act"] == "delCate") {
        $id = $_REQUEST["id"];
        $mes = delCate($db_link, $id);
    }
    else if ($_REQUEST["act"] == "addPro") {
        $mes = addPro($db_link);
    }
    else if ($_REQUEST["act"] == "editPro") {
        $id = $_REQUEST["id"];
        $mes = editPro($db_link, $id);
    }
    else if ($_REQUEST["act"] == "delPro") {
        $id = $_REQUEST["id"];
        $mes = delPro($db_link, $id);
    }
}

?>

</<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang=">">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Add Admin</title>
</head>
<body>
 <?php echo $mes; ?>
</body>
</html>