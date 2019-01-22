<?php
/**
 * Created by PhpStorm.
 * User: 86937
 * Date: 2019/1/18
 * Time: 12:06
 */

function addAlbum($link, $arr){
    return insert($link, "album", $arr);
}

?>