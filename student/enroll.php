<?php
	session_start();
	
	$getID=$_SESSION['userID'];
	include('includes/conn.php');
	include('logcheck.php');
	
	
	$getprofile=mysql_query("SELECT * FROM studenttbl WHERE accountID = '$getID'");
	$rows=mysql_fetch_array($getprofile);
	
	$getacc=mysql_query("SELECT * FROM usertbl WHERE ID = '$getID'");
	$rowacc=mysql_fetch_array($getacc);
	
		$username=$rowacc['username'];
		$password=$rowacc['password'];
		
		$course=$rows['course'];
		$yrlvlsec=$rows['yearlvl'];
		$snum=$rows['studnum'];
		
		$fname=$rows['fname'];
		$minitial=$rows['minitial'];
		$lname=$rows['lname'];
		$fullname= $fname." ".$minitial." ".$lname;
		
		$_SESSION['studnum']=$rows['studnum'];
		
		
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>John Paul College</title>


<link href = "style.css" rel = "stylesheet" type = "text/css"/>

</head>

<body>

<div class='header'>
</div>
	<div align='left'>
<nav class='container'>
<?php
include('includes/menu.php');
?>
</nav>
</div>




<div id="main">
	<div class="shell">
	<center>
	<form class='cmxform' method='POST' action='showsubs.php'>
	
	
	<fieldset>
			<legend>Student Details</legend>
			  <ol>
			  <li>
				  <label for="name"><b>Year Level:</b>  <?php echo $yrlvlsec; ?> ||</label>
				  <label for="name"><b>Course:</b>  <?php echo $course; ?></label>
				  <label for="name"><b>Sem:</b></label><select name='sem'><option value='1st Sem'>1st</option><option value='2nd Sem'>2nd</option></select>
				  
				</li>
				
  </ol>
			<div><br></div>
	</fieldset>
	<fieldset>	
			  <legend>List of Subjects</legend>
			  <ol>
			  <li>
					<table border='1'>
						<thead>
							<th>Subject Code</th>
							<th>Subject Title</th>
							<th>Description</th>
							<th>Number of Units</th>
							<th>Select</th>
						</thead>
						<tbody>
							<?php
								$getsubjects=mysql_query("SELECT * FROM subjecttbl");
								while($fetchsub=mysql_fetch_array($getsubjects))
								{
									echo"<tr>";
										echo"<td width='120' align='center'>$fetchsub[subjectcode]</td>";
										echo"<td width='120' align='center'>$fetchsub[subjecttitle]</td>";
										echo"<td width='120' align='center'>$fetchsub[description]</td>";
										echo"<td width='120' align='center'>$fetchsub[numofunits]</td>";
										echo"<td  width='120' align='center'><input type='checkbox' name='subject[]' value='$fetchsub[subjectcode]'></td>";
									echo"</tr>";
								}
								
							
							?>
						</tbody>
					</table>
					<div>  <br></div>
	 </fieldset>
				

<div align='center'><input type='submit' name='register' value='Enroll Selected'>&nbsp;&nbsp;
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
