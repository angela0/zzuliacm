<?php
    if($IS_IE==1)
    echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'
?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Problems</title>
	<link rel=stylesheet href='./template/<?php echo $OJ_TEMPLATE?>/<?php echo isset($OJ_CSS)?$OJ_CSS:"hoj.css" ?>' type='text/css'>
</head>
<body>
<div id="wrapper">
	<?php require_once("oj-header.php");?>
<div id=main>
<script type="text/javascript" src="include/jquery-latest.js"></script> 
<script type="text/javascript" src="include/jquery.tablesorter.js"></script> 
<script type="text/javascript">
$(document).ready(function(){ 
        $("#problemset").tablesorter(); 
    } 
); 
</script>

<div style="width: 90%; margin-left: auto; margin-right: auto">
		<div class="problem">
        <?php
		for ($i=1;$i<=$view_total_page;$i++){
			if ($i==$page) echo "<div class='item_active'><span>$i</span></div>";
			else echo "<a href='problemset.php?page=".$i."'><div class='list_item'>".$i."</div></a>";
		} ?>
        </div>
        <div style='float: right; margin-right: 8px; margin-top: 14px'>
		<form  style="display: inline-block;" action=problem.php>
		<?php if($IS_IE==1) echo "Problem ID";?>
			<input class='form-control' placeholder='Problem ID' type='text' name='id' size=12><input style="margin-left: 2px" class="btn btm-default" type='submit' value='GO' >
		</form>
		<form style="display: inline-block;">
		<?php if($IS_IE==1) echo "Search";?>
			<input class='form-control' placeholder='Search' type='text' name='search'><input style="margin-left: 2px" class="btn btm-default" type='submit' value='<?php echo $MSG_SEARCH?>'>
		</form>
	</div>
</div>
	<table id='problemset' width='90%' align=center>
		<thead>
			<tr align='center' class='evenrow'><td width='5'></td>
			<td width='10%' colspan='1'>
				
			</td>
			<td width='90%' colspan='4'>
				
			</td></tr>
			<tr align=center class='toprow'>
				<td width='5'>
				<td style="cursor:hand" onclick="sortTable('problemset', 1, 'int');" width=10%><A><?php echo $MSG_PROBLEM_ID?></A></td>
				<td width='60%'><?php echo $MSG_TITLE?></td>
				<!--<td width='10%'><?php echo $MSG_SOURCE?></td>-->
				<td width='10%'><?php echo "Difficulty"?></td>
				<td style="cursor:hand" onclick="sortTable('problemset', 4, 'int');" width='5%'><A><?php echo $MSG_AC?></A></td>
				<td style="cursor:hand" onclick="sortTable('problemset', 5, 'int');" width='5%'><A><?php echo $MSG_SUBMIT?></A></td>
			</tr>
			</thead>
			<tbody>
			<?php 
			$cnt=0;
			foreach($view_problemset as $row){
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
<div id=foot>
	<?php require_once("oj-footer.php");?>

</div><!--end foot-->
</div><!--end main-->
</div><!--end wrapper-->
</body>
</html>
