<?php
	require_once("include/db_info.inc.php");

	$sql = "select problem_id from problem";
	
	$result = mysql_query($sql);

	while($count = mysql_fetch_object($result))
	{
		$update_sql = "UPDATE `problem` SET `accepted`=(SELECT count(*) FROM `solution` WHERE `problem_id`=$count->problem_id AND `result`='4') WHERE `problem_id`=$count->problem_id";
		if(mysql_query($update_sql))
			echo "sucess";
		else
			echo "failed";

		$update_sql = "UPDATE `problem` SET `submit`=(SELECT count(*) FROM `solution` WHERE `problem_id`=$count->problem_id) WHERE `problem_id`=$count->problem_id";
		if(mysql_query($update_sql))
			echo "yes";
		else
			echo "no";

		echo "<br />";
	}
	
//	echo $count[1];
?>
