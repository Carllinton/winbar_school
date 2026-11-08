<?php
	/* Student pages: the visitor must be logged in as a student */
	if(isset($_SESSION['logcheck']) && isset($_SESSION['type']) && $_SESSION['type']=='student')
	{
		$authorize=1;
	}
	else
	{
		$authorize=0;
	}
	
	if($authorize==0)
	{
		echo"<script>try{sessionStorage.setItem('winbarFlash','info|Log in to continue.')}catch(e){}window.winbarLeaving=1;window.location='../index.php'</script>";
		exit; /* stop here: the rest of the protected page must not run */
	}
	
?>