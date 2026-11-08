<?php
	session_start();
	include('logcheck.php');
	$getID=$_SESSION['userID'];
	include('includes/conn.php');
	
	$getprofile=$conn->query("SELECT * FROM studenttbl WHERE accountID = '$getID'");
	$rows=mysqli_fetch_array($getprofile);
	
	$getacc=$conn->query("SELECT * FROM usertbl WHERE ID = '$getID'");
	$rowacc=mysqli_fetch_array($getacc);
	
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
<!DOCTYPE html>
<html lang="en">
<head>
<title>My profile | Win B. A. R. Academy</title>
<?php include('includes/head.php'); ?>
</head>
<body class="role-student">

<?php include('includes/topbar.php'); ?>

<main class="page stack">
	<div class="page-head">
		<div>
			<p class="crumbs"><a href="studentindex.php">Home</a> <span aria-hidden="true">/</span> My profile</p>
			<h1><?php echo "$fname $lname"; ?></h1>
			<p class="page-head__lead">Your student record. If something is wrong, or you forgot your password, ask the registrar's office.</p>
		</div>
		<div class="page-head__actions">
			<a class="btn btn--primary" href="enroll.php">Enroll now</a>
		</div>
		<nav class="tabs" aria-label="My profile">
			<a href="studentprofile.php" class="is-active" aria-current="page">My profile</a>
			<a href="changepass.php">Password help</a>
		</nav>
	</div>

	<div class="tiles">
		<div class="tile"><div class="tile__label">Student number</div><div class="tile__value"><?php echo $snum; ?></div></div>
		<div class="tile"><div class="tile__label">Course</div><div class="tile__value caps"><?php echo $course; ?></div></div>
		<div class="tile"><div class="tile__label">Year and section</div><div class="tile__value"><?php echo $yrlvlsec; ?></div></div>
		<div class="tile"><div class="tile__label">Username</div><div class="tile__value"><?php echo $username; ?></div></div>
	</div>

	<section class="window">
		<div class="window__title">
			<h2>Personal details</h2>
		</div>
		<div class="window__body">
			<dl class="details">
				<div class="details__row"><dt>First name</dt><dd><?php echo $fname; ?></dd></div>
				<div class="details__row"><dt>Civil status</dt><dd class="caps-first"><?php echo $civilstatus; ?></dd></div>
				<div class="details__row"><dt>Middle initial</dt><dd><?php echo $minitial; ?></dd></div>
				<div class="details__row"><dt>Gender</dt><dd class="caps-first"><?php echo $gender; ?></dd></div>
				<div class="details__row"><dt>Last name</dt><dd><?php echo $lname; ?></dd></div>
				<div class="details__row"><dt>Birthdate</dt><dd><?php echo $bdate; ?></dd></div>
				<div class="details__row"><dt>Contact number</dt><dd><?php echo $cnum; ?></dd></div>
				<div class="details__row"><dt>Birthplace</dt><dd><?php echo $bplace; ?></dd></div>
				<div class="details__row"><dt>Email address</dt><dd><?php echo $email; ?></dd></div>
				<div class="details__row details__row--wide"><dt>Home address</dt><dd><?php echo $address; ?></dd></div>
			</dl>
		</div>
	</section>

	<div class="grid grid--2">
		<section class="window">
			<div class="window__title">
				<h2>Parents and guardian</h2>
			</div>
			<div class="window__body">
				<dl class="details details--1">
					<div class="details__row"><dt>Father's name</dt><dd><?php echo $fathername; ?></dd></div>
					<div class="details__row"><dt>Mother's name</dt><dd><?php echo $mothername; ?></dd></div>
					<div class="details__row"><dt>Guardian's name</dt><dd><?php echo $guardianname; ?></dd></div>
				</dl>
			</div>
		</section>

		<section class="window">
			<div class="window__title">
				<h2>Educational background</h2>
			</div>
			<div class="window__body">
				<dl class="details details--1">
					<div class="details__row"><dt>Elementary</dt><dd><?php echo $elemschool; ?> <span class="muted"><?php echo $yrelem; ?></span></dd></div>
					<div class="details__row"><dt>High school</dt><dd><?php echo $hsschool; ?> <span class="muted"><?php echo $yrgradhs; ?></span></dd></div>
					<div class="details__row"><dt>Last attended</dt><dd><?php echo $lastschool; ?> <span class="muted"><?php echo $yrlast; ?></span></dd></div>
					<div class="details__row"><dt>School address</dt><dd><?php echo $gradaddresslast; ?></dd></div>
				</dl>
			</div>
		</section>
	</div>
</main>

<?php include('includes/footer.php'); ?>

</body>
</html>
