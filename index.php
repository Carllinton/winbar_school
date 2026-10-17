<?php
session_start();
include('conn.php');

if(isset($_POST['submit']))
{
	$username=$_POST['username'];
	$password=$_POST['password'];
	
		$check=$conn->query("SELECT * FROM usertbl WHERE username='$username' AND password='$password' LIMIT 1");
		if(mysqli_num_rows($check)==0)
			{
				echo"<script>window.alert('User doesn't exist please try again.')</script>";
			}
		else
			{
				while($rowval=mysqli_fetch_array($check))
					{
						if($rowval['user_type']=='admin')
							{
								$_SESSION['username']='$rowval[username]';
								$_SESSION['type']='admin';
								$_SESSION['logcheck']=1;
								echo"<script>window.alert('Successfully log in as Administrator')</script>";
								echo"<script>window.location='Admin/adminindex.php'</script>";
							}
						else	
							{
								$_SESSION['username']='$rowval[username]';
								$_SESSION['type']='student';
									$_SESSION['logcheck']=1;
								$_SESSION['userID']=$rowval['ID'];
								echo"<script>window.alert('Successfully log in as Student')</script>";
								echo"<script>window.location='student/studentindex.php'</script>";
							}
					}
			}
}
?>
<!doctype html>
<html>
<head>
<title>LOGIN PAGE</title>

<link href = "style.css" rel = "stylesheet" type = "text/css"/>

</head>
<body>




	<div class = "loginForm" align="center">
	
	<h1>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspSystem Login</h1>
	
<form method="POST">	
<div class="login-logo">
<img src="logo.jpg" width="160px" width="110px">
</div>
<div class="login-content">
	
	</br>
	<b>Username:</b>
	<input type="text" class="text" required='required'  name="username"/>
	</br></br>
	<b>Password :</b>

	<input type="password" class="text"  required='required' name="password"/>
	</br></br>
<input type="submit" name="submit" value="Login" class="btn"/>
	</div>
</form>
</body>
</html>