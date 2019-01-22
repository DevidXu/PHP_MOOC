<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Main Info</title>
</head>
<body>
<center>
	<h3>System Info</h3>
	<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
		<tr>
			<th>Operating System</th>
			<td><?php echo PHP_OS;?></td>
		</tr>
		<tr>
			<th>Apache Version</th>
			<td><?php echo apache_get_version();?></td>
		</tr>
		<tr>
			<th>PHP Version</th>
			<td><?php echo PHP_VERSION;?></td>
		</tr>
		<tr>
			<th>Operating Method</th>
			<td><?php echo PHP_SAPI;?></td>
		</tr>
	</table>
	<h3>Software Info</h3>
	<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
		<tr>
			<th>System Name</th>
			<td>eShop</td>
		</tr>
		<tr>
			<th>Developer</th>
			<td>Dewei && King</td>
		</tr>
	</table>
</center>

</body>
</html>