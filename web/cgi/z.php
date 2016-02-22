<?php
	/*
		获取比赛源代码
	*/
	require_once("include/db_info.inc.php");
	require_once("include/const.inc.php");
	
	$dir = 1084;

	system("mkdir /tmp/$dir");

	$sql="select user_id,problem_id,result,source  from source_code right join
                (select solution_id,problem_id,user_id,result from solution where contest_id=$dir ) S
                on source_code.solution_id=S.solution_id order by S.solution_id";

	//$sql = "select source from source_code where solution_id in (select solution_id from solution where contest_id=1084 order by user_id)";
	$result = mysql_query($sql);

	while($count = mysql_fetch_object($result))
	{
		$user_id = $count->user_id;
		$re =  $count->result;
		$problem_id = $count->problem_id;
		$source = $count->source;

		//echo gettype($user_id);
		system("mkdir /tmp/$dir/".$user_id);
		file_put_contents("/tmp/$dir/".$user_id."/".$problem_id, "/*********".$jresult[$re]."*********/\n".$source."\n\n", FILE_APPEND);
/*
		$sql2 = "select nick from users where user_id='$user_id'";
		$result2 = mysql_query($sql2);
		$count2 = mysql_fetch_row($result2);
		$nick = $count2[0];
		echo $nick;
*/
	}

	$sql = "select distinct user_id from solution where contest_id=$dir";

	$result = mysql_query($sql);

	$users = ARRAY();	
	$c = 0;
	while($re =  mysql_fetch_row($result))
	{
		$users[$c] = $re[0];
		$c++;
	}

	foreach($users as $v)
	{
		$sql = "select nick from users where user_id='$v'";
		$result = mysql_query($sql);
		$re = mysql_fetch_row($result);	
		$nick = $re[0];
		$nick = str_replace("\r\r\n", "", $nick);
		system("mv /tmp/$dir/$v /tmp/$dir/$nick");
	}


	echo 'done';
//	echo $count[1];
?>
