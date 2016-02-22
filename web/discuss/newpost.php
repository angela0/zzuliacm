<?php
	require_once("oj-header.php");

	echo "<title>ZZULI Online Judge WebBoard >> New Thread</title>";
	if (!isset($_SESSION['user_id'])){
		echo "<center><a href=../loginpage.php>Please Login First</a></center>";
		echo "<center>";
		require_once("../oj-footer.php");
		echo "</center>";
		exit(0);
	}
?>

<div style="width:90%; margin-left: auto; margin-right: right">
<h2 style="margin:10px 10px">Post New Thread<?php if (array_key_exists('cid',$_REQUEST) && $_REQUEST['cid']!='') echo ' For Contest '.$_REQUEST['cid'];?></h2>
<form action="post.php?action=new" method=post>
<input type=hidden name=cid value="<?php if (array_key_exists('cid',$_REQUEST)) echo $_REQUEST['cid'];?>">
<div><input class='form-control' placeholder='Problem ID' style='margin:10px 10px; padding:10px' name=pid  value="<?php if(array_key_exists('pid',$_REQUEST)) echo $_REQUEST['pid']; ?>"></div>
<div><input class='form-control' placeholder='Title' style='margin:10px 10px; padding:10px' name=title ></div>
<div><textarea placeholder='Content' class='form-control' name=content style="width:700px; height:400px; margin:10px 10px; padding:10px"></textarea></div>
<div><input class='btn btn-default' type="submit" style="margin:5px 10px" value="Submit"></input></div>
</form>
</div>
<div id=foot>
<?php require_once("../oj-footer.php")?>
</div>

