<?php
	session_start();
	
	$getID=$_SESSION['userID'];
	include('includes/conn.php');
	include('logcheck.php');
	$getprofile=mysql_query("SELECT * FROM studenttbl WHERE accountID = '$getID'");
	$rows=mysql_fetch_array($getprofile);
	
	$getacc=mysql_query("SELECT * FROM usertbl WHERE ID= '$getID'");
	$rowaccs=mysql_fetch_array($getacc);
	
	
	if(isset($_POST['cpass']))
	{
		$oldpass=$_POST['opassword'];
		$checkpass=mysql_query("SELECT * FROM usertbl WHERE ID= '$getID' AND password='$oldpass'");
		if(mysql_num_rows($checkpass)==0)
		{
			echo"<script>window.alert('Inputted password is wrong please try again')</script>";
		}
		else
		{
			if($_POST['password']==$_POST['password2'])
			{
				$newpass=$_POST['password'];
				$updatepass=mysql_query("UPDATE usertbl SET password='$newpass' WHERE ID='$getID'");
				echo"<script>window.alert('Successfully updated the password')</script>";
				echo"<script>window.location='studentprofile.php')</script>";
			}
		}
	}
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
			  <table>
			  <tr>
				<td align='right'><label for="name" > Input Old Password: </label></td>
				<td><input type='password' name='opassword'></td>
			  </tr>
			  <tr>
				<td align='right'><label for="name" > Input New Password: </label></td>
				<td><input type='password' name='password'></td>
			  </tr>
			  <tr>
				<td align='right'><label for="name"> Input Password Again: </label></td>
				<td><input type='password' name='password2'></td>
			  </tr>
					</table>
				</li>
				
  </ol>
			
	</fieldset>
	<br>
	
<div align='center'><input type='submit' name='cpass' value='Change Password'>&nbsp;&nbsp;
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
