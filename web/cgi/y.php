<?php
		require_once("include/db_info.inc.php");

		$fp = fopen("b.txt", 'r');

		while(($buff = fgets($fp)) != false)
		{
			$len = strlen($buff);
			$buff = substr($buff, 0, $len-1);
			$sql = "select nick from users where user_id='$buff'";
			$result = mysql_query($sql);
			$count2 = mysql_fetch_row($result);
			$nick = $count2[0];
			$len = strlen($nick);
			$nick = substr($count2[0], 1, $len); 
			echo $nick;
			$sql2 = "update users set nick='$nick' where user_id='$buff'";
			$result = mysql_query($sql2);
			echo $result;
			$c++;
		}
		echo $c;
		fclose($fp);

/*		$user_id = 'exam1410';
		$sql2 = "select nick from users where user_id='$user_id'";
		$result2 = mysql_query($sql2);
		$count2 = mysql_fetch_row($result2);
		$nick = $count2[0];
		echo $nick;
/*
	echo "<title>this is what?</title>";
/*
	$sql = "select count(distinct user_id) from solution where contest_id=1083";

	$result = mysql_query($sql);

	$count = mysql_fetch_row($result);
//	echo $count[0];

	$sql = "select distinct user_id from solution where contest_id=1084";

	$result = mysql_query($sql);

	$users = ARRAY();	
	$c = 0;
	while($re =  mysql_fetch_row($result))
	{
//		echo $re[0];
		//$sql = 	
		$users[$c] = $re[0];
		$c++;
	}

	foreach($users as $v)
	{
		$sql = "select nick from users where user_id='$v'";
		$result = mysql_query($sql);
		$re = mysql_fetch_row($result);	
		$nick = $re[0];
//		echo $nick;
		$sql = "select ";
	}

echo "happy";
/*
	while($re = mysql_fetch_array($result)){
		$user_id = $re->user_id;
		$problem_id = $re->problem_id;
		$ac = $re->result;
		$source = $re->source;

		echo $user_id."<br/>";
		echo $problem_id."<br/>";
		echo $ac."<br/>";
		echo $source."<br/>";
	}
*/
?>
