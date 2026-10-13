<?php
	session_start();
	include('../conn.php');
	include('logcheck.php');
	$getquery=$conn->query("SELECT * FROM usertbl WHERE user_type='admin' LIMIT 1");
	$rowfetch=mysqli_fetch_array($getquery);
	if(isset($_POST['register']))
	{
		
		$username=$_POST['username'];
		$password=$_POST['password'];
		
		
		$insertquery=$conn->query("UPDATE usertbl SET username='$username', password='$password' WHERE user_type='admin' ");
		
			echo"<script>window.alert('Successfully updated the admin account')</script>";
			echo"<script>window.location='userreg.php'</script>";
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
				  <input type='text' required='required' maxlength='50' id="name" name='username' value="<?php echo $rowfetch['username']; ?>"/>
				  <label for="name">Password<em>*</em></label>
				  <input type='text' required='required' maxlength='50' id="name" name='password' value="<?php echo $rowfetch['password']; ?>"/>
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
