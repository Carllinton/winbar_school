<?php
session_start();
include('../includes/conn.php');
?>
<html>
	<head>
	<SCRIPT LANGUAGE="JavaScript"> 
if (window.print) {
document.write('<form><input type=button name=print value="Print" onClick="window.print()"></form>');
}
</script>
	</head>
	
	<body>
		
		<div align='center'><img width='200' height='150' src='logo.jpg'></div><div align='center' style='margin-top:20px;'>DE OCAMPO MEMORIAL MEDICAL CENTER<br>2921 Nagtahan St. Sta. Mesa Manila</div></div><br>
		<div align='center'>Student Listing:</div><br>
		<div align='center' width='600px' style='margin-top:30px;'>
		<table border="2" align='center' width='1000'>
		<tr>
				<td width="100" align="center"><b>Student Num</b></td>
             	<td width="200" align="center"><b>Student Name</b></td>
				<td width="100" align="center"><b>Shift</b></td>
             	<td width="300" align="center"><b>Rest Days</b></td>
				
			
          </tr>
              <tbody>
			  <?php
			
				$queryrequest=$conn->query("SELECT * FROM studenttbl");
				while($rowshift=mysqli_fetch_array($queryrequest))
				{
				echo	"<tr>";
				echo	"<td>$rowshift[studnum]</td>";
				echo	"<td>$rowshift[fname] $rowshift[minitial]. $rowshift[lname]</td>";
				echo	"<td>$rowshift[course]</td>";
				
				$querygetoffs=$conn->query("SELECT * FROM sched_tbl WHERE studnum='$rowshift[studnum]' AND status='1' LIMIT 1");
				$getoff=mysqli_fetch_array($querygetoffs);
				if(mysqli_num_rows($querygetoffs)==0)
				{
					echo	"<td>No Assigned Schedules Yet</td>";
					echo	"</tr>";
				}
				else
				{
					echo	"<td>$getoff[dayoff1], $getoff[dayoff2], $getoff[dayoff3]<br>
								 $getoff[dayoff4], $getoff[dayoff5], $getoff[dayoff6]<br>
								 $getoff[dayoff7]</td>";
					echo	"</tr>";
				}
				}
			  ?>
			</tbody>
			</table>
		</div>
		<div align='center' style='margin-top:500px;' >
		<form>
			<input type='button' onclick='window.print()'>
		</form>
		</div>
	</body>

</html>