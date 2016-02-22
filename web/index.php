<?php
////////////////////////////Common head
	$cache_time=10;
	$OJ_CACHE_SHARE=false;
	require_once('./include/cache_start.php');
   	require_once('./include/db_info.inc.php');
	require_once('./include/setlang.php');
	$view_title= "Welcome To Online Judge";
	
///////////////////////////MAIN	
	
	$view_news="";
	$sql=	"SELECT * "
			."FROM `news` "
			."WHERE `defunct`!='Y'"
			."ORDER BY `importance` ASC,`news_id` DESC "
			."LIMIT 5";
	$result=mysql_query($sql);//mysql_escape_string($sql));
	if (!$result){
		$view_news= "<h3>No News Now!</h3>";
		$view_news.= mysql_error();
	}else{
		$view_news.= "<center><div id=news>";
		$i = 0;
		while ($row=mysql_fetch_object($result)){
			if($i!=0) $view_news.= "<hr/>";
			//$view_news.= "<div style='text-align: center; margin: 5px 10px'><big><b>".$row->title."  [ ".$row->time."]</b></big></div>";
			$view_news.= "<div style='text-align: center; margin: 5px 10px'><big><b>".$row->title."</b></big></div>";
			$view_news.= "<div style='margin: 10px 10px'>".$row->content."</div>";
			$i+=1;
		}
		mysql_free_result($result);
		$view_news.= "</div></center>";
	}
	$view_apc_info="";

	$cache_file = "cache_file.txt";
	$expire = 86400;

	if(file_exists($cache_file) && filemtime($cache_file) > (time()-$expire))
	{
		$record = unserialize(file_get_contents($cache_file));
		$chart_data_all = $record[0];
		$chart_data_ac = $record[1];
	}
	else
	{
	$record = array();

	$sql="SELECT UNIX_TIMESTAMP(date(in_date))*1000 md,count(1) c FROM `solution`  where to_days(now())-to_days(in_date)<120 group by md order by md desc ";
	$result=mysql_query($sql);//mysql_escape_string($sql));
	$chart_data_all= array();
	//echo $sql;
    
	while ($row=mysql_fetch_array($result)){
		$chart_data_all[$row['md']]=$row['c'];
    }
	$record[] = $chart_data_all;

	$sql="SELECT UNIX_TIMESTAMP(date(in_date))*1000 md,count(1) c FROM `solution` where result=4 and to_days(now())-to_days(in_date)<120 group by md order by md desc ";
	$result=mysql_query($sql);//mysql_escape_string($sql));
	$chart_data_ac= array();
	//echo $sql;
    
	while ($row=mysql_fetch_array($result)){
		$chart_data_ac[$row['md']]=$row['c'];
	}
	$record[] = $chart_data_ac;
	$output = serialize($record);
	$fp = fopen($cache_file, "w");
	fputs($fp, $output);
	fclose($fp);
	
	}




	if(function_exists('apc_cache_info')){
		$_apc_cache_info = apc_cache_info(); 
		$view_apc_info =_apc_cache_info;
	}

/////////////////////////Template
require("template/".$OJ_TEMPLATE."/index.php");
/////////////////////////Common foot
if(file_exists('./include/cache_end.php'))
	require_once('./include/cache_end.php');
?>
