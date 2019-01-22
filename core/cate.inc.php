<?php
/**
 * Created by PhpStorm.
 * User: 86937
 * Date: 2019/1/15
 * Time: 13:34
 */

function addCate($link) {
    $arr = $_POST;
    if (insert($link, "category", $arr)) {
        $mes = "Category added! <a href='addCate.php'>Add Another Category</a> | <a href='listCate.php'>Category List</a>";
    }
    else {
        $mes = "Category add failed! <a href='addCate.php'>Re-add Category</a>";
    }
    return $mes;
}


function editCate($link, $id) {
    $arr = $_POST;
    if (update($link, "category", $arr, "id={$id}")) {
        $mes = "Category edited! <a href='listCate.php'>Category List</a>";
    }
    else {
        $mes = "Category edit failed! <a href='listCate.php'>Category List</a>";
    }
    return $mes;
}


function delCate($link, $id) {
    $sql = "select * from product where cid={$id}";
    if (getResultNum($link, $sql)) {
        $mes = "There exist some products under this category. Please delete them first!<a href='listPro.php'>Product List</a>";
        return $mes;
    }

    if (delete($link, "category", "id={$id}")) {
        $mes = "Category deleted! <a href='listCate.php'>Category List</a>";
    }
    else {
        $mes = "Category deletion failed! <a href='delCate.php'>Category List</a>";
    }
    return $mes;
}


function getAllCate($link) {
    $sql = "select id, cName from category";
    $rows = fetchAll($link, $sql);
    return $rows;
}

?>