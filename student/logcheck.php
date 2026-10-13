<?php
	if(isset($_SESSION['logcheck']))
	{
		$authorize=1;
	}
	else
	{
		$authorize=0;
	}
	
	if($authorize==0)
	{
		echo"<script>window.location='../index.php'</script>";
	}
	
?>