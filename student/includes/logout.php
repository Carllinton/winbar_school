<?php
error_reporting(E_ALL);
session_start();
unset($_SESSION['id']);
session_destroy();
echo "<script language='javascript'>window.location='../../index.php';</script>";
?>