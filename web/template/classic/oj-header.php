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
		<a href="<?php echo $OJ_HOME?>"><?php if ($url=="") echo "<span class='menu_item_selected'>";?>
		<?php echo $MSG_HOME?>
		<?php if ($url=="JudgeOnline") echo "</span>";?>
		</a>
		</div>
		<div class=menu_item >
		<a href="bbs.php"><?php if ($url==$OJ_BBS.".php") echo "<span class='menu_item_selected'>";?>
		Discuss<?php if ($url==$OJ_BBS.".php") echo "</span>";?></a>
		</div>
		<div class=menu_item >
		<a href="problemset.php"><?php if (strstr($url, "problemset.php")) echo "<span class='menu_item_selected'>";?>
		<?php echo "Problem"?><?php if (strstr($url, "problemset.php")) echo "</span>";?></a>
		</div>
		<div class=menu_item >
		<a href="status.php"><?php if (strstr($url, "status.php")) echo "<span class='menu_item_selected'>";?>
		<?php echo "Status"?><?php if (strstr($url, "status.php")) echo "</span>";?></a>
		</div>
		<div class=menu_item >
		<a href="ranklist.php"><?php if (strstr($url, "ranklist.php")) echo "<span class='menu_item_selected'>";?>
		<?php echo "Rank"?><?php if (strstr($url, "ranklist.php")) echo "</span>";?></a>
		</div>
		<div class=menu_item >
		<a href="contest.php"><?php if (strstr($url, "contest.php")&& !strstr($url, "recent-contest.php")) echo "<span class='menu_item_selected'>";?>
		<?php echo checkcontest($MSG_CONTEST)?><?php if (strstr($url, "contest.php")&& !strstr($url, "recent-contest.php")) echo "</span>";?></a>
		</div>
        <div class=menu_item >
		<a href="recent-contest.php"><?php if (strstr($url, "recent-contest.php")) echo "<span class='menu_item_selected'>";?>
		<?php echo $MSG_RECENT_CONTEST?><?php if (strstr($url, "recent-contest.php")) echo "</span>";?></a>
		</div>
		<div class=menu_item >		
			<a href="<?php echo isset($OJ_FAQ_LINK)?$OJ_FAQ_LINK:"faqs.php"?>"><?php if ($url=="faqs.php") echo "<span class='menu_item_selected'>";?>
			<?php echo "F.A.Q"?><?php if ($url=="faqs.php") echo "</span>";?></a>
		</div>
<!--
		<div class=menu_item >		
			<a href="/eighth_acm.html"><span>第八界省赛榜单<sup class="menu_item_selected">new</sup></span></a>
		</div>
-->
		<div class=menu_item>
			<a href="/discuz" target="_blank"><span>Discuz</span></a>
		</div>
<!--
		<div class=menu_item >		
			<a href="<?php echo isset($OJ_FAQ_LINK)?$OJ_FAQ_LINK:"faqs.php"?>"><?php if ($url==isset($OJ_FAQ_LINK)?$OJ_FAQ_LINK:"faqs.php") echo "<span class='menu_item_selected'>";?>
			<?php echo "F.A.Q"?><?php if ($url==isset($OJ_FAQ_LINK)?$OJ_FAQ_LINK:"faqs.php") echo "</span>";?></a>
		</div>
-->

				<?php if(isset($OJ_DICT)&&$OJ_DICT&&$OJ_LANG=="cn"){?>
					  <div class=menu_item >
							  <span style="color:1a5cc8" id="dict_status"></span>
					  </div>
					  <script src="include/underlineTranslation.js" type="text/javascript"></script>
					  <script type="text/javascript">dictInit();</script>
		<?php }?>
		<div class="user">
        <div>
        <script src="include/profile.php?<?php echo rand();?>" ></script>
        </div>
        </div>

	</div><!--end menu-->
