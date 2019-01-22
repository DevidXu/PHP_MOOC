<?php
/**
 * Created by PhpStorm.
 * User: 86937
 * Date: 2019/1/7
 * Time: 15:49
 */

function connect() {
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PWD ) or die("Connection failed".mysqli_connect_errno().":".mysqli_connect_error());
    mysqli_set_charset($link, DB_CHARSET);
    mysqli_select_db($link, DB_DBNAME) or die("Failed to connect database");
    return $link;
}


function insert($link, $table, $array) {
    $keys = join(",", array_keys($array));
    $values = "'".join("', '", array_values($array))."'";
    $sql = "insert into {$table} ({$keys}) values({$values})";
    mysqli_query($link, $sql) or die("Meet error when trying to insert");
    return mysqli_insert_id($link);
}


function getInsertId($link) {
    return mysqli_insert_id($link);
}


function update($link, $table, $array, $where = null) {
    $str = null;
    foreach ($array as $key=>$value) {
        if ($str==null){
            $sep = "";
        }
        else {
            $sep = ",";
        }
        $str .= "{$sep}{$key}='{$value}'";
    }
    $sql = "update {$table} set {$str}".($where==null?null:" where ".$where);

    $result = mysqli_query($link, $sql);
    if (!$result) return false;
    return mysqli_affected_rows($link);
}


function delete($link, $table, $where = null) {
    $where = ($where==null?null:"where ".$where);
    $sql = "delete from {$table} {$where}";
    mysqli_query($link, $sql);
    return mysqli_affected_rows($link);
}


function fetchOne($link, $sql, $result_type=MYSQLI_ASSOC) {
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result, $result_type);
    return $row;
}


function fetchAll($link, $sql, $result_type=MYSQLI_ASSOC) {
    $result = mysqli_query($link, $sql);
    $rows = [];
    while (@$row=mysqli_fetch_array($result, $result_type)) {
        $rows[] = $row;
    }
    return $rows;
}


function getResultNum($link, $sql) {
    $result = mysqli_query($link, $sql);
    if ($result==false) return 0;
    return mysqli_num_rows($result);
}

?>