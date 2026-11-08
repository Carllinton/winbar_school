<?php
	session_start();
	include('logcheck.php');
	if(isset($_POST['register']))
	{
		include('../conn.php');
		
		$course=$_POST['course'];
		$stitle=$_POST['stitle'];
		$scode=$_POST['scode'];
		$sdescription=$_POST['cdescription'];
		$numunits=$_POST['numunits'];
		
		$sroom=$_POST['sroom'];
		$stime=$_POST['stime'];
		$sday=$_POST['sday'];
		$sinstructor=$_POST['sinstructor'];
		
		if(isset($_POST['islab']))
		{
			$islab=1;
		}
		else
		{
			$islab=0;
		}
	
		if(isset($_POST['istutorial']))
		{
			$istutorial=1;
		}
		else
		{
			$istutorial=0;
		}
		
		$insertquery=$conn->query("INSERT INTO subjecttbl VALUES ('','$scode','$stitle','$numunits','$sroom','$stime','$sday','$sinstructor',$islab,$istutorial,'$sdescription','$course')");
		
		echo"<script>try{sessionStorage.setItem('winbarFlash','success|Subject added.')}catch(e){alert('Subject added.')}window.winbarLeaving=1;</script>";
		echo"<script>window.location='addnewsubj.php'</script>";
	}
	
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Add a section | Win B. A. R. Academy</title>
<?php include('includes/head.php'); ?>
</head>
<body class="role-admin">

<?php include('includes/topbar.php'); ?>

<main class="page stack">
	<div class="page-head">
		<div>
			<p class="crumbs"><a href="adminindex.php">Home</a> <span aria-hidden="true">/</span> Manage subjects</p>
			<h1>Add a section</h1>
			<p class="page-head__lead">Set up a class section and its size limit.</p>
		</div>
	</div>

	<div class="notice notice--warn window--narrow">
		<span class="notice__icon" aria-hidden="true">!</span>
		<div><strong>This page isn't finished yet.</strong> Saving it currently runs the add-subject code, so don't use it for real data until the backend is updated.</div>
	</div>

	<form class="window window--narrow" method="POST">
		<div class="window__title">
			<h2>Section details</h2>
		</div>
		<div class="window__body">
			<div class="fields fields--1">
				<div class="field">
					<label for="course">Course <em>*</em></label>
					<select id="course" name="course">
						<option value="bsit">BSIT</option>
					</select>
				</div>
				<div class="field">
					<label for="section-name">Section name <em>*</em></label>
					<input type="text" required="required" maxlength="50" id="section-name" name="scode" placeholder="III-2" />
				</div>
				<div class="field">
					<label for="section-year">Year level <em>*</em></label>
					<select id="section-year" name="numunits">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
					</select>
				</div>
				<div class="field">
					<label for="section-max">Maximum number of students <em>*</em></label>
					<input type="number" required="required" id="section-max" name="scode" />
				</div>
			</div>
		</div>
		<div class="window__footer">
			<input type="reset" name="clear" value="Clear form" />
			<input type="submit" name="register" value="Add section" />
		</div>
	</form>
</main>

<?php include('includes/footer.php'); ?>

</body>
</html>
