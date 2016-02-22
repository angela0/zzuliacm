
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
	<form action="register.php" method="post">
	<br><br>
	<center><table>
		<tr>
			<td style='text-align: right'width=25%></td>
			<td style='margin-left: 5px;'><?php echo "<h1>Register</h1>"?></td>
		</tr>
		<tr><td  style='text-align: right'width=25%><?php echo $MSG_USER_ID?>  </td>
			<td width=75%><input class='form-control' name="user_id" size=30 type=text> *</td>
		</tr>
		<tr><td style='text-align: right'><?php echo $MSG_NICK?>  </td>
			<td><input class='form-control' name="nick" size=30 type=text></td>
		</tr>
		<tr><td style='text-align: right'><?php echo $MSG_PASSWORD?>  </td>
			<td><input class='form-control' name="password" size=30 type=password> *</td>
		</tr>
		<tr><td style='text-align: right'><?php echo $MSG_REPEAT_PASSWORD?>  </td>
			<td><input class='form-control' name="rptpassword" size=30 type=password> *</td>
		</tr>
		<tr><td style='text-align: right'><?php echo $MSG_SCHOOL?>  </td>
			<td><input class='form-control' name="school" size=30 type=text></td>
		</tr>
		<tr><td style='text-align: right'><?php echo $MSG_EMAIL?>  </td>
			<td><input class='form-control' name="email" size=30 type=text></td>
		</tr>
		<?php if($OJ_VCODE){?>
		<tr><td style='text-align: right'><?php echo $MSG_VCODE?></td>
			<td><input class='form-control' name="vcode" size=30 type=text> *</td>
		</tr>
		<tr>
			<td style='text-align: right'></td>
			<td><img alt="click to change" src="vcode.php" onclick="this.src='vcode.php?'+Math.random()"></td>
		</tr>
		<?php }?>
		<tr><td></td>
			<td><input class='btn btn-default' value="Submit" name="submit" type="submit">
				&nbsp; &nbsp;
				<input class='btn btn-default'value="Reset" name="reset" type="reset"></td>
		</tr>
	</table></center>
	<br><br>
</form>

<div id=foot>
	<?php require_once("oj-footer.php");?>

</div><!--end foot-->
</div><!--end main-->
</div><!--end wrapper-->
</body>
</html>
