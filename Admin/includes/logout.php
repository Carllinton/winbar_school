<?php
error_reporting(E_ALL);
session_start();
unset($_SESSION['id']);
session_destroy();
echo "<script>try{sessionStorage.setItem('winbarFlash','info|You\'ve been logged out.')}catch(e){}window.winbarLeaving=1;window.location='../../index.php';</script>";
?>