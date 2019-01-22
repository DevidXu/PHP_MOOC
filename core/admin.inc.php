<?php
/**
 * Created by PhpStorm.
 * User: 86937
 * Date: 2019/1/8
 * Time: 16:28
 */

function checkAdmin($link, $sql) {
    return fetchOne($link, $sql);
}


function checkLogined() {
    if ((!isset($_SESSION["adminId"]) or $_SESSION["adminId"]=="") and
        (!isset($_COOKIE["adminId"]) or $_COOKIE["adminId"]=="")
        ){
        alertMes("Login first!", "login.php");
    }
    else if (isset($_COOKIE["adminId"]) and $_COOKIE["adminId"]!="") {
        $_SESSION["adminId"] = $_COOKIE["adminId"];
    }
    return;
}


function logout() {
    $_SESSION = array();
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), "", time()-1);
    }
    if (isset($_COOKIE["adminId"])) {
        setcookie("adminId", "", time()-1);
    }
    if (isset($_COOKIE["adminName"])) {
        setcookie("adminName", "", time()-1);
    }
    session_destroy();
    header("location:login.php");
}


function addAdmin($link) {
    $arr = $_POST;
    $arr["password"] = md5($arr["password"]);
    if (insert($link, "admin", $arr)) {
        $mes = "Added Successfully!<br><a href='addAdmin.php'>Add Another</a>|<a href='listAdmin.php'>List Admins</a>";
    }
    else {
        $mes = "Added failed!<br><a href='addAdmin.php'>Re-Add Admin</a>";
    }
    return $mes;
}


function getAllAdmin($link) {
    $sql = "select id, username, email from admin";
    $rows = fetchAll($link, $sql);
    return $rows;
}


function editAdmin($link, $id) {
    $arr = $_POST;
    $arr["password"] = md5($arr["password"]);
    if (update($link, "admin", $arr, "id={$id}")) {
        $mes = "Edited Successfully!<br><a href='listAdmin.php'>List Admins</a>";
    }
    else {
        $mes = "Edited failed!<br><a href='editAdmin.php'>Re-edit Admin</a>";
    }
    return $mes;
}


function delAdmin($link, $id) {
    if (delete($link, "admin", "id={$id}")) {
        $mes = "Deleted Successfully!<br><a href='listAdmin.php'>List Admins</a>";
    }
    else {
        $mes = "Deleted failed!<br><a href='delAdmin.php'>Re-delete Admin</a>";
    }
    return $mes;
}

?>