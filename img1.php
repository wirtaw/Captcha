<?php
	include('Captcha.class.php');
	session_start();
	$_SESSION['n1']->GenerateImg();
?>
