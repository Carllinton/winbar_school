<?php
session_start();
include('includes/conn.php');
include('logcheck.php');
	$stid=$_SESSION['studnum'];
				$getprofile=mysql_query("SELECT * FROM studenttbl WHERE studnum = '$stid'");
				$rows=mysql_fetch_array($getprofile);
				
if(isset($_POST['reg']))
		{
			$stid=$_SESSION['studnum'];
			$values=$_POST['contents'];
			$units=$_POST['units'];
			
				$insertenroll=mysql_query("INSERT INTO student_subject VALUES('','$stid','$values','$units','0')");
				echo"<script>window.alert('Enrollment form was successfully sent to the system')</script>";
				echo"<script>window.location='studentindex.php'</script>";
			
			
		}	
		
?>
<html>
	<head>
	<script type="text/javascript">
$('.confirm').live('click', function(){
    return confirm("Are you sure?");
});
</script>
	<SCRIPT LANGUAGE="JavaScript"> 
if (window.print) {
document.write('<form><input type=button name=print value="Print" onClick="window.print()"></form>');
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Enrollment Form</title>

	<link href = "css/style2.css" rel = "stylesheet" type = "text/css"/>
	<link rel="stylesheet" href="jquery-ui-1.10.4.custom/development-bundle/themes/base/jquery.ui.all.css">
	<script src="jquery-ui-1.10.4.custom/js/jquery-1.10.2.js"></script>
	<script src="jquery-ui-1.10.4.custom/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="jquery-ui-1.10.4.custom/development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="jquery-ui-1.10.4.custom/development-bundle/ui/jquery.ui.datepicker.js"></script>
	<link rel="stylesheet" href="jquery-ui-1.10.4.custom/development-bundle/demos/demos.css">

	
	</head>
	
	<body>
		
		<div align='center'><img width='130' height='100' src='../logo.jpg'></div><div align='center' style='margin-top: 20px; font-family: Georgia, &quot;Times New Roman&quot;, Times, serif;'>John Paul College<br>MG ANDAYA COMPOUND<br>Odiong, Roxas, Oriental Mindoro, Philippines</div></div><br>
		<div align='center' style='margin-top: 20px; font-family: Georgia, &quot;Times New Roman&quot;, Times, serif;'> UNOFFICIAL ENROLLMENT FORM 
		</div>
		<div align='center' style='margin-top: 0px; font-family: Georgia, &quot;Times New Roman&quot;, Times, serif;'> <?php echo "$_POST[sem]"; ?> School Year 2015 - 2016
		</div>
		<div align='center' width='600px' style='margin-top:30px;'><?php echo  "<b>Student Name: </b>$rows[fname] $rows[minitial] $rows[lname]|| <b>Course: </b>$rows[course]|| <b>Year Level: </b>$rows[yearlvl]" ;?>
		
		<table border="2" align='center' width='800'>
		<tr>
				<td align='left' colspan='3'><b>ENTRANCE FEE</b> </td><td colspan='3' align='right'>2,050.00</td>
		</tr>
		<tr>
				<td width="300" align="center"><b>Tuition</b></td>
				<td width="200" align="center"><b>Number of Units</b></td>
				<td width="200" align="center"><b>Per Unit</b></td>
				<td width="200" align="center"><b>Tutorial</b></td>
				<td width="200" align="center"><b>Lab</b></td>
				<td width="200" align="center"><b>Room</b></td>
				<td width="200" align="center"><b>Day</b></td>
				<td width="200" align="center"><b>Time</b></td>
				<td width="200" align="center"><b>Instructor</b></td>
				<td width="200" align="center"><b>Total</b></td>

			
          </tr>
              <tbody>
			  <?php
				
				$alltext="";
				$totalunits=0;
				$totperlab=0;
				foreach($_POST['subject'] as $item){
			
				$getcodes=mysql_query("SELECT * FROM subjecttbl WHERE subjectcode='$item'");
			
				$alltext=$alltext.",".$item;

				$subrow=mysql_fetch_array($getcodes);
				
					echo"<tr>";
						echo"<td align='center'>$subrow[subjectcode]</td>";
						echo"<td align='center'>$subrow[numofunits]</td>";
						echo"<td align='center'>296</td>";
						if($subrow['islab']==1)
						{
							
							$lab=1500;
							$lab2="1500";
							$totperlab=$totperlab+1500;
						}
						else
						{
							$lab=0;
							$lab2="";
						}
						if($subrow['istutorial']==1)
						{
							$tut=1500;
							$tut2="1500";
							$totperlab=$totperlab+1500;
						}
						else
						{
							$tut=0;
							$tut2="";
						}
							echo"<td align='center'>$tut2</td>";
							echo"<td align='center'>$lab2</td>";
							echo"<td align='center'>$subrow[room]</td>";
							echo"<td align='center'>$subrow[day]</td>";
							echo"<td align='center'>$subrow[time]</td>";
							echo"<td align='center'>$subrow[instructor]</td>";
						$totrow=$subrow['numofunits'] * 296;
						echo"<td align='right'>$totrow.00</td>";
						$totalunits=$totalunits + $subrow['numofunits'];
					echo"</tr>";
					
				
				}
				$value=($totalunits * 296) + 2050 +150+50+$totperlab;				
				echo"
						<tr>
							<td colspan='6'></td>
						</tr>
						<tr>
							<td align='left' colspan='5'><b>INTERNET</b></td><td align='right'>150.00</td>
						</tr>
						<tr>
							<td align='left' colspan='5'><b>MISC</b></td><td align='right'>50.00</td>
						</tr>
					<tr>
						<td align='left'><b>Total units</td><td colspan='4' align='left'> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>$totalunits</b></td><td align='right' bgcolor='#00EE00'><b>P&nbsp&nbsp&nbsp&nbsp$value.00</b></td>
					</tr>";
			  ?>
			</tbody>
	</table>
			<form method="POST" > 
			<div style='margin-top:20px;'><input type='submit' name='reg' value='Submit Enrollment Form' onClick="return confirm('Are you sure?, Form will be submitted to the system');"></div>
		</div>
		<div align='center' style='margin-top:500px;' >
		
			<input type='hidden' name='contents' value="<?php echo $alltext; ?>">
			<input type='hidden' name='units' value="<?php echo $totalunits; ?>">
		</form>
		<input type='button' onclick='window.print()'>
		</div>
	</body>

</html>