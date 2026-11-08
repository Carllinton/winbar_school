<?php
	session_start();
	include('logcheck.php');
	include('../conn.php');
	
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Manage students | Win B. A. R. Academy</title>
<?php include('includes/head.php'); ?>

	<script src="js/jquery-1.7.min.js"></script>
	<script src="js/jquery.dataTables.js" type="text/javascript"></script>
	<script src="js/jquery.easing.1.3.js"></script>

	<script type="text/javascript" charset="utf-8">
		$(document).ready(function(){
			$('#datatables').dataTable({
				"sPaginationType":"full_numbers",
				"aaSorting":[[2, "desc"]],
				"bJQueryUI":true
			});
		})
	</script>
</head>
<body class="role-admin">

<?php include('includes/topbar.php'); ?>

<main class="page">
	<div class="page-head">
		<div>
			<p class="crumbs"><a href="adminindex.php">Home</a> <span aria-hidden="true">/</span> Manage students</p>
			<h1>Students</h1>
			<p class="page-head__lead">Every registered student account. Search, sort by any column, or delete an account.</p>
		</div>
		<div class="page-head__actions">
			<a class="btn btn--primary" href="addnewuser.php">Add a student</a>
		</div>
		<nav class="tabs" aria-label="Manage students">
			<a href="userreg.php" class="is-active" aria-current="page">All students</a>
			<a href="addnewuser.php">Add a student</a>
			<a href="adminedit.php">Admin account</a>
		</nav>
	</div>

	<section class="window">
		<div class="window__title">
			<h2>Registered students</h2>
		</div>
		<div class="window__body--flush">
		<form method="post" class="niceform">
		<p class="scroll-hint no-print">Swipe the table sideways to see every column.</p>
		<div class="table-scroll">
		 <table id="datatables" class="display">
			<thead>
				<tr>
					<th>Student ID</th>
					<th>Student name</th>
					<th>Course</th>
					<th>Year and section</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			  <?php
			  include('../conn.php');
				$getusers=$conn->query("SELECT * FROM studenttbl");
				if(mysqli_num_rows($getusers)==0)
				{
				echo"<tr class='empty-row'>
						<td colspan ='5'>
							No students yet. Use Add a student to create the first account.
						</td>
					</tr>";
				}
				else
				{
				while($getrows=mysqli_fetch_array($getusers))
					{
					echo"<tr>
							<td class='mono'>$getrows[studnum]</td>
							<td>$getrows[fname] $getrows[minitial] $getrows[lname]</td>
							<td><span class='badge badge--primary caps'>$getrows[course]</span></td>
							<td>$getrows[yearlvl]</td>"?>
							<td class="row-actions"><a class="link-action" href="resetpass.php?<?php echo"accid=$getrows[ID]";?>">Reset password</a> <a class="link-danger" href="deletecurruser.php?<?php echo"accid=$getrows[ID]";?>" onclick="return confirm('Delete this student account? This cannot be undone.');"
								data-confirm-title="Delete <?php echo htmlspecialchars("$getrows[fname] $getrows[lname]", ENT_QUOTES); ?>'s account?" data-confirm="This removes the student's login and record. It can't be undone." data-confirm-action="Delete account" data-confirm-tone="danger">Delete</a></td>
						</tr>
						<?php
					}
				}
					?>
			</tbody>
		</table>
		</div>
		</form>
		</div>
	</section>
</main>

<?php include('includes/footer.php'); ?>

</body>
</html>
