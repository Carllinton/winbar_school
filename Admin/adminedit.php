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
		
		
		/* Prepared statements; the password is stored as a hash. A blank password keeps the current one. */
		if($password!=='')
		{
			$passwordhash=password_hash($password,PASSWORD_DEFAULT);
			$insertquery=$conn->prepare("UPDATE usertbl SET username=?, password=? WHERE user_type='admin'");
			$insertquery->bind_param("ss",$username,$passwordhash);
		}
		else
		{
			$insertquery=$conn->prepare("UPDATE usertbl SET username=? WHERE user_type='admin'");
			$insertquery->bind_param("s",$username);
		}
		$insertquery->execute();
		
			echo"<script>try{sessionStorage.setItem('winbarFlash','success|Admin account updated.')}catch(e){alert('Admin account updated.')}window.winbarLeaving=1;</script>";
			echo"<script>window.location='userreg.php'</script>";
	}

	
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Edit admin account | Win B. A. R. Academy</title>
<?php include('includes/head.php'); ?>
</head>
<body class="role-admin">

<?php include('includes/topbar.php'); ?>

<main class="page">
	<div class="page-head">
		<div>
			<p class="crumbs"><a href="adminindex.php">Home</a> <span aria-hidden="true">/</span> Manage students</p>
			<h1>Admin account</h1>
			<p class="page-head__lead">Change the username or password used to log in as administrator. Passwords are stored as one-way hashes, so the current one can't be shown.</p>
		</div>
		<nav class="tabs" aria-label="Manage students">
			<a href="userreg.php">All students</a>
			<a href="addnewuser.php">Add a student</a>
			<a href="adminedit.php" class="is-active" aria-current="page">Admin account</a>
		</nav>
	</div>

	<form class="window window--admin window--narrow" method="POST">
		<div class="window__title">
			<h2>Administrator login</h2>
		</div>
		<div class="window__body">
			<fieldset class="form-section">
				<legend class="form-section__title">Account details</legend>
				<div class="fields fields--1">
					<div class="field">
						<label for="username">Username <em>*</em></label>
						<input type="text" required="required" maxlength="50" id="username" name="username" autocomplete="username" value="<?php echo $rowfetch['username']; ?>" />
					</div>
					<div class="field">
						<label for="password">New password</label>
						<input type="password" maxlength="50" minlength="8" id="password" name="password" autocomplete="new-password" aria-describedby="password-hint" />
						<span class="field__hint" id="password-hint">Leave blank to keep the current password. New passwords need at least 8 characters.</span>
					</div>
				</div>
			</fieldset>
		</div>
		<div class="window__footer">
			<input type="reset" name="clear" value="Undo changes" />
			<input type="submit" name="register" value="Save admin account" />
		</div>
	</form>
</main>

<?php include('includes/footer.php'); ?>

</body>
</html>
