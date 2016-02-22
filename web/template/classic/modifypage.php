<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title><?php echo $view_title?></title>
	<link rel=stylesheet href='./template/<?php echo $OJ_TEMPLATE?>/<?php echo isset($OJ_CSS)?$OJ_CSS:"hoj.css" ?>' type='text/css'>
</head>
<body>
<div id="wrapper">
	<?php require_once("oj-header.php");?>
<div id=main>
	<h1 align=center>Update Information</h1>
	<form action="modify.php" method="post">
	<br><br>
	<center><table>
		<tr><td width=25% style="text-align: right">User ID</td><td width=75%><?php echo $_SESSION['user_id']?>
			<?php require_once('./include/set_post_key.php');?>
		</tr>
		<tr><td style="text-align: right">Nick Name </td><td><input class='form-control' name="nick" size=30 type=text value="<?php echo htmlspecialchars($row->nick)?>" >
		</tr>
		<tr><td style="text-align: right">Old Password <td><input class='form-control' name="opassword" size=30 type=password>
		</tr>
		<tr><td style="text-align: right">New Password <td><input class='form-control' name="npassword" size=30 type=password>
		</tr>
		<tr><td style="text-align: right">Repeat <td><input class='form-control' name="rptpassword" size=30 type=password>
		</tr>
		<tr><td style="text-align: right">School <td><input class='form-control' name="school" size=30 type=text value="<?php echo htmlspecialchars($row->school)?>" >
		</tr>
		<tr><td style="text-align: right">Email	<td><input class='form-control' name="email" size=30 type=text value="<?php echo htmlspecialchars($row->email)?>" >
		</tr>
		<tr><td></td>
			<td><input class='btn btn-default' value="Submit" name="submit" type="submit">   
				<input class='btn btn-default' style='margin-left: 150px' value="Reset" name="reset" type="reset">
		</tr>
	</table></center>
	<!--
	<br>
	<a href=export_ac_code.php>Download All AC Source</a>
	<br>-->
<div id=foot>
	<?php require_once("oj-footer.php");?>
</div><!--end foot-->
</div><!--end main-->
</div><!--end wrapper-->
</body>
</html>
