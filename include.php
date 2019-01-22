<?php
/**
 * Created by PhpStorm.
 * User: 86937
 * Date: 2019/1/7
 * Time: 16:45
 */

header("content-type:text/html;charset=utf-8");

/* start a session */
session_start();

define("ROOT", dirname(__FILE__));
set_include_path(".".
    PATH_SEPARATOR.ROOT."\lib".
    PATH_SEPARATOR.ROOT."\core".
    PATH_SEPARATOR.ROOT."\configs".
    PATH_SEPARATOR.ROOT.get_include_path()
);

require_once "configs.php";
require_once "mysql.func.php";
require_once "image.func.php";
require_once "common.func.php";
require_once "string.func.php";
require_once "page.func.php";
require_once "upload.func.php";
require_once "admin.inc.php";
require_once "cate.inc.php";
require_once "pro.inc.php";
require_once "album.inc.php";

$db_link = connect();   // connect database

?>