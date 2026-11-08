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
<title>Add a subject | Win B. A. R. Academy</title>
<?php include('includes/head.php'); ?>
</head>
<body class="role-admin">

<?php include('includes/topbar.php'); ?>

<main class="page">
	<div class="page-head">
		<div>
			<p class="crumbs"><a href="adminindex.php">Home</a> <span aria-hidden="true">/</span> Manage subjects</p>
			<h1>Add a subject</h1>
			<p class="page-head__lead">New subjects appear on the student enrollment page right away. Fields marked <span class="req">*</span> are required.</p>
		</div>
		<nav class="tabs" aria-label="Manage subjects">
			<a href="subjectreg.php">All subjects</a>
			<a href="addnewsubj.php" class="is-active" aria-current="page">Add a subject</a>
		</nav>
	</div>

	<form class="window" method="POST">
		<div class="window__title">
			<h2>Subject information</h2>
		</div>
		<div class="window__body">

			<fieldset class="form-section">
				<legend class="form-section__title">Subject details</legend>
				<div class="fields fields--3">
					<div class="field">
						<label for="course">Course <em>*</em></label>
						<select id="course" name="course">
							<option value="bsit">BSIT</option>
						</select>
					</div>
					<div class="field">
						<label for="scode">Subject code <em>*</em></label>
						<input type="text" required="required" maxlength="50" id="scode" name="scode" placeholder="IT 301" />
					</div>
					<div class="field">
						<label for="numunits">Units <em>*</em></label>
						<select id="numunits" name="numunits">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
						</select>
					</div>
					<div class="field field--wide">
						<label for="stitle">Subject title <em>*</em></label>
						<input type="text" required="required" id="stitle" name="stitle" placeholder="Web Systems and Technologies" />
					</div>
					<div class="field field--wide">
						<label for="cdescription">Description</label>
						<textarea id="cdescription" name="cdescription"></textarea>
					</div>
				</div>
			</fieldset>

			<fieldset class="form-section">
				<legend class="form-section__title">Schedule</legend>
				<div class="fields">
					<div class="field">
						<label for="sday">Day <em>*</em></label>
						<input type="text" required="required" id="sday" name="sday" placeholder="Mon / Wed" />
					</div>
					<div class="field">
						<label for="stime">Time <em>*</em></label>
						<input type="text" required="required" id="stime" name="stime" placeholder="9:00 to 10:30 AM" />
					</div>
					<div class="field">
						<label for="sroom">Room <em>*</em></label>
						<input type="text" required="required" id="sroom" name="sroom" placeholder="Lab 2" />
					</div>
					<div class="field">
						<label for="sinstructor">Instructor <em>*</em></label>
						<input type="text" required="required" id="sinstructor" name="sinstructor" />
					</div>
				</div>
			</fieldset>

			<fieldset class="form-section">
				<legend class="form-section__title">Extra fees</legend>
				<div class="choice-row">
					<label class="choice"><input type="checkbox" name="islab" /> Has a lab fee</label>
					<label class="choice"><input type="checkbox" name="istutorial" /> Has a tutorial fee</label>
				</div>
			</fieldset>

		</div>
		<div class="window__footer">
			<input type="reset" name="clear" value="Clear form" />
			<input type="submit" name="register" value="Add subject" />
		</div>
	</form>
</main>

<?php include('includes/footer.php'); ?>

</body>
</html>
