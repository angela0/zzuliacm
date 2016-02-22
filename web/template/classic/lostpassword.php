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
		<p align=center>Please contact administrator.</p>
        <form action=lostpassword.php method=post>
        <center>
        <table width=400 algin=center>
        <tr><td width=200 style='text-align: right'><?php echo $MSG_USER_ID?>  <td width=200><input class='form-control' name="user_id" type="text" size=30></tr>
        <tr><td style='text-align: right'><?php echo $MSG_EMAIL?>  <td><input class='form-control' name="email" type="text" size=30></tr>
        <?php if($OJ_VCODE){?>
                <tr><td style='text-align: right'><?php echo $MSG_VCODE?>  </td>
                        <td><input class='form-control' name="vcode" size=30 type=text></td>
                </tr>
                <tr>
					<td style='text-align: right'></td>
					<td><img alt="click to change" src=vcode.php onclick="this.src='vcode.php?'+Math.random()"></td>
                </tr>
                <?php }?>
        <tr><td></td><td><input class="btn btn-default" name="submit" type="submit" size="10" value="Submit"></td>
</tr>
        </table>
        <center>
</form>

<div id=foot>
        <?php require_once("oj-footer.php");?>

</div><!--end foot-->
</div><!--end main-->
</div><!--end wrapper-->
</body>
</html>
