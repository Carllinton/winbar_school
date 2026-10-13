<?php
	session_start();
	include('logcheck.php');
	$getID=$_SESSION['userID'];
	include('includes/conn.php');
	
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
		
		$gender=$rows['gender'];
		$bdate=$rows['birthdate'];
		
		$address=$rows['address'];
		$cnum=$rows['contact'];
		$email=$rows['emailaddress'];
		
		
		$fathername=$rows['fathername'];
		$mothername=$rows['mothername'];
		$guardianname=$rows['guardianname'];
		
		$civilstatus=$rows['civilstatus'];
		$bplace=$rows['birthplace'];
		
		$elemschool=$rows['elemschool'];
		$yrelem=$rows['dategradelem'];
		$hsschool=$rows['hsschool'];
		$yrgradhs=$rows['datehsgrad'];
		$lastschool=$rows['lastgrad'];
		$yrlast=$rows['datelastgrad'];
		$gradaddresslast=$rows['addresslastgrad'];
	
	
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
	
<nav class='container'>
<?php
include('includes/menu.php');
?>
</nav>





<div id="main">
	<div class="shell">
	<center>
	<form class='cmxform' method='POST'>
	<fieldset>
			<legend><h4>Account Details</h4></legend>
			  <ol>
			  <li>
				  <label for="name"> &nbsp;&nbsp; UserName: </label>
				  <?php echo"<b>$username</b>";?>&nbsp;&nbsp; <a href='changepass.php'>Change Password</a>
				</li>
				
  </ol>
			
	</fieldset>
	
	<fieldset>
			<legend><h4>College Details</h4></legend>
			  <ol>
			  <li>
				  <label for="name">Student Number: </label>
				  <?php echo "<b>$snum</b>";  ?>
				  <label for="name">Course: </label>
				  <?php echo "<b>BSIT</b>";  ?>
				  <label for="name">Section/Year Level: </label>
				  <?php echo "<b>$yrlvlsec</b>";  ?>
				</li>
				
			</ol>
			
	</fieldset>
	
	<fieldset>	
			  <legend><h4>Personal Details</h4></legend>
			  <ol>
			  <li>
					<table align='center'>
						<tr>
							<td>First Name: </td><td><?php echo "<b>$fname</b>&nbsp&nbsp&nbsp&nbsp&nbsp";  ?></td><td>Civil Status: </td>
							<td><?php echo "<b>$civilstatus</b>";  ?></td>
																																				
						</tr>
						<tr>
							<td>Middle Initial: </td><td align='left'><?php echo "<b>$minitial</b>";  ?></td>
							<td>Guardian's Name: </td><td align='left'><?php echo "<b>$guardianname</b>";  ?></td>
						</tr>
						<tr>
							<td>Last Name: </td><td><?php echo "<b>$lname</b>";  ?></td>
							<td>Father's Name:</td><td align='left'><?php echo "<b>$fathername</b>";  ?></td>
						</tr>
						<tr>
							<td><label>Gender: </label></td><td align='left'><?php echo "<b>$gender</b>";  ?></td>
							<td>Mother's Name:</td><td align='left'><?php echo "<b>$mothername</b>";  ?></td>
						</tr>
						<tr>
							<td>BirthDate: </td><td><?php echo "<b>$bdate</b>";  ?></td><td>Birth Place:</td><td align='left'><?php echo "<b>$bplace</b>";  ?></td>
						</tr>
					</table>
					
				</li>
						
				
			  <li>
				  <label for="address1">Address: </label>
				  <textarea readonly="readonly" name='address' height='500' width='200'><?php echo $address; ?></textarea>
			</li>
			  <li>
				  <label for="address2">Contact Number: </label>
				  <?php echo "<b>$cnum</b>";  ?>
				</li>
			  <li>
				  <label for="town-city">Email Address</label>
				  <?php echo "<b>$email</b>";  ?>
				</li>
				  </ol>
				  </fieldset>
				<fieldset>
		<legend><h4>Educational Background</h4></legend>
			  <ol>
			  <li>
				  <table>
			
						<tr>
							<td>Elementary School: </td><td align='left'><?php echo "<b>$elemschool</b>";  ?></td>
							<td>Year Graduated:</td><td align='left'><?php echo "<b>$yrelem</b>";  ?></td>
						</tr>
						<tr>
							<td>High School:</td><td><?php echo "<b>$hsschool</b>";  ?></td>
							<td>Year Graduated:</td><td align='left'><?php echo "<b>$yrgradhs</b>";  ?></td>
						</tr>
						<tr>
							<td>School Last Attended:</td><td><?php echo "<b>$lastschool</b>";  ?></td>
							<td>Year Graduated:</td><td align='left'><?php echo "<b>$yrlast</b>";  ?></td>
						</tr>
						<tr>
							<td colspan='4' align='center'><label for="address1">Address<em>*</em></label>
				  <textarea name='address2' height='500' width='200' readonly="readonly"><?php echo  $gradaddresslast; ?></textarea></td>
						</tr>
					</table>
			</li>
				
			</ol>
			
	</fieldset>
			  
			  


<div align='center'><input type='submit' name='register' value='Add new user'>&nbsp;&nbsp;
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
