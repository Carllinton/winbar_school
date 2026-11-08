<?php
if(isset($_GET['accid']))
{
	$num=$_GET['accid'];
	require('../conn.php');
	$getval=$conn->query("SELECT * FROM studenttbl WHERE ID = $num");
	$rowval=mysqli_fetch_array($getval);
	$accountID	= $rowval['accountID'];
	$query2=$conn->query("DELETE FROM usertbl WHERE ID = $accountID");
	$query=$conn->query("DELETE FROM studenttbl WHERE ID = $num");
	
	echo"<script>try{sessionStorage.setItem('winbarFlash','success|Student account deleted.')}catch(e){alert('Student account deleted.')}window.winbarLeaving=1;</script>";
	echo"<script>window.location='userreg.php'</script>";
}
else
{
	echo"<script>window.location='userreg.php'</script>";
}

?>