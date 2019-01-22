<?php
/**
 * Created by PhpStorm.
 * User: 86937
 * Date: 2019/1/7
 * Time: 15:49
 */

function buildRandomString($type=1, $len=10)
{
// type=1: pure number; type=2: letters; type=3: num+letter; type=3: num+letter(small case)
    if ($type==1) {
        $chars = join("", range(0,9));
    }
    else if ($type==2) {
        $chars = join("", array_merge(range('a', 'z'), range('A', 'Z')));
    }
    else if ($type==3) {
        $chars = join("", array_merge(range(0,9), range('a', 'z'), range('A', 'Z')));
    }
    else if ($type==4) {
        $chars = join("", array_merge(range(0,9), range('a', 'z')));
    }
    else die("Unsupported type in buildRandomString\n");

    $result = "";
    for ($i=0;$i<$len;$i++) {
        $result .= $chars[rand()%strlen($chars)];
    }
    return $result;
}


function getUniName() {
    return md5(uniqid(microtime(true), true));
}

function getExt($filename) {
    $arr = explode(".", $filename);
    return strtolower(end($arr));
}

?>