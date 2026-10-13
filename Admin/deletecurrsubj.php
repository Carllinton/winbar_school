<?php
if(isset($_GET['accid']))
{
	$num=$_GET['accid'];
	require('../conn.php');
	
	$query2=$conn->query("DELETE FROM subjecttbl WHERE ID = '$num'");
	echo"<script>window.alert('Successfully Removed the selected subject')</script>";
	echo"<script>window.location='subjectreg.php'</script>";
}
else
{
	echo"<script>window.location='subjectreg.php'</script>";
}

?>