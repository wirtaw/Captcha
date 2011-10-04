<?php
	include('Captcha.class.php');
	session_start();
	$_SESSION['n2']->GenerateImg();
?>
