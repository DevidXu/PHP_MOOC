<?php
/**
 * Created by PhpStorm.
 * User: 86937
 * Date: 2019/1/7
 * Time: 15:49
 */

function alertMes($message, $url) {
    echo "<script>alert('{$message}');</script>";
    echo "<script>window.location='{$url}';</script>";
}

?>