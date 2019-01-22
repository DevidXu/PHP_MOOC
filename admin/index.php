<?php 
require_once '../include.php';
checkLogined();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Backend Management</title>
<link rel="stylesheet" href="styles/backstage.css">
</head>

<body>
    <div class="head">
            <div class="logo fl"><a href="#"></a></div>
            <h3 class="head_text fr">EShop Backend Management System</h3>
    </div>
    <div class="operation_user clearfix">
        <div class="link fr">
            <b>Welcome
            <?php 
				if(isset($_SESSION['adminName'])){
					echo $_SESSION['adminName'];
				}elseif(isset($_COOKIE['adminName'])){
					echo $_COOKIE['adminName'];
				}
            ?>
            
            </b>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="icon icon_i">homepage</a><span></span><a href="#" class="icon icon_j">forward</a><span></span><a href="#" class="icon icon_t">backward</a><span></span><a href="#" class="icon icon_n">refresh</a><span></span><a href="doAdminAction.php?act=logout" class="icon icon_e">exit</a>
        </div>
    </div>
    <div class="content clearfix">
        <div class="main">
            <div class="cont">
                <div class="title">backend management</div>
                <iframe src="main.php"  frameborder="0" name="mainFrame" width="100%" height="522"></iframe>
            </div>
        </div>
        <div class="menu">
            <div class="cont">
                <div class="title">Administrator</div>
                <ul class="mList">
                    <li>
                        <h3><span onclick="show('menu1','change1')" id="change1">+</span>Product Manage</h3>
                        <dl id="menu1" style="display:none;">
                        	<dd><a href="addPro.php" target="mainFrame">Add Product</a></dd>
                            <dd><a href="listPro.php" target="mainFrame">Product List</a></dd>
                        </dl>
                    </li>
                    <li>
                        <h3><span onclick="show('menu2','change2')" id="change2">+</span>Category Manage</h3>
                        <dl id="menu2" style="display:none;">
                        	<dd><a href="addCate.php" target="mainFrame">Add Category</a></dd>
                            <dd><a href="listCate.php" target="mainFrame">Category List</a></dd>
                        </dl>
                    </li>
                    <li>
                        <h3><span  onclick="show('menu3','change3')" id="change3" >+</span>Order Manage</h3>
                        <dl id="menu3" style="display:none;">
                            <dd><a href="#">Fix Order</a></dd>
                            <dd><a href="#">Change Order</a></dd>
                            <dd><a href="#">Change Order</a></dd>
                            <dd><a href="#">Test Content</a></dd>
                        </dl>
                    </li>
                    <li>
                        <h3><span onclick="show('menu4','change4')" id="change4">+</span>User Manage</h3>
                        <dl id="menu4" style="display:none;">
                        	<dd><a href="addUser.php" target="mainFrame">Add User</a></dd>
                            <dd><a href="listUser.php" target="mainFrame">User List</a></dd>
                        </dl>
                    </li>
                    <li>
                        <h3><span onclick="show('menu5','change5')" id="change5">+</span>Admin Manage</h3>
                        <dl id="menu5" style="display:none;">
                        	<dd><a href="addAdmin.php" target="mainFrame">Add Admin</a></dd>
                            <dd><a href="listAdmin.php" target="mainFrame">Admin List</a></dd>
                        </dl>
                    </li>
                    
                         <li>
                        <h3><span onclick="show('menu6','change6')" id="change6">+</span>Photo Manage</h3>
                        <dl id="menu6" style="display:none;">
                            <dd><a href="listProImages.php" target="mainFrame">Photo List</a></dd>
                        </dl>
                    </li>
                </ul>
            </div>
        </div>

    </div>
    <script type="text/javascript">
    	function show(num,change){
	    		var menu=document.getElementById(num);
	    		var change=document.getElementById(change);
	    		if(change.innerHTML=="+"){
	    				change.innerHTML="-";
	        	}else{
						change.innerHTML="+";
	            }
    		   if(menu.style.display=='none'){
    	             menu.style.display='';
    		    }else{
    		         menu.style.display='none';
    		    }
        }
    </script>
</body>
</html>