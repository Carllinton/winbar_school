<?php
	/* School rule: students can't change their own passwords. The registrar resets them
	   (admin: Manage students > Reset password). This page explains that; it no longer has a form. */
	session_start();
	include('logcheck.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Password help | Win B. A. R. Academy</title>
<?php include('includes/head.php'); ?>
</head>
<body class="role-student">

<?php include('includes/topbar.php'); ?>

<main class="page">
	<div class="page-head">
		<div>
			<p class="crumbs"><a href="studentindex.php">Home</a> <span aria-hidden="true">/</span> My profile</p>
			<h1>Password help</h1>
			<p class="page-head__lead">Passwords are managed by the registrar's office.</p>
		</div>
	</div>

	<section class="window window--narrow">
		<div class="window__title">
			<h2>Forgot your password?</h2>
		</div>
		<div class="window__body prose">
			<p>Students can't change their own passwords. If you forgot yours, or think someone else knows it, the registrar's office will set a new one for you.</p>
			<h3>What to do</h3>
			<ol class="steps">
				<li>Go to the registrar's office and bring your school ID.</li>
				<li>Ask them to reset your portal password.</li>
				<li>Log in with the new password they give you, and keep it to yourself.</li>
			</ol>
			<h3>Registrar's office</h3>
			<p>[Office hours and room]</p>
		</div>
		<div class="window__footer">
			<a class="btn" href="studentprofile.php">Back to my profile</a>
		</div>
	</section>
</main>

<?php include('includes/footer.php'); ?>

</body>
</html>
