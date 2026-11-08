<?php
	session_start();
	
	$getID=$_SESSION['userID'];
	include('includes/conn.php');
	include('logcheck.php');
	
	
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
		
		$_SESSION['studnum']=$rows['studnum'];
		
		
	
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Enroll now | Win B. A. R. Academy</title>
<?php include('includes/head.php'); ?>
</head>
<body class="role-student">

<?php include('includes/topbar.php'); ?>

<main class="page">
	<div class="page-head">
		<div>
			<p class="crumbs"><a href="studentindex.php">Home</a> <span aria-hidden="true">/</span> Enroll now</p>
			<h1>Enroll now</h1>
			<p class="page-head__lead">Choose the semester, tick the subjects you're taking, then review your form and fees on the next page.</p>
		</div>
	</div>

	<form class="stack" method="POST" action="showsubs.php"
		data-require-one="subject[]" data-require-message="Pick at least one subject to enroll in." data-unit-counter
		onsubmit="if (!this.querySelector('input[type=checkbox]:checked')) { alert('Pick at least one subject to enroll in.'); return false; }">

		<div class="tiles">
			<div class="tile"><div class="tile__label">Student</div><div class="tile__value"><?php echo $fullname; ?></div></div>
			<div class="tile"><div class="tile__label">Course</div><div class="tile__value caps"><?php echo $course; ?></div></div>
			<div class="tile"><div class="tile__label">Year and section</div><div class="tile__value"><?php echo $yrlvlsec; ?></div></div>
			<div class="tile">
				<label class="tile__label" for="sem">Semester</label>
				<select id="sem" name="sem">
					<option value="1st Sem">1st semester</option>
					<option value="2nd Sem">2nd semester</option>
				</select>
			</div>
		</div>

		<section class="window">
			<div class="window__title">
				<h2>Available subjects</h2>
			</div>
			<p class="scroll-hint no-print">Swipe the table sideways to see every column.</p>
			<div class="window__body--flush table-scroll">
				<table class="data-table">
					<thead>
						<tr>
							<th class="pick">Take</th>
							<th>Code</th>
							<th>Subject title</th>
							<th>Description</th>
							<th class="num">Units</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$getsubjects=$conn->query("SELECT * FROM subjecttbl");
							while($fetchsub=mysqli_fetch_array($getsubjects))
							{
								echo"<tr>";
									echo"<td class='pick'><input type='checkbox' name='subject[]' value='$fetchsub[subjectcode]' id='sub-$fetchsub[ID]'></td>";
									echo"<td class='mono'><label for='sub-$fetchsub[ID]'>$fetchsub[subjectcode]</label></td>";
									echo"<td><label for='sub-$fetchsub[ID]'>$fetchsub[subjecttitle]</label></td>";
									echo"<td class='muted'>$fetchsub[description]</td>";
									echo"<td class='num'>$fetchsub[numofunits]</td>";
								echo"</tr>";
							}
						?>
					</tbody>
				</table>
			</div>
			<div class="window__footer">
				<p class="unit-counter" data-unit-output aria-live="polite">No subjects selected yet</p>
				<input type="reset" name="clear" value="Clear selection" />
				<input type="submit" name="register" value="Review enrollment form" />
			</div>
		</section>
	</form>
</main>

<?php include('includes/footer.php'); ?>

</body>
</html>
