<?php
////////////////////////////Common head
	$cache_time=1200;
	$OJ_CACHE_SHARE=true;
	require('./include/cache_start.php');
    require('./include/db_info.inc.php');
//	require_once('./include/setlang.php');
	$view_title= "Recent Contests from Naikai-contest-spider";

    $json = @file_get_contents('http://contests.acmicpc.info/contests.json');
   
	$rows = json_decode($json, true);

/////////////////////////Template
require("template/".$OJ_TEMPLATE."/recent-contest.php");
/////////////////////////Common foot
if(file_exists('./include/cache_end.php'))
	require('./include/cache_end.php');
?>



