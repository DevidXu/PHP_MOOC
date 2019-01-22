<?php 
require_once '../include.php';

$order=isset($_REQUEST['order'])?$_REQUEST['order']:null;
$orderBy=$order?"order by p.".$order:null;
$keywords=isset($_REQUEST['keywords'])?$_REQUEST['keywords']:null;
$where=$keywords?"where p.pName like '%{$keywords}%'":null;

// get all products in database (satisfying where)
$sql = "select * from product as p {$where}";
$totalRows=getResultNum($db_link, $sql);
$pageSize=2;
$totalPage=ceil($totalRows/$pageSize);
$page=isset($_REQUEST['page'])?(int)$_REQUEST['page']:1;
if($page<1||$page==null||!is_numeric($page))$page=1;
if($page>$totalPage)$page=$totalPage;
$offset=($page-1)*$pageSize;
$sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName from product as p join category c on p.cId=c.id {$where} {$orderBy} limit {$offset},{$pageSize}";
$rows=fetchAll($db_link, $sql);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>-.-</title>
<link rel="stylesheet" href="styles/backstage.css">
<link rel="stylesheet" href="scripts/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
<script src="scripts/jquery-ui/js/jquery-1.10.2.js"></script>
<script src="scripts/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
<script src="scripts/jquery-ui/js/jquery-ui-1.10.4.custom.min.js"></script>
</head>

<body>
<div id="showDetail"  style="display:none;">

</div>
<div class="details">
                    <div class="details_operation clearfix">
                        <div class="bui_select">
                            <input type="button" value="Add Product" class="add" onclick="addPro()">
                        </div>
                        <div class="fr">
                            <div class="text">
                                <span>Product Price：</span>
                                <div class="bui_select">
                                    <select id="" class="select" onchange="change(this.value)">
                                    	<option>-Please Choose-</option>
                                        <option value="iPrice asc" >From low to high</option>
                                        <option value="iPrice desc">From high to low</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text">
                                <span>On-sell Time：</span>
                                <div class="bui_select">
                                 <select id="" class="select" onchange="change(this.value)">
                                 	<option>-Choose-</option>
                                        <option value="pubTime desc" >Public recently</option>
                                        <option value="pubTime asc">Public before</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text">
                                <span>Search</span>
                                <input type="text" value="" class="search"  id="search" onkeypress="search()" >
                            </div>
                        </div>
                    </div>
                    <!--表格-->
                    <table class="table" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">Product Name</th>
                                <th width="10%">Product Category</th>
                                <th width="10%">On-Sell</th>
                                <th width="15%">On-Sell Time</th>
                                <th width="10%">Market Price</th>
                                <th>Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($rows as $row):?>
                            <tr>
                                <!--这里的id和for里面的c1 需要循环出来-->
                                <td><input type="checkbox" id="c<?php echo $row['id'];?>" class="check" value=<?php echo $row['id'];?>><label for="c1" class="label"><?php echo $row['id'];?></label></td>
                                <td><?php echo $row['pName']; ?></td>
                                <td><?php echo $row['cName'];?></td>
                                <td>
                                	<?php echo $row['isShow']==1?"On-sell":"Off-sell";?>
                                </td>
                                 <td><?php echo date("Y-m-d H:i:s",$row['pubTime']);?></td>
                                  <td>$<?php echo $row['iPrice'];?></td>
                                <td align="center">
                                    <input type="button" value="Detail" class="btn" onclick="showDetail(<?php echo $row['id'];?>,'<?php echo $row['pName'];?>')">
                                    <input type="button" value="Fix" class="btn" onclick="editPro(<?php echo $row['id'];?>)">
                                    <input type="button" value="Del" class="btn"onclick="delPro(<?php echo $row['id'];?>)">
                                    <div id="showDetail<?php echo $row['id'];?>" style="display:none;">
                                        <table class="table" cellspacing="0" cellpadding="0">
					                        		<tr>
					                        			<td width="20%" align="right">Product Name</td>
					                        			<td><?php echo $row['pName'];?></td>
					                        		</tr>
					                        		<tr>
					                        			<td width="20%"  align="right">Product Category</td>
					                        			<td><?php echo $row['cName'];?></td>
					                        		</tr>
					                        		<tr>
					                        			<td width="20%"  align="right">Product ID</td>
					                        			<td><?php echo $row['pSn'];?></td>
					                        		</tr>
					                        		<tr>
					                        			<td width="20%"  align="right">Product Num</td>
					                        			<td><?php echo $row['pNum'];?></td>
					                        		</tr>
					                        		<tr>
					                        			<td  width="20%"  align="right">Product Price</td>
					                        			<td><?php echo $row['mPrice'];?></td>
					                        		</tr>
					                        		<tr>
					                        			<td  width="20%"  align="right">Market Price</td>
					                        			<td><?php echo $row['iPrice'];?></td>
					                        		</tr>
					                        		<tr>
					                        			<td width="20%"  align="right">Product Image</td>
					                        			<td>
					                        			<?php
					                        			$proImgs=getAllImgByProId($db_link, $row['id']);
					                        			foreach($proImgs as $img):
					                        			?>
					                        			<img width="100" height="100" src="../images/<?php echo $img['albumPath'];?>" alt=""/> &nbsp;&nbsp;
					                        			<?php endforeach;?>
					                        			</td>
					                        		</tr>
					                        		<tr>
					                        			<td width="20%"  align="right">On-sell</td>
					                        			<td>
					                        				<?php echo $row['isShow']==1?"On-sell":"Off-sell";?>
					                        			</td>
					                        		</tr>
					                        		<tr>
					                        			<td width="20%"  align="right">Hot-sell</td>
					                        			<td>
					                        				<?php echo $row['isHot']==1?"Hot":"Normal";?>
					                        			</td>
					                        		</tr>
					                        	</table>
                                        <span style="display:block;width:80%; ">
                                            Product Description<br/>
                                            <?php echo $row['pDesc'];?>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        <?php  endforeach;?>
                        <?php if($totalRows>$pageSize):?>
                            <tr>
                            	<td colspan="7"><?php echo showPage($page, $totalPage,"keywords={$keywords}&order={$order}");?></td>
                            </tr>
                        <?php endif;?>
                        </tbody>
                    </table>
                </div>
<script type="text/javascript">
function showDetail(id,t){
	$("#showDetail"+id).dialog({
		  height:"auto",
	      width: "auto",
	      position: {my: "center", at: "center",  collision:"fit"},
	      modal:false,//是否模式对话框
	      draggable:true,//是否允许拖拽
	      resizable:true,//是否允许拖动
	      title:"商品名称："+t,//对话框标题
	      show:"slide",
	      hide:"explode"
	});
}
	function addPro(){
		window.location='addPro.php';
	}
	function editPro(id){
		window.location='editPro.php?id='+id;
	}
	function delPro(id){
		if(window.confirm("Are you sure you want to delete this product?")){
			window.location="doAdminAction.php?act=delPro&id="+id;
		}
	}
	function search(){
		if(event.keyCode==13){
			var val=document.getElementById("search").value;
			window.location="listPro.php?keywords="+val;
		}
	}
	function change(val){
		window.location="listPro.php?order="+val;
	}
</script>
</body>
</html>