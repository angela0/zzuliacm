<?php
/*
	$user_id = '1083';
	system("mkdir /tmp/$user_id/$user_id");
*/

		require_once("include/db_info.inc.php");
		$sql = "select nick from users where user_id='exam1410'";
		$result = mysql_query($sql);
		$re = mysql_fetch_row($result);	
		$nick = $re[0];
		echo $nick."<br/>";
		echo strlen($nick);
		$nick = str_replace("\n", "", $nick);
		echo $nick;
		echo strlen($nick);

?>
