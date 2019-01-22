<?php
/**
 * Created by PhpStorm.
 * User: 86937
 * Date: 2019/1/7
 * Time: 17:14
 */

require_once "../include.php";

$username = $_POST["username"];
$password = md5($_POST["password"]);
$verify = $_POST["verify"];
$verify_std = $_SESSION["verify"];
$autoFlag = isset($_POST["autoFlag"]);
if ($verify != $verify_std) {
    alertMes("Wrong verification code", "login.php");
}

$sql = "select * from admin where username='{$username}' and password='{$password}'";
$row = checkAdmin($db_link, $sql);

if ($row == null) {
    alertMes("Login failed; please re-login", "login.php");
}
else {
    if ($autoFlag) {
        setcookie("adminId", $row["id"], time()+7*24*3600);
        setcookie("adminName", $row["username"], time()+7*24*3600);
    }
    $_SESSION["adminName"] = $username;
    $_SESSION["adminId"] = $row["id"];
    echo "<script>window.location='index.php';</script>";
}

?>