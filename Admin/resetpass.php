<?php
	/* Reset a student's password (registrar rule: students can't change their own).
	   Opened from the Reset password link on the student list: resetpass.php?accid=<studenttbl ID> */
	session_start();
	include('../conn.php');
	include('logcheck.php');

	$studentID = isset($_GET['accid']) ? (int)$_GET['accid'] : 0;
	$getstudent = $conn->prepare("SELECT ID, accountID, studnum, fname, lname FROM studenttbl WHERE ID=? LIMIT 1");
	$getstudent->bind_param("i", $studentID);
	$getstudent->execute();
	$student = $getstudent->get_result()->fetch_assoc();

	if(!$student)
	{
		echo "<script>try{sessionStorage.setItem('winbarFlash','error|That student record wasn\'t found.')}catch(e){}window.winbarLeaving=1;window.location='userreg.php'</script>";
		exit;
	}

	$studentname = $student['fname'].' '.$student['lname'];

	if(isset($_POST['reset']))
	{
		$newpass = $_POST['password'];
		$newpass2 = $_POST['password2'];
		if(strlen($newpass) < 8 || $newpass !== $newpass2)
		{
			echo "<script>window.winbarFlashNow='error|The two passwords must match and have at least 8 characters.';</script>";
		}
		else
		{
			$passwordhash = password_hash($newpass, PASSWORD_DEFAULT);
			$accountID = (int)$student['accountID'];
			$update = $conn->prepare("UPDATE usertbl SET password=? WHERE ID=? AND user_type='student'");
			$update->bind_param("si", $passwordhash, $accountID);
			$update->execute();
			$message = json_encode('success|Password reset for '.$studentname.'. Give the new password to the student in person.');
			echo "<script>try{sessionStorage.setItem('winbarFlash',".$message.")}catch(e){}window.winbarLeaving=1;window.location='userreg.php'</script>";
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Reset password | Win B. A. R. Academy</title>
<?php include('includes/head.php'); ?>
</head>
<body class="role-admin">

<?php include('includes/topbar.php'); ?>

<main class="page">
	<div class="page-head">
		<div>
			<p class="crumbs"><a href="adminindex.php">Home</a> <span aria-hidden="true">/</span> Manage students</p>
			<h1>Reset password</h1>
			<p class="page-head__lead">For <strong><?php echo htmlspecialchars($studentname, ENT_QUOTES); ?></strong> (<?php echo htmlspecialchars($student['studnum'], ENT_QUOTES); ?>). Students can't change their own passwords, so give the new one to the student in person.</p>
		</div>
		<nav class="tabs" aria-label="Manage students">
			<a href="userreg.php">All students</a>
			<a href="addnewuser.php">Add a student</a>
			<a href="adminedit.php">Admin account</a>
		</nav>
	</div>

	<form class="window window--admin window--narrow" method="POST">
		<div class="window__title">
			<h2>New password</h2>
		</div>
		<div class="window__body">
			<div class="fields fields--1">
				<div class="field">
					<label for="password">New password</label>
					<input type="password" id="password" name="password" minlength="8" maxlength="50" autocomplete="new-password" required="required" aria-describedby="password-hint" />
					<span class="field__hint" id="password-hint">At least 8 characters.</span>
				</div>
				<div class="field">
					<label for="password2">Type it again</label>
					<input type="password" id="password2" name="password2" minlength="8" maxlength="50" autocomplete="new-password" required="required"
						oninput="this.setCustomValidity(this.value === document.getElementById('password').value ? '' : 'The two passwords don\'t match.');" />
				</div>
			</div>
		</div>
		<div class="window__footer">
			<a class="btn btn--ghost" href="userreg.php">Cancel</a>
			<input type="submit" name="reset" value="Reset password" />
		</div>
	</form>
</main>

<?php include('includes/footer.php'); ?>

</body>
</html>
