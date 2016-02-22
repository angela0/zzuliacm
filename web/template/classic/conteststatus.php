<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv='refresh' content='60'>
	<title>Contest | Status</title>
	<link rel=stylesheet href='./template/<?php echo $OJ_TEMPLATE?>/<?php echo isset($OJ_CSS)?$OJ_CSS:"hoj.css" ?>' type='text/css'>
</head>
<body>
<div id="wrapper">
<?php require('oj-header.php');?>
<div id=main>
<div id=center>
<?php require_once('contest-header.php');?>
<form id=simform action="status.php" method="get">
<input class='form-control' type=text placeholder="Problem ID" size=10 name=problem_id value='<?php echo $problem_id?>'>
<input class="form-control" type=text placeholder="User" size=11 name=user_id value='<?php echo $user_id?>'>
<?php if (isset($cid)) echo "<input type='hidden' name='cid' value='$cid'>";?>
<select class="form-control" size="1" name="language">
<?php if (isset($_GET['language'])) $language=$_GET['language'];
else $language=-1;
if ($language<0||$language>9) $language=-1;
if ($language==-1) echo "<option value='-1' selected>All</option>";
else echo "<option value='-1'>All</option>";
for ($i=0;$i<10;$i++){
        if ($i==$language) echo "<option value=$i selected>$language_name[$i]</option>";
        else echo "<option value=$i>$language_name[$i]</option>";
}
?>
</select>
<select class="form-control" size="1" name="jresult">
<?php if (isset($_GET['jresult'])) $jresult_get=intval($_GET['jresult']);
else $jresult_get=-1;
if ($jresult_get>=12||$jresult_get<0) $jresult_get=-1;
if ($jresult_get!=-1){
        $sql=$sql."AND `result`='".strval($jresult_get)."' ";
        $str2=$str2."&jresult=".strval($jresult_get);
}
if ($jresult_get==-1) echo "<option value='-1' selected>All</option>";
else echo "<option value='-1'>All</option>";
for ($j=0;$j<12;$j++){
        $i=($j+4)%12;
        if ($i==$jresult_get) echo "<option value='".strval($jresult_get)."' selected>".$judge_result[$i]."</option>";
        else echo "<option value='".strval($i)."'>".$judge_result[$i]."</option>"; 
}
echo "</select>";
?>
</select>

<?php 
	echo "<input class='btn btn-default' type=submit value='$MSG_SEARCH'></form>";
?>
</div>

<div id=center>
<table id=result-tab class=content-box-header align=center width=80%>
<tr  class='toprow'>
<td ><?php echo $MSG_RUNID?>
<td ><?php echo "Nick"?>
<td ><?php echo $MSG_PROBLEM?>
<td ><?php echo $MSG_RESULT?>
<td ><?php echo $MSG_MEMORY?>
<td ><?php echo $MSG_TIME?>
<td ><?php echo $MSG_LANG?>
<td ><?php echo $MSG_CODE_LENGTH?>
<td ><?php echo $MSG_SUBMIT_TIME?>
</tr>


<tbody>
			<?php 
			$cnt=0;
			foreach($view_status as $row){
				if ($cnt) 
					echo "<tr class='oddrow'>";
				else
					echo "<tr class='evenrow'>";
				foreach($row as $table_cell){
					echo "<td>";
					echo "\t".$table_cell;
					echo "</td>";
				}
				
				echo "</tr>";
				
				$cnt=1-$cnt;
			}
			?>
			</tbody>
</table>

</div>
<div id=page_button align=center>
<?php 
//	echo "<div class='btn btn-default'><a href=status.php?".$str2."top=".($top+20).">Previous Page</a></div>";
//	echo "<div class='btn btn-default'><a href=status.php?".$str2."&top=".$bottom."&prevtop=$top>Next Page</a></div>";

echo "<a href=status.php?".$str2."top=".($top+20)."><div class='btn btn-default'> Previous Page</div></a>";
echo "<a href=status.php?".$str2."&top=".$bottom."&prevtop=$top><div class='btn btn-default'> Next Page</div></a>";

?>
<?php 
/*
if (isset($_GET['prevtop']))
    echo "<div class='btn btn-default'><a".">Previous Page</a></div>";
else 
	echo "<div class='btn btn-default'><a href=status.php?".$str2."&top=".($top+20).">Previous Page</a></div>";
echo "<div class='btn btn-default'><a href=status.php?".$str2."&top=".$bottom."&prevtop=$top>Next Page</a></div>";
*/
?>
</div>



<div id=foot>
	<?php require_once("oj-footer.php");?>

</div><!--end foot-->
</div><!--end main-->
</div><!--end wrapper-->
<script type="text/javascript">
  var i=0;
  var judge_result=[<?php
  foreach($judge_result as $result){
    echo "'$result',";
  }
?>''];
//alert(judge_result[0]);
function findRow(solution_id){
    var tb=window.document.getElementById('result-tab');
     var rows=tb.rows;

      for(var i=1;i<rows.length;i++){
                var cell=rows[i].cells[0];
//              alert(cell.innerHTML+solution_id);
        if(cell.innerHTML==solution_id) return rows[i];
      }
}

function fresh_result(solution_id)
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
     var tb=window.document.getElementById('result-tab');
     var row=findRow(solution_id);
     //alert(row);
     var r=xmlhttp.responseText;
     var ra=r.split(",");
//     alert(r);
//     alert(judge_result[r]);
      var loader="<img width=18 src=image/loader.gif>";
     row.cells[3].innerHTML=judge_result[ra[0]]+loader;
     row.cells[4].innerHTML=ra[1];
     row.cells[5].innerHTML=ra[2];
     if(ra[0]<4)
        window.setTimeout("fresh_result("+solution_id+")",2000);
     else
        window.location.reload();

    }
  }
xmlhttp.open("GET","status-ajax.php?solution_id="+solution_id,true);
xmlhttp.send();
}
<?php if ($last>0&&$_SESSION['user_id']==$_GET['user_id']) echo "fresh_result($last);";?>
</script>

</body>
</html>
