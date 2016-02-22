<?php                
     $cid=intval($_GET['cid']);
                        $view_cid=$cid;
                //      print $cid;

                        // check contest valid
                        $sql="SELECT * FROM `contest` WHERE `contest_id`='$cid' ";
                        $result=mysql_query($sql);
                        $rows_cnt=mysql_num_rows($result);
                        $contest_ok=true;


                        if ($rows_cnt==0){
                                mysql_free_result($result);
                                $view_title= "No Such Contest!";

                        }else{
                                $row=mysql_fetch_object($result);
                                $view_private=$row->private;
                                if ($row->private && !isset($_SESSION['c'.$cid])) $contest_ok=false;
                                if ($row->defunct=='Y') $contest_ok=false;
                                if (isset($_SESSION['administrator'])) $contest_ok=true;

                                $now=time();
                                $start_time=strtotime($row->start_time);
                                $end_time=strtotime($row->end_time);
                                $view_description=$row->description;
                                $view_title= $row->title;
                                $view_start_time=$row->start_time;
                                $view_end_time=$row->end_time;


 if (!isset($_SESSION['administrator']) && $now<$start_time){
                                        $view_errors=  "<h2>Private Contest is used as Exam, problem can't view after finished.</h2>";
                                        require("template/".$OJ_TEMPLATE."/error.php");
                                        exit(0);
                                }
                        }
                        if (!$contest_ok){
                                $view_errors=  "<h2>Not invited or not login!</h2>";
                                require("template/".$OJ_TEMPLATE."/error.php");
                                exit(0);
                        }
                        $sql="select * from (SELECT `problem`.`title` as `title`,`problem`.`problem_id` as `pid`,source as source

                FROM `contest_problem`,`problem`

                WHERE `contest_problem`.`problem_id`=`problem`.`problem_id` AND `problem`.`defunct`='N'

                AND `contest_problem`.`contest_id`=$cid ORDER BY `contest_problem`.`num`
                ) problem
                left join (select problem_id pid,count(1) accepted from solution where result=4 and contest_id=$cid group by pid) p1 on problem.pid=p1.pid
                left join (select problem_id pid2,count(1) submit from solution where contest_id=$cid  group by pid2) p2 on problem.pid=p2.pid2

                ";
  $result=mysql_query($sql);
                        $view_problemset=Array();

                        $cnt=0;
                        while ($row=mysql_fetch_object($result)){

                                $view_problemset[$cnt][0]="";
                                if (isset($_SESSION['user_id']))
                                        $view_problemset[$cnt][0]=check_ac($cid,$cnt);
                                $view_problemset[$cnt][1]= "$row->pid Problem &nbsp;".(chr($cnt+ord('A')));
                                $view_problemset[$cnt][2]= "<a href='problem.php?cid=$cid&pid=$cnt'>$row->title</a>";
                                $view_problemset[$cnt][3]=$row->source ;
                                $view_problemset[$cnt][4]=$row->accepted ;
                                $view_problemset[$cnt][5]=$row->submit ;
                                $cnt++;
                        }

                        mysql_free_result($result);
?>



<div align=center>
	<h3>Contest<?php echo $view_cid?> - <?php echo $view_title ?></h3>

	<p><?php echo $view_description?></p>
	<br>Start Time: <font color=#993399><?php echo $view_start_time?></font>
	End Time: <font color=#993399><?php echo $view_end_time?></font><br>
	Current Time: <font color=#993399><span id=nowdate > <?php echo date("Y-m-d H:i:s")?></span></font>
	Status:<?php
	if ($now>$end_time) 
	echo "<span class=red>Ended</span>";
	else if ($now<$start_time) 
	echo "<span class=red>Not Started</span>";
	else 
	echo "<span class=red>Running</span>";
	?>&nbsp;&nbsp;
	<?php
	if ($view_private=='0') 
	echo "<span class=blue>Public</font>";
	else 
	echo "&nbsp;&nbsp;<span class=red>Private</font>"; 
	?>
	<br/>
	<br/>
	<a class="btn <?php if(strstr($url, 'contest.php')) echo 'btn-selected'; else echo 'btn-default'; ?>" href='contest.php?cid=<?php echo $view_cid?>'>Problem</a>
	<a class='btn <?php if(strstr($url, 'conteststatus.php')) echo 'btn-selected'; else echo 'btn-default'; ?>' href='conteststatus.php?cid=<?php echo $view_cid?>'>Status</a>
	<a class='btn <?php if(strstr($url, 'contestrank.php')) echo 'btn-selected'; else echo 'btn-default'; ?>' href='contestrank.php?cid=<?php echo $view_cid?>'>Standing</a>
	<a class='btn <?php if(strstr($url, 'conteststatistics.php')) echo 'btn-selected'; else echo 'btn-default'; ?>' href='conteststatistics.php?cid=<?php echo $view_cid?>'>Statistics</a>
	<a class='btn btn-default' href='discuss/discuss.php?cid=<?php echo $view_cid?>'>Clarification</a>
	<br/>
	<br/>
</div>

<script>
var diff=new Date("<?php echo date("Y/m/d H:i:s")?>").getTime()-new Date().getTime();
//alert(diff);
function clock()
    {
      var x,h,m,s,n,xingqi,y,mon,d;
      var x = new Date(new Date().getTime()+diff);
      y = x.getYear()+1900;
      if (y>3000) y-=1900;
      mon = x.getMonth()+1;
      d = x.getDate();
      xingqi = x.getDay();
      h=x.getHours();
      m=x.getMinutes();
      s=x.getSeconds();

      n=y+"-"+mon+"-"+d+" "+(h>=10?h:"0"+h)+":"+(m>=10?m:"0"+m)+":"+(s>=10?s:"0"+s);
      //alert(n);
      document.getElementById('nowdate').innerHTML=n;
      setTimeout("clock()",1000);
    }
    clock();
</script>

