<?php
session_start();
include('../includes/conn.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Student report | Win B. A. R. Academy</title>
<link rel="icon" type="image/svg+xml" href="../../assets/img/favicon.svg" />
<link href="../../style.css" rel="stylesheet" type="text/css" />
</head>
<body class="doc-page role-admin">

<div class="doc">
	<div class="doc__toolbar no-print">
		<a class="btn btn--ghost" href="../userreg.php">Back to students</a>
		<button type="button" class="btn btn--primary" onclick="window.print()">Print report</button>
	</div>

	<article class="window doc__sheet">
		<header class="doc__head">
			<img src="../../assets/img/logo.svg" alt="Win B. A. R. Academy crest" />
			<div>
				<div class="doc__school">Win B. A. R. Academy</div>
				<div class="doc__address">88 Archive Road, Metro Manila, Philippines</div>
			</div>
			<div class="doc__title">
				<strong>Student listing</strong>
				<span>Printed <?php echo date('F j, Y'); ?></span>
			</div>
		</header>

		<div class="doc__body">
		<p class="scroll-hint no-print">Swipe the table sideways to see every column.</p>
		<div class="table-scroll">
		<table class="data-table">
			<thead>
				<tr>
					<th>Student no.</th>
					<th>Student name</th>
					<th>Course</th>
					<th>Enrolled subjects</th>
				</tr>
			</thead>
			<tbody>
			  <?php

				$queryrequest=$conn->query("SELECT * FROM studenttbl");
				while($rowshift=mysqli_fetch_array($queryrequest))
				{
				echo	"<tr>";
				echo	"<td class='mono'>$rowshift[studnum]</td>";
				echo	"<td>$rowshift[fname] $rowshift[minitial]. $rowshift[lname]</td>";
				echo	"<td class='caps'>$rowshift[course]</td>";

				/* Fix A (approved by the team): the old schedule lookup queried sched_tbl for columns it doesn't have
				   and crashed. This read-only lookup shows the student's latest submitted enrollment instead. */
				$queryenrolled=$conn->query("SELECT * FROM student_subject WHERE studentID='$rowshift[studnum]' ORDER BY ID DESC LIMIT 1");
				if(mysqli_num_rows($queryenrolled)==0)
				{
					echo	"<td class='muted'>Not enrolled yet</td>";
					echo	"</tr>";
				}
				else
				{
					$enrolled=mysqli_fetch_array($queryenrolled);
					$subjectlist=str_replace(',', ', ', trim($enrolled['subjects'], ','));
					echo	"<td>$subjectlist <span class='muted'>($enrolled[totalunits] units)</span></td>";
					echo	"</tr>";
				}
				}
			  ?>
			</tbody>
		</table>
		</div>
		</div>
	</article>
</div>

</body>
</html>
