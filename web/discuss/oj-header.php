<?php 
	require('../include/db_info.inc.php');
	$url=basename($_SERVER['REQUEST_URI']);
	$OJ_FAQ_LINK="faqs.php";
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel=stylesheet href='../template/<?php echo $OJ_TEMPLATE?>/<?php echo isset($OJ_CSS)?$OJ_CSS:"hoj.css" ?>' type='text/css'>
	<?php function checkcontest($MSG_CONTEST){
		require_once("../include/db_info.inc.php");
		$sql="SELECT count(*) FROM `contest` WHERE `end_time`>NOW() AND `defunct`='N'";
		$result=mysql_query($sql);
		$row=mysql_fetch_row($result);
		if (intval($row[0])==0) $retmsg=$MSG_CONTEST;
		else $retmsg=$row[0]."<font color=red>&nbsp;$MSG_CONTEST</font>";
		mysql_free_result($result);
		return $retmsg;
	}
	function checkmail(){
		require_once("../include/db_info.inc.php");
		$sql="SELECT count(1) FROM `mail` WHERE 
				new_mail=1 AND `to_user`='".$_SESSION['user_id']."'";
		$result=mysql_query($sql);
		if(!$result) return false;
		$row=mysql_fetch_row($result);
		$retmsg="<font color=red>(".$row[0].")</font>";
		mysql_free_result($result);
		return $retmsg;
	}
	
	if(isset($OJ_LANG)){
		require_once("../lang/$OJ_LANG.php");
		if(file_exists("../faqs.$OJ_LANG.php")){
			$OJ_FAQ_LINK="../faqs.$OJ_LANG.php";
		}
	}else{
		require_once("../lang/en.php");
	}
	

	if($OJ_ONLINE){
		require_once('../include/online.php');
		$on = new online();
	}
?>
</head>
<body>
<div id="wrapper">
	  <div id=menu>
		<div style="margin-left: 5.5%" class=menu_item>
			<a href="/">ZZULIOJ</a>
		</div>
		<div class=menu_item>
		<a href="<?php echo $OJ_HOME?>"><?php if ($url=="JudgeOnline") echo "<span class='menu_item_selected'>";?>
		<?php if ($url=="JudgeOnline") echo "</span>";?>
		</a>
		</div>
	    <div class=menu_item >
		<a href="<?php echo $OJ_HOME?>"><?php if ($url=="JudgeOnline") echo "<span class='menu_item_selected'>";?>
		<?php echo $MSG_HOME?>
		<?php if ($url=="JudgeOnline") echo "</span>";?>
		</a>
		</div>
		<div class=menu_item >
		<a href="../bbs.php"><?php if ($url==$OJ_BBS.".php") echo "<span class='menu_item_selected'>";?>
		<?php echo "Discuss"?><?php if ($url==$OJ_BBS.".php") echo "</span>";?></a>
		</div>
		<div class=menu_item >
		<a href="../problemset.php"><?php if ($url=="problemset.php") echo "<span class='menu_item_selected'>";?>
		<?php echo "Problem"?><?php if ($url=="problemset.php") echo "</span>";?></a>
		</div>
		<div class=menu_item >
		<a href="../status.php"><?php if ($url=="status.php") echo "<span class='menu_item_selected'>";?>
		<?php echo "Status"?><?php if ($url=="status.php") echo "</span>";?></a>
		</div>
		<div class=menu_item >
		<a href="../ranklist.php"><?php if ($url=="ranklist.php") echo "<span class='menu_item_selected'>";?>
		<?php echo "Rank"?><?php if ($url=="ranklist.php") echo "</span>";?></a>
		</div>
		<div class=menu_item >
		<a href="../contest.php"><?php if ($url=="contest.php") echo "<span class='menu_item_selected'>";?>
		<?php echo checkcontest($MSG_CONTEST)?><?php if ($url=="contest.php") echo "</span>";?></a>
		</div>
        <div class=menu_item >
		<a href="../recent-contest.php"><?php if ($url=="recent-contest.php") echo "<span class='menu_item_selected'>";?>
		<?php echo $MSG_RECENT_CONTEST?><?php if ($url=="recent-contest.php") echo "</span>";?></a>
		</div>
		<div class=menu_item ><?php if ($url==isset($OJ_FAQ_LINK)?$OJ_FAQ_LINK:"faqs.php") echo "<span class='menu_item_selected'>";?>
		<a href="<?php echo isset($OJ_FAQ_LINK)?$OJ_FAQ_LINK:"../faqs.php"?>"><?php echo "F.A.Q"?><?php if ($url==isset($OJ_FAQ_LINK)?$OJ_FAQ_LINK:"faqs.php") echo "</span>";?></a>
		</div>

				<?php if(isset($OJ_DICT)&&$OJ_DICT&&$OJ_LANG=="cn"){?>
					  <div class=menu_item >
							  <span style="color:1a5cc8" id="dict_status"></span>
					  </div>
					  <script src="include/underlineTranslation.js" type="text/javascript"></script>
					  <script type="text/javascript">dictInit();</script>
		<?php }?>
		<div class="user">
        <div>
        <script src="../include/profile.php?<?php echo rand();?>" ></script>
        </div>
        </div>

	</div><!--end menu-->


<div id=main>
