<?php
	if($IS_IE==1)
                echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'
?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Problem</title>
	<link rel=stylesheet href='./template/<?php echo $OJ_TEMPLATE?>/<?php echo isset($OJ_CSS)?$OJ_CSS:"hoj.css" ?>' type='text/css'>
</head>
<body>
<div id="wrapper">
	<?php
		require_once("oj-header.php");

		if(isset($_GET['cid'])) { 
			$sql="SELECT `title` FROM `contest` WHERE `contest_id`='$cid'";
			$result=mysql_query($sql);
			$myrow=mysql_fetch_array($result);
			$title = $myrow[0];
			$putout = "<center><h1>Contest - <a href='contest.php?cid=$cid'>$title</a></h1></center>";
			echo $putout;
		}
	?>
		
<div id=main>
	<div id=problem_page>
	<?php
	
	if ($pr_flag){
		echo "<title>$MSG_PROBLEM $row->problem_id. -- $row->title</title>";
		echo "<center><h2>$id: $row->title</h2>";
	}else{
		$PID="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		echo "<title>$MSG_PROBLEM $PID[$pid]: $row->title </title>";
		echo "<center><h2>$MSG_PROBLEM $PID[$pid]: $row->title</h2>";
	}
	echo "<span class=green>$MSG_Time_Limit: </span>$row->time_limit Sec&nbsp;&nbsp;";
	echo "<span class=green>$MSG_Memory_Limit: </span>".$row->memory_limit." MB";
	if ($row->spj) echo "&nbsp;&nbsp;<span class=red>Special Judge</span>";
	echo "<br><span class=green>$MSG_SUBMIT: </span>".$row->submit."&nbsp;&nbsp;";
	echo "<span class=green>$MSG_SOVLED: </span>".$row->accepted."<br>"; 
	
	echo "<br/>";
	if ($pr_flag){
		echo "<a href='submitpage.php?id=$id' class='btn btn-default'>$MSG_SUBMIT</a>";
	}else{
		echo "<a href='submitpage.php?cid=$cid&pid=$pid&langmask=$langmask' class='btn btn-default'>$MSG_SUBMIT</a>";
	}
	echo "<a href='problemstatus.php?id=".$row->problem_id."' class='btn btn-default'>$MSG_STATUS</a>";
	echo "<a href='bbs.php?pid=".$row->problem_id."$ucid' class='btn btn-default'>$MSG_BBS</a>";
	if (isset($_SESSION['administrator'])||isset($_SESSION['contest_creator'])||isset($_SESSION['problem_editor'])){
	    require_once("include/set_get_key.php");
		$key = $_SESSION['getkey'];
		echo "<a href='http://acm.zzuli.edu.cn/admin/problem_edit.php?id=".$row->problem_id."&getkey=".$key."' class='btn btn-default'>Edit</a>";
	}
	echo "</center>";
	
	echo "<h2>$MSG_Description</h2><div class=content>".$row->description."</div>";
	echo "<h2>$MSG_Input</h2><div class=content>".$row->input."</div>";
	echo "<h2>$MSG_Output</h2><div class=content>".$row->output."</div>";
	
	$ie6s="";
	$ie6e="";
	if(strpos($_SERVER['HTTP_USER_AGENT'],'MSIE'))
	{
		$ie6s="<pre>";
		$ie6e="</pre>";
	}
	$sinput=str_replace("<","&lt;",$row->sample_input);
  $sinput=str_replace(">","&gt;",$sinput);
	$soutput=str_replace("<","&lt;",$row->sample_output);
  $soutput=str_replace(">","&gt;",$soutput);
	echo "<h2>$MSG_Sample_Input</h2>
			<div class='content pre'><span class=sampledata>".$ie6s.($sinput).$ie6e."</span></div>";
	echo "<h2>$MSG_Sample_Output</h2>
			<div class='content pre'><span class=sampledata>".$ie6s.($soutput).$ie6e."</span></div>";
	if ($pr_flag||true) 
		echo "<h2>$MSG_HINT</h2>
			<div class=content><p>".nl2br($row->hint)."</p></div>";
	if ($pr_flag) 
		echo "<h2>$MSG_Source</h2>
			<div class=content><p><a href='problemset.php?search=$row->source'>".nl2br($row->source)."</a></p></div>";
	
	echo "<center>";
	if ($pr_flag){
		echo "<a href='submitpage.php?id=$id' class='btn btn-default'>$MSG_SUBMIT</a>";
	}else{
		echo "<a href='submitpage.php?cid=$cid&pid=$pid&langmask=$langmask' class='btn btn-default'>$MSG_SUBMIT</a>";
	}
	echo "<a href='problemstatus.php?id=".$row->problem_id."' class='btn btn-default'>$MSG_STATUS</a>";
	echo "<a href='bbs.php?pid=".$row->problem_id."$ucid' class='btn btn-default'>$MSG_BBS</a>";
	echo "</center>";
	
	
	?>
	</div>
	
<div id=foot>
	<?php require_once("oj-footer.php");?>
</div><!--end foot-->
</div><!--end main-->
</div><!--end wrapper-->
</body>
</html>
