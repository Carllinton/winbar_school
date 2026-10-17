<?php
	session_start();
	include('logcheck.php');
	include('../conn.php');
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>John Paul College</title>

<link href="../style.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript">
$('.confirm').live('click', function(){
    return confirm("Are you sure?");
});
</script>

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


<body>

<div class='header'>
</div>
	
<nav class='container'>
<?php
include('includes/menu1.php');
?>
</nav>





<div id="main">
	<div class="shell">
	<div class="users-heading"><center><b><h1>Registered User List</h1></b></center></div>
	<div class="users-actions"><a href='adminedit.php'><img src='adminedit.png' title='edit admin details' width='50' ></a><a href='addnewuser.php'><img title='Add new user' src='iconadd.png' width='50' ></a></div>
		<form method="post" class="niceform" >

		
		 <table id="datatables" class="display">
             <thead>
				<th>Student ID</th>
             	<th>Student Name</th>
             	<th>Year Level</th>
             	<th>Course</th>
				<th>Action</th>
              </thead>    
              <tbody>
			  <?php
			  include('../conn.php');
				$getusers=$conn->query("SELECT * FROM studenttbl");
				if(mysqli_num_rows($getusers)==0)
				{
				echo"<tr>
						<td colspan ='5' align='center'>
							No Entries
						</td>
					</tr>";
				}
				else
				{
				while($getrows=mysqli_fetch_array($getusers))
					{
					echo"<tr>
							<td>$getrows[studnum]</td>
							<td>$getrows[fname] $getrows[minitial] $getrows[lname]</td>
							<td>$getrows[course]</td>
							<td>$getrows[yearlvl]</td>;"?>
							<td><a href="deletecurruser.php?<?php echo"accid=$getrows[ID]";?>" onclick="return confirm('Are you sure?');">DELETE</a></td>
						</tr>
						<?php
					}
				}
					?>
				</tbody>
		</table>
    
</form>
	</div>
	<div><br></div>
</div>
<!-- /Main -->

<!-- Footer -->
<div id="footer">
	<div class="shell">
		<!-- Mini Nav --> 
		<div class="footer-navigation"> 
			<?php
		include('includes/menu2.php');
			?>
		</div> 
		<!-- /Mini Nav --> 
		
		<!-- Copyrights --> 
		<p class="right"> 
			Copyright 2014 | Online Enrollment
		</p> 
		<!-- /Copyrights --> 
		
		<div class="cl">&nbsp;</div> 
	</div>
</div>




</body>
</html>