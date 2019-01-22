<?php
/**
 * Created by PhpStorm.
 * User: 86937
 * Date: 2019/1/12
 * Time: 23:13
 */

require_once "../include.php";

$admins = getAllAdmin($db_link);
if (!$admins) {
    alertMes("Sorry. There is no admin. Please add one!", "addAdmin.php");
}

$page = isset($_REQUEST["page"])?(int)$_REQUEST["page"]:1;

$pageSize = 10;
$totalPage = ceil(sizeof($admins) / $pageSize);
$admins = pageArrange($db_link, "admin", $page, $totalPage, $pageSize);

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
            <th width="25%">Admin Name</th>
            <th width="35%">Admin Email</th>
            <th>Operation</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 1; foreach ($admins as $row): ?>
        <tr>
            <td><?php echo $i; $i+=1; ?></td>
            <td><?php echo $row["username"]; ?></td>
            <td><?php echo $row["email"]; ?></td>
            <td align="center">
                <input type="button" value="Fix" class="btn" onclick="editAdmin(<?php echo $row['id']; ?>)">
                <input type="button" value="Del" class="btn" onclick="delAdmin(<?php echo $row['id']; ?>)">
            </td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="4"><?php echo showPage($page,  $totalPage); ?></td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>


<script>
    function editAdmin(id) {
        window.location="editAdmin.php?id="+id;
    }
    function delAdmin(id) {
        if (window.confirm("Are you sure you want to delete this admin?")) {
            window.location = "delAdmin.php?id=" + id;
        }
    }
</script>