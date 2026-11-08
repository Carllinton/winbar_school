<?php
	session_start();
	include('logcheck.php');
	include('../conn.php');
	
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Manage subjects | Win B. A. R. Academy</title>
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
			<p class="crumbs"><a href="adminindex.php">Home</a> <span aria-hidden="true">/</span> Manage subjects</p>
			<h1>Subjects</h1>
			<p class="page-head__lead">Subjects students can choose from when they enroll.</p>
		</div>
		<div class="page-head__actions">
			<a class="btn btn--primary" href="addnewsubj.php">Add a subject</a>
		</div>
		<nav class="tabs" aria-label="Manage subjects">
			<a href="subjectreg.php" class="is-active" aria-current="page">All subjects</a>
			<a href="addnewsubj.php">Add a subject</a>
		</nav>
	</div>

	<section class="window">
		<div class="window__title">
			<h2>Subject list</h2>
		</div>
		<div class="window__body--flush">
		<form method="post" class="niceform">
		<p class="scroll-hint no-print">Swipe the table sideways to see every column.</p>
		<div class="table-scroll">
		 <table id="datatables" class="display">
			<thead>
				<tr>
					<th>Subject code</th>
					<th>Subject name</th>
					<th>Units</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
					 <?php
				$getusers=$conn->query("SELECT * FROM subjecttbl");
				if(mysqli_num_rows($getusers)==0)
				{
				echo"<tr class='empty-row'>
						<td colspan ='4'>
							No subjects yet. Use Add a subject to create the first one.
						</td>
					</tr>";
				}
				else
				{
				while($getrows=mysqli_fetch_array($getusers))
					{
					echo"<tr>
							<td class='mono'>$getrows[subjectcode]</td>
							<td>$getrows[subjecttitle]</td>
							<td>$getrows[numofunits]</td>";
					?>
							 <td><a class="link-danger" href="deletecurrsubj.php?<?php echo "accid=$getrows[ID]";?>" onclick="return confirm('Delete this subject? Students will no longer see it when they enroll.');"
								data-confirm-title="Delete <?php echo htmlspecialchars("$getrows[subjectcode]", ENT_QUOTES); ?>?" data-confirm="Students will no longer see this subject when they enroll. It can't be undone." data-confirm-action="Delete subject" data-confirm-tone="danger">Delete</a></td>
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
