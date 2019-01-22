<?php
/**
 * Created by PhpStorm.
 * User: 86937
 * Date: 2019/1/18
 * Time: 11:53
 */

require_once "album.inc.php";

function addPro($link) {
    $arr = $_POST;
    $arr["pubTime"] = time();
    $uploadFiles = uploadFile("../images");
    if (!is_array($uploadFiles)) $uploadFiles = [$uploadFiles];
    foreach ($uploadFiles as $key => $uploadFile) {
        resizeImage("../images/" . $uploadFile["name"], "../image_50/".$uploadFile["name"], 50, 50);
        resizeImage("../images/" . $uploadFile["name"], "../image_220/".$uploadFile["name"], 220, 220);
        resizeImage("../images/" . $uploadFile["name"], "../image_350/".$uploadFile["name"], 350, 350);
    }

    $res = insert($link, "product", $arr);
    $pid = getInsertId($link);

    if ($res and $pid) {
        foreach ($uploadFiles as $key=>$uploadFile) {
            $arr_album["pid"] = $pid;
            $arr_album["albumPath"] = $uploadFile["name"];
            addAlbum($link, $arr_album);
        }
        $mes = "<p>Add product successfully</p><a href='addPro.php' target='mainFrame'>Add another</a> | <a href='listPro.php' target='mainFrame'>Product List</a>";
    } else {
        foreach ($uploadFiles as $uploadFile) {
            if (file_exists("../images" . $uploadFile["name"])) {
                unlink("../images" . $uploadFile["name"]);
            }
            if (file_exists("../image_50" . $uploadFile["name"])) {
                unlink("../image_50" . $uploadFile["name"]);
            }
            if (file_exists("../image_220" . $uploadFile["name"])) {
                unlink("../image_220" . $uploadFile["name"]);
            }
            if (file_exists("../image_350" . $uploadFile["name"])) {
                unlink("../image_350" . $uploadFile["name"]);
            }
        }
        $mes = "<p>Failed to add product</p><a href='addPro.php' target='mainFrame'>Re-add product</a> | <a href='listPro.php' target='mainFrame'>Product List</a>";
    }

    return $mes;
}


function getAllProByAdmin($link) {
    $sql = "select p.id, p.pName, p.pSn, p.mPrice, p.iPrice, p.pDesc, p.pubTime, p.isShow, p.isHot from product as p join category c on p.cId = c.id";
    $rows = fetchAll($link, $sql);
    return $rows;
}


function getAllImgByProId($link, $id) {
    $sql = "select a.albumPath from album a where pid={$id}";
    $rows = fetchAll($link, $sql);
    return $rows;
}


function getProById($link, $id) {
    $sql = "select product.*, category.cName from product, category where product.id={$id} and product.cid=category.id";
    $row = fetchOne($link, $sql);
    return $row;
}


function editPro($link, $id) {
    $arr = $_POST;
    $uploadFiles = uploadFile("../images");
    if (!is_array($uploadFiles)) $uploadFiles = [$uploadFiles];
    foreach ($uploadFiles as $key => $uploadFile) {
        resizeImage("../images/" . $uploadFile["name"], "../image_50/" . $uploadFile["name"], 50, 50);
        resizeImage("../images/" . $uploadFile["name"], "../image_220/" . $uploadFile["name"], 220, 220);
        resizeImage("../images/" . $uploadFile["name"], "../image_350/" . $uploadFile["name"], 350, 350);
    }

    $res = update($link, "product", $arr, "id={$id}");
    $pid = $id;

    if ($res and $pid) {
        foreach ($uploadFiles as $key=>$uploadFile) {
            $arr_album["pid"] = $pid;
            $arr_album["albumPath"] = $uploadFile["name"];
            addAlbum($link, $arr_album);
        }
        $mes = "<p>Edit product successfully</p><a href='editPro.php' target='mainFrame'>Edit it again</a> | <a href='listPro.php' target='mainFrame'>Product List</a>";
    } else {
        foreach ($uploadFiles as $uploadFile) {
            if (file_exists("../images" . $uploadFile["name"])) {
                unlink("../images" . $uploadFile["name"]);
            }
            if (file_exists("../image_50" . $uploadFile["name"])) {
                unlink("../image_50" . $uploadFile["name"]);
            }
            if (file_exists("../image_220" . $uploadFile["name"])) {
                unlink("../image_220" . $uploadFile["name"]);
            }
            if (file_exists("../image_350" . $uploadFile["name"])) {
                unlink("../image_350" . $uploadFile["name"]);
            }
        }
        $mes = "<p>Failed to edit product</p><a href='editPro.php' target='mainFrame'>Re-edit product</a> | <a href='listPro.php' target='mainFrame'>Product List</a>";
    }

    return $mes;
}


function delPro($link, $id) {
    if (!delete($link, "product", "id={$id}")) {
        $mes = "<p>Failed to delete product</p><a href='delPro.php' target='mainFrame'>Re-delete product</a> | <a href='listPro.php' target='mainFrame'>Product List</a>";
    }
    else if (!delete($link, "album", "pid={$id}")) {
        $mes = "<p>Failed to delete product images</p><a href='delPro.php' target='mainFrame'>Re-delete product</a> | <a href='listPro.php' target='mainFrame'>Product List</a>";
    }
    else $mes = "<p>Delete product successfully</p><a href='delPro.php' target='mainFrame'>Delete another product</a> | <a href='listPro.php' target='mainFrame'>Product List</a>";
    return $mes;
}


function getAllPros($link) {
    $sql = "select * from product";
    $rows = fetchAll($link, $sql);
    return $rows;
}


function getProsByCid($link, $id) {
    $sql = "select * from product where cid={$id} limit 4";
    $rows = fetchAll($link, $sql);
    return $rows;
}


function getProImgById($link, $id) {
    $sql = "select albumPath from album where pid={$id} limit 1";
    $row = fetchOne($link, $sql);
    return $row;
}


function getProImgsById($link, $id) {
    $sql = "select albumPath from album where pid={$id}";
    $rows = fetchAll($link, $sql);
    return $rows;
}


function getSmallProsByCid($link, $id) {
    $sql = "select * from product where cid={$id} limit 4, 4";
    $rows = fetchAll($link, $sql);
    return $rows;
}

?>