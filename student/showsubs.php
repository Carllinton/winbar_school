<?php
session_start();
include('includes/conn.php');
include('logcheck.php');
	$stid=$_SESSION['studnum'];
				$getprofile=$conn->query("SELECT * FROM studenttbl WHERE studnum = '$stid'");
				$rows=mysqli_fetch_array($getprofile);
				
if(isset($_POST['reg']))
		{
			$stid=$_SESSION['studnum'];
			$values=$_POST['contents'];
			$units=$_POST['units'];
			
				$insertenroll=$conn->query("INSERT INTO student_subject VALUES('','$stid','$values','$units','0')");
				echo"<script>try{sessionStorage.setItem('winbarFlash','success|Enrollment form sent to the registrar.')}catch(e){alert('Enrollment form sent to the registrar.')}window.winbarLeaving=1;</script>";
				echo"<script>window.location='studentindex.php'</script>";
			
			
		}	
		
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Enrollment form | Win B. A. R. Academy</title>
<link rel="icon" type="image/svg+xml" href="../assets/img/favicon.svg" />
<link href="../style.css" rel="stylesheet" type="text/css" />
<script src="../assets/js/portal.js" defer></script>
</head>
<body class="doc-page role-student">

<div class="doc">
	<div class="doc__toolbar no-print">
		<a class="btn btn--ghost" href="enroll.php">Change subjects</a>
		<button type="button" class="btn" onclick="window.print()">Print form</button>
	</div>

	<article class="window doc__sheet">
		<header class="doc__head">
			<img src="../assets/img/logo.svg" alt="Win B. A. R. Academy crest" />
			<div>
				<div class="doc__school">Win B. A. R. Academy</div>
				<div class="doc__address">88 Archive Road, Metro Manila, Philippines</div>
			</div>
			<div class="doc__title">
				<strong>Unofficial enrollment form</strong>
				<span><?php echo "$_POST[sem]"; ?>, A.Y. 2026&ndash;2027</span>
			</div>
		</header>

		<div class="doc__body">
		<div class="doc__meta">
			<?php echo  "<span><b>Student</b>$rows[fname] $rows[minitial] $rows[lname]</span> <span><b>Course</b><span class='caps'>$rows[course]</span></span> <span><b>Year and section</b>$rows[yearlvl]</span>" ;?>
		</div>

		<p class="scroll-hint no-print">Swipe the table sideways to see every column.</p>
		<div class="table-scroll">
		<table class="data-table">
			<thead>
				<tr>
					<th>Subject</th>
					<th class="num">Units</th>
					<th class="num">Per unit</th>
					<th class="num">Tutorial</th>
					<th class="num">Lab</th>
					<th>Room</th>
					<th>Day</th>
					<th>Time</th>
					<th>Instructor</th>
					<th class="right">Total</th>
				</tr>
			</thead>
			<tbody>
			  <?php

				$alltext="";
				$totalunits=0;
				$totperlab=0;
				foreach($_POST['subject'] as $item){

				$getcodes=$conn->query("SELECT * FROM subjecttbl WHERE subjectcode='$item'");

				$alltext=$alltext.",".$item;

				$subrow=mysqli_fetch_array($getcodes);

					echo"<tr>";
						echo"<td class='mono'>$subrow[subjectcode]</td>";
						echo"<td class='num'>$subrow[numofunits]</td>";
						echo"<td class='num'>296</td>";
						if($subrow['islab']==1)
						{

							$lab=1500;
							$lab2="1500";
							$totperlab=$totperlab+1500;
						}
						else
						{
							$lab=0;
							$lab2="";
						}
						if($subrow['istutorial']==1)
						{
							$tut=1500;
							$tut2="1500";
							$totperlab=$totperlab+1500;
						}
						else
						{
							$tut=0;
							$tut2="";
						}
							echo"<td class='num'>$tut2</td>";
							echo"<td class='num'>$lab2</td>";
							echo"<td>$subrow[room]</td>";
							echo"<td>$subrow[day]</td>";
							echo"<td>$subrow[time]</td>";
							echo"<td>$subrow[instructor]</td>";
						$totrow=$subrow['numofunits'] * 296;
						echo"<td class='right mono'>$totrow.00</td>";
						$totalunits=$totalunits + $subrow['numofunits'];
					echo"</tr>";


				}
				$value=($totalunits * 296) + 2050 +150+50+$totperlab;
				echo"
						<tr>
							<td colspan='9'><b>Entrance fee</b></td><td class='right mono'>2,050.00</td>
						</tr>
						<tr>
							<td colspan='9'><b>Internet</b></td><td class='right mono'>150.00</td>
						</tr>
						<tr>
							<td colspan='9'><b>Miscellaneous</b></td><td class='right mono'>50.00</td>
						</tr>
					<tr class='total-row'>
						<td colspan='9'>Total for $totalunits units</td><td class='right grand'>&#8369; $value.00</td>
					</tr>";
			  ?>
			</tbody>
		</table>
		</div>

		<p class="doc__note">Tuition is &#8369;296 per unit. Lab and tutorial subjects add &#8369;1,500 each. This form becomes official once the registrar approves it.</p>

		<div class="doc__signatures">
			<div>Student signature over printed name</div>
			<div>Registrar's signature and date</div>
		</div>

		<form method="POST" class="doc__submit">
			<input type="hidden" name="contents" value="<?php echo $alltext; ?>">
			<input type="hidden" name="units" value="<?php echo $totalunits; ?>">
			<input type="submit" name="reg" value="Submit enrollment form" onclick="return confirm('Submit this enrollment form to the registrar?');"
				data-confirm-title="Submit your enrollment form?" data-confirm="Your subjects go to the registrar for review." data-confirm-action="Submit form">
		</form>
		</div>
	</article>
</div>

</body>
</html>
