<?php
	session_start();
	include('logcheck.php');
	if(isset($_POST['register']))
	{
		include('../conn.php');
		
		$course=$_POST['course'];
		$stitle=$_POST['stitle'];
		$scode=$_POST['scode'];
		$sdescription=$_POST['cdescription'];
		$numunits=$_POST['numunits'];
		
		$sroom=$_POST['sroom'];
		$stime=$_POST['stime'];
		$sday=$_POST['sday'];
		$sinstructor=$_POST['sinstructor'];
		
		if(isset($_POST['islab']))
		{
			$islab=1;
		}
		else
		{
			$islab=0;
		}
	
		if(isset($_POST['istutorial']))
		{
			$istutorial=1;
		}
		else
		{
			$istutorial=0;
		}
		
		$insertquery=$conn->query("INSERT INTO subjecttbl VALUES ('','$scode','$stitle','$numunits','$sroom','$stime','$sday','$sinstructor',$islab,$istutorial,'$sdescription','$course')");
		
		echo"<script>window.alert('Successfully Created new Subject')</script>";
		echo"<script>window.location='addnewsubj.php'</script>";
	}
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>John Paul College</title>


<link href="../style.css" rel="stylesheet" type="text/css"/>

</head>

<body>

<div class='header'>
</div>
	
<nav class='container'>
	<?php
include('includes/menu1.php');
?>
</nav>





<div id="main">
	<div class="shell">
	<center>
	<form class='cmxform' method='POST'>
	<fieldset>
			<legend>Course Details</legend>
			  <ol>
			  <li>
				  <label for="name">Select Course:<em>*</em></label>
				  <select name='course'>
					<option value='bsit'>BSIT</option>
				  </select>
				
  </ol>
			
	</fieldset>
	
	<fieldset>	
			  <legend>Subject Details</legend>
			  <ol>
			  <li>
					<table>
						<tr>
							<td>Subject Code:</td><td align='left'><input type='text' required='required' maxlength='50' id="name" name='scode' /></td>
						</tr>
						<tr>
							<td>Subject Title:</td><td align='left'><input type='text' required='required' id="name" name='stitle' /></td>
						</tr>
						<tr>
							<td>Number of Units:</td><td align='left'><select name='numunits'>
														<option value='1'>1</option>
														<option value='2'>2</option>
														<option value='3'>3</option>
														<option value='4'>4</option>
														<option value='5'>5</option>
														<option value='6'>6</option></select></td>
						</tr>
						<tr>
							<td><label>Subject Description:</label></td><td align='left'><textarea name='cdescription'></textarea></td>
						</tr>
						<tr>
							<td><label>Room:</label></td><td align='left'><input type='text' required='required' id="name" name='sroom' /></td>
						</tr>
						<tr>
							<td><label>Day:</label></td><td align='left'><input type='text' required='required' id="name" name='sday' /></td>
						</tr>
						<tr>
							<td><label>Time:</label></td><td align='left'><input type='text' required='required' id="name" name='stime' /></td>
						</tr>
						<tr>
							<td><label>Instructor:</label></td><td align='left'><input type='text' required='required' id="name" name='sinstructor' /></td>
						</tr>
						<tr>
							<td><label>With Lab:</label></td><td align='left'><input type='checkbox' name='islab'></td>
						</tr>
						<tr>
							<td><label>With Tutorial:</label></td><td align='left'><input type='checkbox' name='istutorial'></td>
						</tr>
					</table>
					
				</li>
						
				
			 
			  
			  
  </ol>
</fieldset>
<div align='center'><input type='submit' name='register' value='Add new subject'>&nbsp;&nbsp;
<input type='reset' name='clear' value='Clear'></div>
</form>
</center>
	</div>
	<div><br></div>
</div>
<!-- /Main -->

<!-- Footer -->
<div id="footer">
	<div class="shell">
		<!-- Mini Nav --> 
		<div class="footer-navigation"> 
			<?php
include('includes/menu2.php');
?>
		</div> 
		<!-- /Mini Nav --> 
		
		<!-- Copyrights --> 
		<p class="right"> 
			Copyright 2014 | Online Enrollment
		</p> 
		<!-- /Copyrights --> 
		
		<div class="cl">&nbsp;</div> 
	</div>
</div>




</body>
</html>
