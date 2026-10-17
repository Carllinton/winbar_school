<?php
	session_start();
	include('logcheck.php');
	if(isset($_POST['register']))
	{
		include('../conn.php');
		$username=$_POST['username'];
		$password=$_POST['password'];
		
		$course=$_POST['course'];
		$yrlvlsec=$_POST['yrlvlsec'];
		$snum=$_POST['snum'];
		
		$fname=$_POST['fname'];
		$minitial=$_POST['minitial'];
		$lname=$_POST['lname'];
		$fullname= $fname." ".$minitial." ".$lname;
		
		$gender=$_POST['gender'];
		$bdate=$_POST['bdate'];
		
		$address=$_POST['address'];
		$cnum=$_POST['cnumber'];
		$email=$_POST['email'];
		
		
		$fathername=$_POST['fathername'];
		$mothername=$_POST['mothername'];
		$guardianname=$_POST['guardianname'];
		
		$civilstatus=$_POST['cstatus'];
		$bplace=$_POST['bplace'];
		
		$elemschool=$_POST['elemschool'];
		$yrelem=$_POST['yrgradelem'];
		$hsschool=$_POST['hschool'];
		$yrgradhs=$_POST['yrgradhs'];
		$lastschool=$_POST['lastschool'];
		$yrlast=$_POST['yrlast'];
		$gradaddresslast=$_POST['address2'];
		
		
		$insertquery=$conn->query("INSERT INTO usertbl VALUES ('','$username','$password','$fullname','student')");
		
		$gethighest=$conn->query("SELECT * FROM usertbl ORDER BY ID DESC LIMIT 1");
		$check=mysqli_num_rows($gethighest);
			while($getid=mysqli_fetch_array($gethighest))
			{
				$insertstudent=$conn->query("INSERT INTO studenttbl VALUES('','$getid[ID]','$snum','$fname','$minitial','$lname','$address','$cnum','$email','$bdate','$course','$yrlvlsec','$gender',
				'$fathername','$mothername','$guardianname','$bplace','$civilstatus','$elemschool','$yrelem','$hsschool','$yrgradhs',
				'$lastschool','$yrlast','$gradaddresslast')");
			}
			echo"<script>window.alert('Successfully Created new account $check')</script>";
			echo"<script>window.location='addnewuser.php'</script>";
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
			<legend>Account Details</legend>
			  <ol>
			  <li>
				  <label for="name">UserName<em>*</em></label>
				  <input type='text' required='required' maxlength='50' id="name" name='username' value="<?php echo $username ;?>"/>
				  <label for="name">Password<em>*</em></label>
				  <input type='password' required='required' maxlength='50' id="name" name='password' value="<?php echo $password ;?>" />
				</li>
				
  </ol>
			
	</fieldset>
	
	<fieldset>
			<legend>College Details</legend>
			  <ol>
			  <li>
				  <label for="name">Student Number:<em>*</em></label>
				  <input type='text' maxlength='50' id="name" required='required' name='snum' />
				  <label for="name">Course<em>*</em></label>
				  <select name='course'>
				  <option value='bsit'>BSIT</option>
				  <option value='bscs'>BSCS</option></select>
				  <label for="name">Section/Year Level:<em>*</em></label>
				  <input type='text' required='required' maxlength='50' id="name" name='yrlvlsec' />
				</li>
				
			</ol>
			
	</fieldset>
	
	<fieldset>	
			  <legend>Personal Details</legend>
			  <ol>
			  <li>
					<table>
						<tr>
							<td>First Name:</td><td><input type='text' maxlength='50' id="name" name='fname' /></td><td>Civil Status:</td><td><select name='cstatus'>
																																				<option value='single'>Single</option>
																																				<option value='married'>Married</option>
																																				<option value='widow'>Widow</option>
																																				</select></td>
						</tr>
						<tr>
							<td>Middle Initial:</td><td align='left'><input type='text' class='middle-initial' maxlength='5' id="name" name='minitial' /></td>
							<td>Guardian's Name:</td><td align='left'><input type='text'  maxlength='50' id="name" name='guardianname' /></td>
						</tr>
						<tr>
							<td>Last Name:</td><td><input type='text' maxlength='50' id="name" name='lname' /></td>
							<td>Father's Name:</td><td align='left'><input type='text'  maxlength='50' id="name" name='fathername' /></td>
						</tr>
						<tr>
							<td><label>Gender:</label></td><td align='left'><input type='radio' id='name' name='gender' value='male'>Male &nbsp;&nbsp;<input type='radio' id='name' name='gender' value='female'>Female</td>
							<td>Mother's Name:</td><td align='left'><input type='text'  maxlength='50' id="name" name='mothername' /></td>
						</tr>
						<tr>
							<td>BirthDate:</td><td><input type="date" name="bdate" /></td><td>Birth Place:</td><td align='left'><input type='text'  maxlength='50' id="name" name='bplace' /></td>
						</tr>
					</table>
					
				</li>
						
				
			  <li>
				  <label for="address1">Address<em>*</em></label>
				  <textarea name='address' height='500' width='200'></textarea>
			</li>
			  <li>
				  <label for="address2">Contact Number</label>
				  <input type='text' name='cnumber' maxlength='11'/>
				</li>
			  <li>
				  <label for="town-city">Email Address</label>
				  <input type='text' name='email' id="town-city" />
				</li>
				  </ol>
				  </fieldset>
				<fieldset>
		<legend>Educational Background</legend>
			  <ol>
			  <li>
				  <table>
			
						<tr>
							<td>Elementary School:</td><td align='left'><input type='text'  id="name" name='elemschool' /></td>
							<td>Year Graduated:</td><td align='left'><select name='yrgradelem'>
																	<?php
																	 $num=1990;
																	 while($num<=2010)
																	 {
																		echo"<option value='$num'>$num</option>";
																		$num=$num + 1;
																	 }
																	?>
																	</select></td>
						</tr>
						<tr>
							<td>High School:</td><td><input type='text' id="name" name='hschool' /></td>
							<td>Year Graduated:</td><td align='left'><select name='yrgradhs'>
																	<?php
																	 $num=1990;
																	 while($num<=2010)
																	 {
																		echo"<option value='$num'>$num</option>";
																		$num=$num + 1;
																	 }
																	?>
																	</select></td>
						</tr>
						<tr>
							<td>School Last Attended:</td><td><input type='text' id="name" name='lastschool' /></td>
							<td>Year Graduated:</td><td align='left'><select name='yrlast'>
																	<?php
																	 $num=1990;
																	 while($num<=2010)
																	 {
																		echo"<option value='$num'>$num</option>";
																		$num=$num + 1;
																	 }
																	?>
																	</select></td>
						</tr>
						<tr>
							<td colspan='4' align='center'><label for="address1">Address<em>*</em></label>
				  <textarea name='address2' height='500' width='200'></textarea></td>
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
