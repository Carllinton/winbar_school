<?php
if(isset($_GET['accid']))
{
	$num=$_GET['accid'];
	require('../conn.php');
	
	$query2=$conn->query("DELETE FROM subjecttbl WHERE ID = '$num'");
	echo"<script>try{sessionStorage.setItem('winbarFlash','success|Subject deleted.')}catch(e){alert('Subject deleted.')}window.winbarLeaving=1;</script>";
	echo"<script>window.location='subjectreg.php'</script>";
}
else
{
	echo"<script>window.location='subjectreg.php'</script>";
}

?>