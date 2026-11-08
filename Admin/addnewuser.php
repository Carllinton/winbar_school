<?php
	session_start();
	include('logcheck.php');
	if(isset($_POST['register']))
	{
		include('../conn.php');
		$username=$_POST['username'];
		$password=$_POST['password'];
		
		$course=$_POST['course'];
		$yrlvlsec=$_POST['yrlvlsec'];
		$snum=$_POST['snum'];
		
		$fname=$_POST['fname'];
		$minitial=$_POST['minitial'];
		$lname=$_POST['lname'];
		$fullname= $fname." ".$minitial." ".$lname;
		
		$gender=isset($_POST['gender']) ? $_POST['gender'] : '';
		$bdate=$_POST['bdate'];
		
		$address=$_POST['address'];
		$cnum=$_POST['cnumber'];
		$email=$_POST['email'];
		
		
		$fathername=$_POST['fathername'];
		$mothername=$_POST['mothername'];
		$guardianname=$_POST['guardianname'];
		
		$civilstatus=$_POST['cstatus'];
		$bplace=$_POST['bplace'];
		
		$elemschool=$_POST['elemschool'];
		$yrelem=$_POST['yrgradelem'];
		$hsschool=$_POST['hschool'];
		$yrgradhs=$_POST['yrgradhs'];
		$lastschool=$_POST['lastschool'];
		$yrlast=$_POST['yrlast'];
		$gradaddresslast=$_POST['address2'];
		
		
		/* Hashed password + prepared statements (no SQL injection). NULL lets MySQL assign the IDs,
		   which also works with strict SQL mode. */
		$passwordhash=password_hash($password,PASSWORD_DEFAULT);
		$adduser=$conn->prepare("INSERT INTO usertbl (ID, username, password, fullname, user_type) VALUES (NULL, ?, ?, ?, 'student')");
		$adduser->bind_param("sss",$username,$passwordhash,$fullname);
		$adduser->execute();
		$newaccountID=$conn->insert_id;

		$addstudent=$conn->prepare("INSERT INTO studenttbl VALUES (NULL,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$addstudent->bind_param("ssssssssssssssssssssssss",$newaccountID,$snum,$fname,$minitial,$lname,$address,$cnum,$email,$bdate,$course,$yrlvlsec,$gender,
			$fathername,$mothername,$guardianname,$bplace,$civilstatus,$elemschool,$yrelem,$hsschool,$yrgradhs,
			$lastschool,$yrlast,$gradaddresslast);
		$addstudent->execute();
			echo"<script>try{sessionStorage.setItem('winbarFlash','success|Student account created.')}catch(e){alert('Student account created.')}window.winbarLeaving=1;</script>";
			echo"<script>window.location='addnewuser.php'</script>";
	}
	
	

	/* Suggest the next free student ID for this year: YY-NNNN, starting at YY-1001 */
	if(!isset($conn)) { include('../conn.php'); }
	$yearprefix=date('y');
	$nextnumber=1001;
	$findlast=$conn->prepare("SELECT studnum FROM studenttbl WHERE studnum LIKE CONCAT(?, '-%')");
	$findlast->bind_param("s",$yearprefix);
	$findlast->execute();
	$existing=$findlast->get_result();
	while($idrow=$existing->fetch_assoc())
	{
		$parts=explode('-',$idrow['studnum']);
		if(isset($parts[1]) && ctype_digit($parts[1]) && (int)$parts[1]>=$nextnumber) { $nextnumber=(int)$parts[1]+1; }
	}
	$suggestedID=$yearprefix.'-'.$nextnumber;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Add a student | Win B. A. R. Academy</title>
<?php include('includes/head.php'); ?>
</head>
<body class="role-admin">

<?php include('includes/topbar.php'); ?>

<main class="page">
	<div class="page-head">
		<div>
			<p class="crumbs"><a href="adminindex.php">Home</a> <span aria-hidden="true">/</span> Manage students</p>
			<h1>Add a student</h1>
			<p class="page-head__lead">Creates the student's login and their record. Fields marked <span class="req">*</span> are required.</p>
		</div>
		<nav class="tabs" aria-label="Manage students">
			<a href="userreg.php">All students</a>
			<a href="addnewuser.php" class="is-active" aria-current="page">Add a student</a>
			<a href="adminedit.php">Admin account</a>
		</nav>
	</div>

	<form class="window" method="POST">
		<div class="window__title">
			<h2>Student information</h2>
		</div>
		<div class="window__body">

			<fieldset class="form-section">
				<legend class="form-section__title">Account details</legend>
				<div class="fields">
					<div class="field">
						<label for="username">Username <em>*</em></label>
						<input type="text" required="required" maxlength="50" id="username" name="username" autocomplete="off" aria-describedby="username-hint" value="<?php echo htmlspecialchars(isset($username) ? $username : $suggestedID, ENT_QUOTES); ?>" />
						<span class="field__hint" id="username-hint">Defaults to the student ID, which students use to log in</span>
					</div>
					<div class="field">
						<label for="password">Password <em>*</em></label>
						<input type="password" required="required" maxlength="50" id="password" name="password" autocomplete="new-password" minlength="8" aria-describedby="password-hint" />
						<span class="field__hint" id="password-hint">At least 8 characters. Give it to the student privately.</span>
					</div>
				</div>
			</fieldset>

			<fieldset class="form-section">
				<legend class="form-section__title">College details</legend>
				<div class="fields fields--3">
					<div class="field">
						<label for="snum">Student number <em>*</em></label>
						<input type="text" maxlength="11" id="snum" required="required" name="snum" value="<?php echo htmlspecialchars($suggestedID, ENT_QUOTES); ?>" pattern="[0-9]{2}-[0-9]{4}" title="Two-digit entry year, a dash, then four digits, like 25-1001" aria-describedby="snum-hint" />
						<span class="field__hint" id="snum-hint">Entry year, a dash, then four digits. The next free ID is filled in.</span>
					</div>
					<div class="field">
						<label for="course">Course <em>*</em></label>
						<select id="course" name="course">
							<option value="bsit">BSIT</option>
							<option value="bscs">BSCS</option>
						</select>
					</div>
					<div class="field">
						<label for="yrlvlsec">Year and section <em>*</em></label>
						<input type="text" required="required" maxlength="50" id="yrlvlsec" name="yrlvlsec" placeholder="III-2" aria-describedby="yrlvlsec-hint" />
						<span class="field__hint" id="yrlvlsec-hint">Year in Roman numerals, a dash, then the section</span>
					</div>
				</div>
			</fieldset>

			<fieldset class="form-section">
				<legend class="form-section__title">Personal details</legend>
				<div class="fields fields--3">
					<div class="field">
						<label for="fname">First name</label>
						<input type="text" maxlength="50" id="fname" name="fname" />
					</div>
					<div class="field">
						<label for="minitial">Middle initial</label>
						<input type="text" class="middle-initial" maxlength="5" id="minitial" name="minitial" />
					</div>
					<div class="field">
						<label for="lname">Last name</label>
						<input type="text" maxlength="50" id="lname" name="lname" />
					</div>
					<div class="field">
						<span class="field__label" id="gender-label">Gender</span>
						<div class="choice-row" role="radiogroup" aria-labelledby="gender-label">
							<label class="choice"><input type="radio" name="gender" value="male" /> Male</label>
							<label class="choice"><input type="radio" name="gender" value="female" /> Female</label>
						</div>
					</div>
					<div class="field">
						<label for="bdate">Birthdate</label>
						<input type="date" id="bdate" name="bdate" />
					</div>
					<div class="field">
						<label for="bplace">Birthplace</label>
						<input type="text" maxlength="50" id="bplace" name="bplace" />
					</div>
					<div class="field">
						<label for="cstatus">Civil status</label>
						<select id="cstatus" name="cstatus">
							<option value="single">Single</option>
							<option value="married">Married</option>
							<option value="widow">Widow</option>
						</select>
					</div>
					<div class="field">
						<label for="cnumber">Contact number</label>
						<input type="text" id="cnumber" name="cnumber" maxlength="11" inputmode="numeric" placeholder="09171234567" pattern="09[0-9]{9}" title="11 digits starting with 09" aria-describedby="cnumber-hint" />
						<span class="field__hint" id="cnumber-hint">11 digits, starting with 09</span>
					</div>
					<div class="field">
						<label for="email">Email address</label>
						<input type="email" id="email" name="email" placeholder="name@example.com" aria-describedby="email-hint" />
						<span class="field__hint" id="email-hint">Used for school notices</span>
					</div>
					<div class="field field--wide">
						<label for="address">Home address <em>*</em></label>
						<textarea id="address" name="address" required="required"></textarea>
					</div>
				</div>
			</fieldset>

			<fieldset class="form-section">
				<legend class="form-section__title">Parents and guardian</legend>
				<div class="fields fields--3">
					<div class="field">
						<label for="fathername">Father's name</label>
						<input type="text" maxlength="50" id="fathername" name="fathername" />
					</div>
					<div class="field">
						<label for="mothername">Mother's name</label>
						<input type="text" maxlength="50" id="mothername" name="mothername" />
					</div>
					<div class="field">
						<label for="guardianname">Guardian's name</label>
						<input type="text" maxlength="50" id="guardianname" name="guardianname" />
					</div>
				</div>
			</fieldset>

			<fieldset class="form-section">
				<legend class="form-section__title">Educational background</legend>
				<div class="fields">
					<div class="field">
						<label for="elemschool">Elementary school</label>
						<input type="text" id="elemschool" name="elemschool" />
					</div>
					<div class="field">
						<label for="yrgradelem">Year graduated</label>
						<select id="yrgradelem" name="yrgradelem">
							<?php
							 $num=1990;
							 while($num<=date('Y'))
							 {
								echo"<option value='$num'>$num</option>";
								$num=$num + 1;
							 }
							?>
						</select>
					</div>
					<div class="field">
						<label for="hschool">High school</label>
						<input type="text" id="hschool" name="hschool" />
					</div>
					<div class="field">
						<label for="yrgradhs">Year graduated</label>
						<select id="yrgradhs" name="yrgradhs">
							<?php
							 $num=1990;
							 while($num<=date('Y'))
							 {
								echo"<option value='$num'>$num</option>";
								$num=$num + 1;
							 }
							?>
						</select>
					</div>
					<div class="field">
						<label for="lastschool">School last attended</label>
						<input type="text" id="lastschool" name="lastschool" />
					</div>
					<div class="field">
						<label for="yrlast">Year graduated</label>
						<select id="yrlast" name="yrlast">
							<?php
							 $num=1990;
							 while($num<=date('Y'))
							 {
								echo"<option value='$num'>$num</option>";
								$num=$num + 1;
							 }
							?>
						</select>
					</div>
					<div class="field field--wide">
						<label for="address2">Address of school last attended <em>*</em></label>
						<textarea id="address2" name="address2" required="required"></textarea>
					</div>
				</div>
			</fieldset>

		</div>
		<div class="window__footer">
			<input type="reset" name="clear" value="Clear form" />
			<input type="submit" name="register" value="Add student" />
		</div>
	</form>
</main>

<?php include('includes/footer.php'); ?>

</body>
</html>
