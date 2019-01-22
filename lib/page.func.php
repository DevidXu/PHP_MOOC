<?php
/**
 * Created by PhpStorm.
 * User: 86937
 * Date: 2019/1/7
 * Time: 15:49
 */

function pageArrange($link, $table, $totalPage, $page = 1, $pageSize = 2)
{
    if ($page<1 or $page==null or !is_numeric($page)) {
        $page = 1;
    }
    if ($page>$totalPage) {
        $page = $totalPage;
    }
    $offset = ($page - 1) * $pageSize;
    $sql = "select * from {$table} limit {$offset}, {$pageSize}";
    $rows = fetchAll($link, $sql);

    return $rows;
}


function showPage($page, $totalPage, $where = null, $sep="&nbsp") {
    $where= ($where==null)?null:"&".$where;

    $p = "";
    $url = $_SERVER["PHP_SELF"];
    $index = ($page==1)?"First Page":"<a href='{$url}?page=1{$where}'>First Page</a>";
    $last = ($page==$totalPage)?"Last Page":"<a href='{$url}?page={$totalPage}{$where}'>Last Page</a>";
    $prev = ($page==1)?"Previous Page":"<a href='{$url}?page=".($page-1)."{$where}'>Previous Page</a>";
    $next = ($page==$totalPage)?"Next Page":"<a href='{$url}?page=".($page+1)."{$where}'>Next Page</a>";
    $str = "All {$totalPage} Pages / Current {$page} Page";

    for ($i=1;$i<=$totalPage;$i++) {
        if ($i==$page) {
            $p.="[{$i}]";
        }
        else $p.="<a href='$url?page={$i}'>[{$i}]</a>";
    }

    $pageStr =  $str . $sep . $index . $sep . $prev . $sep . $p . $sep . $next .$sep . $last;
    return $pageStr;
}

?>