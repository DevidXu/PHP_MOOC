<?php
/**
 * Created by PhpStorm.
 * User: 86937
 * Date: 2019/1/12
 * Time: 23:13
 */

require_once "../include.php";

$page = isset($_REQUEST["page"])?(int)$_REQUEST["page"]:1;
$sql = "select * from category";

$pageSize = 2;
$totalPage = ceil(getResultNum($db_link, $sql) / $pageSize);
$categories = pageArrange($db_link, "category", $page, $totalPage, $pageSize);

if (!$categories) {
    alertMes("Sorry. There is no category. Please add one!", "addCate.php");
}

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Backend Management</title>
    <link rel="stylesheet" href="styles/backstage.css">
</head>

<body>
<div>
    <table class="table" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th width="15%">ID</th>
            <th width="25%">Category Name</th>
            <th>Operation</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 1; foreach ($categories as $category): ?>
            <tr>
                <td><?php echo $category["id"]; ?></td>
                <td><?php echo $category["cName"]; ?></td>
                <td align="center">
                    <input type="button" value="Fix" class="btn" onclick="editCate(<?php echo $category['id']; ?>)">
                    <input type="button" value="Del" class="btn" onclick="delCate(<?php echo $category['id']; ?>)">
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if ($totalPage>1): ?>
        <tr>
            <td colspan="3"><?php echo showPage($page,  $totalPage); ?></td>
        </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>


<script>
    function editCate(id) {
        window.location="editCate.php?id="+id;
    }
    function delCate(id) {
        if (window.confirm("Are you sure you want to delete this category?")) {
            window.location = "delCate.php?id=" + id;
        }
    }
</script>